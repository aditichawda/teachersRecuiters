<?php

namespace Theme\Jobzilla\Http\Controllers;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\JobBoard\Models\Package;
use Botble\JobBoard\Models\UserNotification;
use Botble\JobBoard\Repositories\Interfaces\CategoryInterface;
use Botble\Location\Repositories\Interfaces\CityInterface;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Http\Controllers\PublicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Theme\Jobzilla\Http\Resources\CityResource;

class JobzillaController extends PublicController
{
    /**
     * Compatibility endpoint for theme JS: /ajax/search-cities (route name: ajax.search-cities).
     *
     * Returns:
     * - { error: false, data: [ {id,name,state_id,state_name,country_id,country_name}, ... ] }
     * - or when default_country=1 and no keyword: { error: false, data: { cities: [...], has_more: bool, page: int } }
     */
    public function ajaxSearchCities(Request $request)
    {
        // Force JSON
        $request->headers->set('Accept', 'application/json');

        $keyword = BaseHelper::stringify($request->query('k') ?: $request->query('keyword'));
        $defaultCountry = $request->query('default_country');
        $page = max(1, (int) $request->query('page', 1));
        $perPage = 10;

        // If location plugin exists, prefer its tables/structure but query directly (works even if plugin is disabled)
        if (! Schema::hasTable('cities')) {
            return response()->json(['error' => false, 'data' => [], 'message' => null]);
        }

        $citiesQ = DB::table('cities')
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
            ->leftJoin('countries', function ($join) {
                $join->on('countries.id', '=', 'cities.country_id')
                    ->orOn('countries.id', '=', 'states.country_id');
            })
            ->where(function ($q) {
                // allow common "published" variants
                $q->where('cities.status', BaseStatusEnum::PUBLISHED)
                    ->orWhere('cities.status', 1)
                    ->orWhereNull('cities.status')
                    ->orWhere('cities.status', 'published');
            });

        // Default listing (no keyword): show India first (if available), otherwise first 12
        if (! $keyword || strlen($keyword) < 2) {
            if ($defaultCountry === '1' || $defaultCountry === 'true') {
                $indiaId = null;
                if (Schema::hasTable('countries')) {
                    $indiaId = DB::table('countries')
                        ->whereRaw('LOWER(TRIM(name)) = ?', ['india'])
                        ->value('id');
                }

                if ($indiaId) {
                    $citiesQ->where(function ($q) use ($indiaId) {
                        $q->where('cities.country_id', $indiaId)
                            ->orWhere('states.country_id', $indiaId);
                    });

                    $total = (clone $citiesQ)->count();
                    $rows = $citiesQ
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

            $rows = $citiesQ->orderBy('cities.name')->limit(12)->get();
        } else {
            $k = trim($keyword);
            $rows = $citiesQ->where('cities.name', 'LIKE', '%' . $k . '%')->orderBy('cities.name')->limit(20)->get();
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
    }

    /**
     * Compatibility endpoint for work preference dropdown: /ajax/states-by-country.
     * Returns { error: false, data: [ {id,name}, ... ] }.
     */
    public function ajaxStatesByCountry(Request $request)
    {
        $request->headers->set('Accept', 'application/json');

        if (! Schema::hasTable('states')) {
            return response()->json(['error' => false, 'data' => [], 'message' => null]);
        }

        $countryId = $request->query('country_id');
        $q = DB::table('states')
            ->select(['id', 'name'])
            ->where(function ($q) {
                $q->where('status', BaseStatusEnum::PUBLISHED)
                    ->orWhere('status', 1)
                    ->orWhereNull('status')
                    ->orWhere('status', 'published');
            })
            ->orderBy('name');

        if ($countryId && $countryId !== 'null') {
            $q->where('country_id', $countryId);
        }

        return response()->json([
            'error' => false,
            'data' => $q->get(),
            'message' => null,
        ]);
    }

    /**
     * Compatibility endpoint for work preference dropdown: /ajax/cities-by-state.
     * Returns { error: false, data: [ {id,name}, ... ] }.
     */
    public function ajaxCitiesByState(Request $request)
    {
        $request->headers->set('Accept', 'application/json');

        if (! Schema::hasTable('cities')) {
            return response()->json(['error' => false, 'data' => [], 'message' => null]);
        }

        $stateId = $request->query('state_id');

        $q = DB::table('cities')
            ->select(['id', 'name'])
            ->where(function ($q) {
                $q->where('status', BaseStatusEnum::PUBLISHED)
                    ->orWhere('status', 1)
                    ->orWhereNull('status')
                    ->orWhere('status', 'published');
            })
            ->orderBy('name');

        if ($stateId && $stateId !== 'null') {
            $q->where('state_id', $stateId);
        }

        return response()->json([
            'error' => false,
            'data' => $q->get(),
            'message' => null,
        ]);
    }

    public function ajaxGetCities(Request $request, CityInterface $cityRepository, BaseHttpResponse $response)
    {
        // Force JSON response
        $request->headers->set('Accept', 'application/json');
        
        // Support both 'k' and 'keyword' parameters
        $keyword = BaseHelper::stringify($request->input('k')) ?: BaseHelper::stringify($request->input('keyword'));

        // Handle default_country parameter for initial load
        if ($request->has('default_country') && empty($keyword)) {
            // Return empty for now, or you can return popular cities
            return response()->json([
                'error' => false,
                'data' => [],
                'message' => null,
            ]);
        }
        // Force JSON response
        $request->headers->set('Accept', 'application/json');
        
        // Support both 'k' and 'keyword' parameters
        $keyword = BaseHelper::stringify($request->input('k')) ?: BaseHelper::stringify($request->input('keyword'));

        // Handle default_country parameter for initial load
        if ($request->has('default_country') && empty($keyword)) {
            // Return empty for now, or you can return popular cities
            return response()->json([
                'error' => false,
                'data' => [],
                'message' => null,
            ]);
        }

        // Only search if keyword is provided and has at least 2 characters
        if (empty($keyword) || strlen($keyword) < 2) {
            return response()->json([
                'error' => false,
                'data' => [],
                'message' => null,
            ]);
            return response()->json([
                'error' => false,
                'data' => [],
                'message' => null,
            ]);
        }

        try {
            // Use direct City model lookup so we don't require country_id/state_id to be present
            // and avoid over-filtering by published countries when importing large datasets.
            $cities = \Botble\Location\Models\City::query()
                ->with('state')
                ->where('name', 'LIKE', '%' . $keyword . '%')
                ->orderBy('name')
                ->limit(20)
                ->get();

            // Log for debugging
            \Log::info('[CITY_SEARCH] Search performed', [
                'keyword' => $keyword,
                'cities_count' => $cities->count(),
            ]);

            return response()->json([
                'error' => false,
                'data' => CityResource::collection($cities)->resolve(),
                'message' => null,
            ]);
        } catch (\Exception $e) {
            \Log::error('[CITY_SEARCH] Error searching cities', [
                'keyword' => $keyword,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'error' => false,
                'data' => [],
                'message' => null,
            ]);
        }
    }

    public function ajaxGetJobRoles(Request $request, CategoryInterface $categoryRepository, BaseHttpResponse $response)
    {
        // Accept fetch API requests (not just ajax/wantsJson)
        // Force JSON response
        $request->headers->set('Accept', 'application/json');
        
        // Accept fetch API requests (not just ajax/wantsJson)
        // Force JSON response
        $request->headers->set('Accept', 'application/json');
        
        $keyword = BaseHelper::stringify($request->input('k'));

        $categories = $categoryRepository->advancedGet([
            'condition' => [
                'status' => BaseStatusEnum::PUBLISHED,
            ],
            'order_by' => ['order' => 'ASC', 'created_at' => 'DESC'],
        ]);

        // If keyword is empty, return all categories (for dropdown on click)
        // Otherwise filter by keyword
        if (!empty($keyword) && strlen($keyword) >= 2) {
            $categories = $categories->filter(function ($category) use ($keyword) {
                return stripos($category->name, $keyword) !== false;
            });
        }

        $categories = $categories->take(100)->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
            ];
        });

        // Return JSON directly for fetch API compatibility
        return response()->json([
            'error' => false,
            'data' => $categories->values(),
            'message' => null,
        ]);
        // Return JSON directly for fetch API compatibility
        return response()->json([
            'error' => false,
            'data' => $categories->values(),
            'message' => null,
        ]);
    }

    public function faq()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('FAQ'), route('public.faq'));

        return Theme::scope('faq')->render();
    }

    public function premiumService()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('Premium Service'), route('public.premium-service'));

        $account = Auth::guard('account')->user();
        $packageType = 'job-seeker'; // default when guest or job seeker
        $employerPackageLabel = null; // 'consultancy' or 'school_institution' when employer
        $premiumDebug = [
            'accountId' => $account?->getKey(),
            'isLoggedIn' => (bool) $account,
            'isEmployer' => $account ? (bool) $account->isEmployer() : false,
            'registrationType' => $account->registration_type ?? null,
            'isConsultancy' => $account && method_exists($account, 'isConsultancy') ? (bool) $account->isConsultancy() : false,
        ];

        if ($account && $account->isEmployer()) {
            $packageType = 'employer';
            $employerPackageLabel = (method_exists($account, 'isConsultancy') && $account->isConsultancy())
                ? 'consultancy'
                : 'school_institution';
        }

        $packages = Package::query()
            ->wherePublished()
            ->where('package_type', $packageType)
            ->when($packageType === 'employer' && $account && Schema::hasColumn('jb_packages', 'show_for_consultancy') && Schema::hasColumn('jb_packages', 'show_for_school_institution'), function ($query) use ($account) {
                if (method_exists($account, 'isConsultancy') && $account->isConsultancy()) {
                    $query->where('show_for_consultancy', true);
                } else {
                    $query->where('show_for_school_institution', true);
                }
            })
            ->when($packageType === 'employer' && $account && Schema::hasColumn('jb_packages', 'visible_for_account_ids'), function ($query) use ($account) {
                $query->where(function ($sub) use ($account) {
                    $sub->whereNull('visible_for_account_ids')
                        ->orWhereJsonContains('visible_for_account_ids', (int) $account->getKey());
                });
            })
            ->with('currency')
            ->orderBy('order')
            ->orderBy('id')
            ->get();

        $premiumDebug['packageType'] = $packageType;
        $premiumDebug['employerPackageLabel'] = $employerPackageLabel;
        $premiumDebug['packagesCount'] = $packages->count();

        return Theme::scope('premium-service', compact('packages', 'packageType', 'employerPackageLabel', 'premiumDebug'))->render();
    }

    public function forTeachers()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('For Teachers'), route('public.for-teachers'));

        return Theme::scope('for-teachers')->render();
    }

    public function forSchools()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('For Schools'), route('public.for-schools'));

        return Theme::scope('for-schools')->render();
    }

    public function startHiring()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('Start Hiring'), route('public.start-hiring'));

        return Theme::scope('start-hiring')->render();
    }

    public function careers()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('Careers'), route('public.careers'));

        return Theme::scope('careers')->render();
    }

    public function notifications()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('Notifications'), route('public.notifications'));

        $account = Auth::guard('account')->user();
        
        $notifications = collect([]);
        $unreadCount = 0;
        $readCount = 0;

        if ($account) {
            try {
                // Check if table exists before querying
                if (\Illuminate\Support\Facades\Schema::hasTable('jb_user_notifications')) {
                    $notifications = UserNotification::where('account_id', $account->id)
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->map(function ($notification) {
                            return [
                                'id' => $notification->id,
                                'type' => $notification->type,
                                'title' => $notification->title,
                                'message' => $notification->message,
                                'time' => $notification->created_at->diffForHumans(),
                                'read' => $notification->isRead(),
                                'icon' => $notification->icon,
                                'color' => $notification->color,
                                'action_url' => $notification->action_url,
                            ];
                        });

                    $unreadCount = UserNotification::where('account_id', $account->id)
                        ->whereNull('read_at')
                        ->count();
                    
                    $readCount = UserNotification::where('account_id', $account->id)
                        ->whereNotNull('read_at')
                        ->count();
                }
            } catch (\Exception $e) {
                \Log::error('Error fetching notifications: ' . $e->getMessage());
                // Continue with empty notifications if table doesn't exist
            }
        }

        return Theme::scope('notifications', compact('notifications', 'unreadCount', 'readCount'))->render();
    }
}
