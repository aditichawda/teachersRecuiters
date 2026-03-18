<?php

namespace Theme\Jobcy\Http\Controllers;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\JobBoard\Models\Category;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Repositories\Interfaces\JobInterface;
use Botble\Language\Facades\Language;
use Botble\Location\Facades\Location;
use Botble\Location\Models\City;
use Botble\Location\Repositories\Interfaces\CityInterface;
use Botble\Location\Repositories\Interfaces\CountryInterface;
use Botble\Location\Repositories\Interfaces\StateInterface;
use Botble\Page\Models\Page;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Http\Controllers\PublicController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Theme\Jobcy\Http\Resources\CityResource;
use Theme\Jobcy\Http\Resources\LocationResource;

class JobcyController extends PublicController
{
    /**
     * /ajax/search-cities (name: ajax.search-cities)
     *
     * Response shapes supported by existing theme JS:
     * - { error: false, data: [ ... ] }
     * - { error: false, data: { cities: [ ... ], has_more: bool, page: int } }  (default_country=1)
     */
    public function ajaxSearchCities(Request $request)
    {
        $request->headers->set('Accept', 'application/json');

        $keyword = BaseHelper::stringify($request->query('k') ?: $request->query('keyword'));
        $defaultCountry = $request->query('default_country');
        $page = max(1, (int) $request->query('page', 1));
        $perPage = 10;

        try {
            if (! Schema::hasTable('cities')) {
                return response()->json(['error' => false, 'data' => [], 'message' => null]);
            }

            // Use query builder instead of Eloquent because some installs have invalid enum values
            // in status columns (e.g. 1), which can crash BaseStatusEnum casting.
            $baseQuery = DB::table('cities')
                ->select([
                    'cities.id',
                    'cities.name',
                    'cities.state_id',
                    'cities.country_id',
                    DB::raw('states.name as state_name'),
                    DB::raw('countries.name as country_name'),
                    DB::raw('COALESCE(cities.country_id, states.country_id) as resolved_country_id'),
                ])
                ->leftJoin('states', 'states.id', '=', 'cities.state_id')
                ->leftJoin('countries', 'countries.id', '=', DB::raw('COALESCE(cities.country_id, states.country_id)'));

            // Default list on focus: India-first when requested
            if (! $keyword || strlen($keyword) < 2) {
                if (($defaultCountry === '1' || $defaultCountry === 'true') && Schema::hasTable('countries')) {
                    $indiaId = DB::table('countries')
                        ->whereRaw('LOWER(TRIM(name)) = ?', ['india'])
                        ->value('id');

                    if ($indiaId) {
                        $query = (clone $baseQuery)->where(function ($q) use ($indiaId) {
                            $q->where('cities.country_id', $indiaId)
                                ->orWhere('states.country_id', $indiaId);
                        });

                        $total = (clone $query)->count();
                        $rows = $query
                            ->orderBy('cities.name')
                            ->offset(($page - 1) * $perPage)
                            ->limit($perPage)
                            ->get();

                        $mapped = $rows->map(function ($r) {
                            return [
                                'id' => $r->id,
                                'name' => $r->name,
                                'state_id' => $r->state_id,
                                'state_name' => $r->state_name ?: '',
                                'country_id' => $r->resolved_country_id,
                                'country_name' => $r->country_name ?: '',
                            ];
                        })->values();

                        return response()->json([
                            'error' => false,
                            'data' => [
                                'cities' => $mapped,
                                'has_more' => ($page * $perPage) < $total,
                                'page' => $page,
                            ],
                            'message' => null,
                        ]);
                    }
                }

                $rows = (clone $baseQuery)->orderBy('cities.name')->limit(12)->get();
            } else {
                $k = trim($keyword);
                $rows = (clone $baseQuery)->where('cities.name', 'LIKE', '%' . $k . '%')->orderBy('cities.name')->limit(20)->get();
            }

            $mapped = collect($rows)->map(function ($r) {
                return [
                    'id' => $r->id,
                    'name' => $r->name,
                    'state_id' => $r->state_id,
                    'state_name' => $r->state_name ?: '',
                    'country_id' => $r->resolved_country_id,
                    'country_name' => $r->country_name ?: '',
                ];
            })->values();

            return response()->json([
                'error' => false,
                'data' => $mapped,
                'message' => null,
            ]);
        } catch (\Throwable $e) {
            Log::error('[JOBCY][CITY_SEARCH] Error', [
                'keyword' => $keyword,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'error' => false,
                'data' => [],
                'message' => null,
            ], 200);
        }
    }

    /**
     * /ajax/states-by-country (name: ajax.states-by-country)
     * Returns { error: false, data: [ {id,name}, ... ] }
     */
    public function ajaxStatesByCountry(Request $request)
    {
        $request->headers->set('Accept', 'application/json');

        try {
            if (! Schema::hasTable('states')) {
                return response()->json(['error' => false, 'data' => [], 'message' => null]);
            }

            $countryId = $request->query('country_id');

            $q = DB::table('states')
                ->select(['id', 'name'])
                ->orderBy('name');

            if ($countryId && $countryId !== 'null') {
                $q->where('country_id', $countryId);
            }

            return response()->json([
                'error' => false,
                'data' => $q->get(),
                'message' => null,
            ]);
        } catch (\Throwable $e) {
            Log::error('[JOBCY][STATES_BY_COUNTRY] Error', ['error' => $e->getMessage()]);

            return response()->json(['error' => false, 'data' => [], 'message' => null], 200);
        }
    }

    /**
     * /ajax/cities-by-state (name: ajax.cities-by-state)
     * Returns { error: false, data: [ {id,name}, ... ] }
     */
    public function ajaxCitiesByState(Request $request)
    {
        $request->headers->set('Accept', 'application/json');

        try {
            if (! Schema::hasTable('cities')) {
                return response()->json(['error' => false, 'data' => [], 'message' => null]);
            }

            $stateId = $request->query('state_id');

            $q = DB::table('cities')
                ->select(['id', 'name'])
                ->orderBy('name');

            if ($stateId && $stateId !== 'null') {
                $q->where('state_id', $stateId);
            }

            return response()->json([
                'error' => false,
                'data' => $q->get(),
                'message' => null,
            ]);
        } catch (\Throwable $e) {
            Log::error('[JOBCY][CITIES_BY_STATE] Error', ['error' => $e->getMessage()]);

            return response()->json(['error' => false, 'data' => [], 'message' => null], 200);
        }
    }

    public function ajaxGetCities(Request $request, BaseHttpResponse $response)
    {
        if (! $request->ajax() || ! $request->wantsJson()) {
            return $response->setNextUrl(BaseHelper::getHomepageUrl());
        }

        $keyword = BaseHelper::stringify($request->input('k'));

        $searchCityOnly = setting('job_board_search_location_by', 'city_and_state') === 'city';

        $cities = City::query()
            ->wherePublished('cities.status')
            ->select('cities.*')
            ->leftJoin('states', function (JoinClause $query): void {
                $query
                    ->on('states.id', '=', 'cities.state_id')
                    ->where('states.status', BaseStatusEnum::PUBLISHED);
            })
            ->join('countries', function (JoinClause $query): void {
                $query
                    ->on('countries.id', '=', 'cities.country_id')
                    ->where('countries.status', BaseStatusEnum::PUBLISHED);
            })
            ->when($keyword, function (Builder $query) use ($searchCityOnly, $keyword): void {
                $keyword = '%' . $keyword . '%';

                $query->where(function (Builder $query) use ($searchCityOnly, $keyword): void {
                    $query
                        ->where(function (Builder $query) use ($searchCityOnly, $keyword) {
                            return $query
                                ->where('cities.name', 'LIKE', $keyword)
                                ->when(! $searchCityOnly, function (Builder $query) use ($keyword): void {
                                    $query->orWhere('states.name', 'LIKE', $keyword);
                                });
                        })
                        ->when(
                            is_plugin_active('language')
                            && is_plugin_active('language-advanced')
                            && Language::getCurrentLocale() != Language::getDefaultLocale(),
                            function (Builder $query) use (
                                $searchCityOnly,
                                $keyword
                            ): void {
                                $query
                                    ->orWhere(function (Builder $query) use ($searchCityOnly, $keyword) {
                                        return $query
                                            ->whereHas('translations', function ($query) use ($keyword): void {
                                                $query->where('name', 'LIKE', $keyword);
                                            })
                                            ->when(! $searchCityOnly, function (Builder $query) use ($keyword): void {
                                                $query->orWhereHas('state.translations', function ($query) use ($keyword): void {
                                                    $query->where('name', 'LIKE', $keyword);
                                                });
                                            });
                                    });
                            }
                        );
                });
            });

        $cities = $cities
            ->limit(10)
            ->with(['state'])
            ->get();

        return $response->setData(CityResource::collection($cities));
    }

    public function ajaxGetLocation(
        Request $request,
        CityInterface $cityRepository,
        StateInterface $stateRepository,
        CountryInterface $countryRepository,
        BaseHttpResponse $response
    ) {
        $request->validate([
            'k' => ['nullable', 'string'],
        ]);

        $keyword = BaseHelper::stringify($request->query('k'));
        $limit = (int) theme_option('limit_results_on_job_location_filter', 10) ?: 1000;
        if ($request->input('type', 'state') === 'state') {
            $locations = $stateRepository->filters($keyword, $limit);

            $jobsLocationAvailable = $stateRepository->getModel()::query()
                ->wherePublished()
                ->whereExists(function ($query): void {
                    $query->select('id')
                        ->from((new Job())->getTable())
                        ->whereColumn('state_id', 'states.id');
                })
                ->pluck('id')
                ->toArray();
        } else {
            $locations = $cityRepository->filters($keyword, $limit);
            $locations->loadMissing('state');

            $jobsLocationAvailable = $cityRepository->getModel()::query()
                ->whereExists(function ($query): void {
                    $query->select('id')
                        ->from((new Job())->getTable())
                        ->whereColumn('city_id', 'cities.id');
                })
                ->wherePublished()
                ->pluck('id')
                ->toArray();
        }

        $countryIds = $countryRepository->getModel()::query()
            ->wherePublished()
            ->whereExists(function ($query): void {
                $query->select('id')
                    ->from((new Job())->getTable())
                    ->whereColumn('country_id', 'countries.id')
                    ->whereNull('city_id')
                    ->whereNull('state_id');
            })
            ->where('name', 'like', '%' . $keyword . '%')
            ->pluck('id')
            ->toArray();

        $locations = $locations->whereIn('id', array_values(array_unique($jobsLocationAvailable)));

        $locations = $locations->merge($countryRepository->getByWhereIn('id', $countryIds))->sort();

        return $response->setData(LocationResource::collection($locations));
    }

    public function ajaxGetJobCategories(Request $request, BaseHttpResponse $response)
    {
        if (! $request->ajax() || ! $request->wantsJson()) {
            return $response->setNextUrl(BaseHelper::getHomepageUrl());
        }

        $keyword = BaseHelper::stringify($request->input('k'));

        $categories = Category::query()
            ->wherePublished()
            ->when($keyword, function (Builder $query) use ($keyword): void {
                $keyword = '%' . $keyword . '%';

                $query->where(function (Builder $query) use ($keyword): void {
                    $query->where('name', 'LIKE', $keyword)
                        ->when(
                            is_plugin_active('language')
                            && is_plugin_active('language-advanced')
                            && Language::getCurrentLocale() != Language::getDefaultLocale(),
                            function (Builder $query) use ($keyword): void {
                                $query->orWhereHas('translations', function ($query) use ($keyword): void {
                                    $query->where('name', 'LIKE', $keyword);
                                });
                            }
                        );
                });
            })
            ->oldest('name')
            ->limit(10)
            ->get();

        return $response->setData($categories->map(fn ($category) => [
            'value' => $category->id,
            'label' => $category->name,
        ]));
    }

    public function ajaxGetJobCategoriesList(Request $request, BaseHttpResponse $response)
    {
        if (! $request->ajax() || ! $request->wantsJson()) {
            return $response->setNextUrl(BaseHelper::getHomepageUrl());
        }

        $showJobsCount = $request->input('show_jobs_count', 'yes');

        $categories = Category::query()
            ->wherePublished()
            ->oldest('order')
            ->latest()
            ->with(['slugable', 'activeChildren.activeChildren.activeChildren'])
            ->get();

        if ($showJobsCount === 'yes') {
            Category::addJobsCountWithChildren($categories);
        }

        $html = view(Theme::getThemeNamespace('partials.shortcodes..includes.job-categories-list'), compact('categories'))->render();

        return $response->setData(['html' => $html]);
    }

    public function ajaxGetFeaturedJobCategories(Request $request, BaseHttpResponse $response)
    {
        if (! $request->ajax() || ! $request->wantsJson()) {
            return $response->setNextUrl(BaseHelper::getHomepageUrl());
        }

        $showJobsCount = $request->input('show_jobs_count', 'yes');
        $limit = (int) $request->input('limit', 8);

        $categories = Category::query()
            ->wherePublished()
            ->where('is_featured', true)
            ->oldest('order')
            ->latest()
            ->limit($limit)
            ->with(['slugable', 'metadata', 'activeChildren.activeChildren.activeChildren'])
            ->get();

        if ($showJobsCount === 'yes') {
            Category::addJobsCountWithChildren($categories);
        }

        $page = null;
        if ($pageId = theme_option('job_categories_page_id')) {
            $page = Page::query()
                ->wherePublished()
                ->where('id', $pageId)
                ->select(['id', 'name'])
                ->with('slugable')
                ->first();
        }

        $html = view(Theme::getThemeNamespace('partials.shortcodes.includes.featured-job-categories-list'), compact('categories', 'page'))->render();

        return $response->setData(['html' => $html]);
    }

    public function ajaxGetJobTabs(string $type, Request $request, JobInterface $jobRepository, BaseHttpResponse $response)
    {
        if (! $request->ajax() || ! $request->wantsJson()) {
            return $response->setNextUrl(BaseHelper::getHomepageUrl());
        }

        $with = [
            'slugable',
            'jobTypes',
            'company',
            'company.slugable',
            'tags',
            'tags.slugable',
            'jobExperience',
            'currency',
        ];

        if (is_plugin_active('location')) {
            $with = array_merge($with, array_keys(Location::getSupported(Job::class)));
        }

        $jobs = match ($type) {
            'featured' => $jobRepository->getFeaturedJobs(10, $with),
            'recent' => $jobRepository->getRecentJobs(10, $with, true),
            'popular' => $jobRepository->getPopularJobs(10, $with, true),
            default => collect([]),
        };

        $html = '';
        foreach ($jobs as $job) {
            $html .= view(Theme::getThemeNamespace('views.job-board.partials.job-item'), ['job' => $job])->render();
        }

        return $response->setData(['html' => $html]);
    }
}
