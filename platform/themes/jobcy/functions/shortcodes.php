<?php

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImagesFieldOption;
use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\MediaImagesField;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Blog\Models\Post;
use Botble\Faq\Models\FaqCategory;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\Category;
use Botble\JobBoard\Models\Company;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Repositories\Interfaces\JobInterface;
use Botble\Language\Facades\Language;
use Botble\Location\Facades\Location;
use Botble\Location\Models\City;
use Botble\Location\Models\Country;
use Botble\Location\Models\State;
use Botble\Page\Models\Page;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Shortcode\Compilers\Shortcode;
use Botble\Shortcode\Forms\ShortcodeForm;
use Botble\Testimonial\Models\Testimonial;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Forms\Fields\ThemeIconField;
use Botble\Theme\Supports\ThemeSupport;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

app()->booted(function (): void {
    ThemeSupport::registerGoogleMapsShortcode();
    ThemeSupport::registerYoutubeShortcode();

    add_shortcode('search-box', __('Search box'), __('The big search box'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.search-box', compact('shortcode'));
    });

    shortcode()->setAdminConfig('search-box', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->placeholder(__('Subtitle'))
                    ->helperText(__('Use {count} as a placeholder for the number of jobs. Example: "We have {count} live jobs"'))
            )
            ->add(
                'use_real_jobs_count',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Replace {count} with real jobs count'))
                    ->choices(['no' => __('No - use custom value below'), 'yes' => __('Yes - use real jobs count from database')])
                    ->selected(Arr::get($attributes, 'use_real_jobs_count', 'no'))
                    ->helperText(__('When enabled, {count} in the subtitle will be replaced with the actual number of active jobs from the database'))
            )
            ->add(
                'jobs_count',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Custom jobs count'))
                    ->placeholder(__('e.g. 150,000+'))
                    ->defaultValue('150,000+')
                    ->helperText(__('Enter a custom value to display (only used when "Replace {count} with real jobs count" is set to No)'))
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->placeholder(__('Title'))
            )
            ->add(
                'highlight_text',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Highlight text in title'))
                    ->placeholder(__('Highlight text in title'))
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description'))
                    ->placeholder(__('Description'))
                    ->rows(3)
            )
            ->add(
                'image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image'))
            )
            ->add(
                'style',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Style'))
                    ->choices([
                        'style-1' => __('Style 1'),
                        'style-2' => __('Style 2'),
                        'style-3' => __('Style 3'),
                    ])
                    ->selected(Arr::get($attributes, 'style'))
                    ->addAttribute('data-bb-toggle', 'conditional')
                    ->addAttribute('data-bb-conditional-value', 'style-3')
                    ->addAttribute('data-bb-conditional-targets', '.field-images-wrapper')
            )
            ->add(
                'images',
                MediaImagesField::class,
                MediaImagesFieldOption::make()
                    ->label(__('Images'))
                    ->wrapperAttributes(['data-bb-conditional' => 'style', 'style' => Arr::get($attributes, 'style') !== 'style-3' ? 'display: none' : ''])
            )
            ->add(
                'trending_keywords',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Trending Keywords'))
                    ->placeholder(__('Trending keywords (comma separated)'))
            );
    });

    add_shortcode('how-it-work', __('How it work'), __('How it work'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.how-it-work', compact('shortcode'));
    });

    shortcode()->setAdminConfig('how-it-work', function (array $attributes) {
        $form = ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->placeholder(__('Title'))
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->placeholder(__('Subtitle'))
            );

        for ($i = 1; $i <= 5; $i++) {
            $form
                ->add(
                    'step_' . $i . '_title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Step :number title', ['number' => $i]))
                        ->placeholder(__('Step :number title', ['number' => $i]))
                )
                ->add(
                    'step_' . $i . '_description',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Step :number description', ['number' => $i]))
                        ->placeholder(__('Step :number description', ['number' => $i]))
                )
                ->add(
                    'step_' . $i . '_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Step :number image', ['number' => $i]))
                );
        }

        return $form;
    });

    add_shortcode('start-working', __('Start working'), __('Start working'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.start-working', compact('shortcode'));
    });

    shortcode()->setAdminConfig('start-working', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->placeholder(__('Title'))
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->placeholder(__('Subtitle'))
            )
            ->add(
                'button_1_icon',
                ThemeIconField::class,
                ['label' => __('Button 1 Icon')]
            )
            ->add(
                'button_1_text',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button 1 Text'))
                    ->placeholder(__('Button 1 Text'))
            )
            ->add(
                'button_1_url',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button 1 URL'))
                    ->placeholder(__('Button 1 URL'))
            )
            ->add(
                'button_2_icon',
                ThemeIconField::class,
                ['label' => __('Button 2 Icon')]
            )
            ->add(
                'button_2_text',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button 2 Text'))
                    ->placeholder(__('Button 2 Text'))
            )
            ->add(
                'button_2_url',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button 2 URL'))
                    ->placeholder(__('Button 2 URL'))
            );
    });

    add_shortcode('coming-soon', __('Coming Soon'), __('Coming Soon'), function (Shortcode $shortcode) {
        $date = null;

        try {
            $date = Carbon::parse($shortcode->date)->format('Y-m-d H:i:s');
        } catch (Throwable) {
        }

        return Theme::partial('shortcodes.coming-soon', compact('shortcode', 'date'));
    });

    shortcode()->setAdminConfig('coming-soon', function (array $attributes) {
        $form = ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->placeholder(__('Title'))
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->placeholder(__('Subtitle'))
            )
            ->add(
                'date',
                'datetime-local',
                [
                    'label' => __('Date'),
                    'value' => Arr::get($attributes, 'date', Carbon::now()->addMonth()->toDateTimeLocalString()),
                ]
            )
            ->add(
                'image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image'))
            );

        if (is_plugin_active('newsletter')) {
            $form->add(
                'show_newsletter',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Show newsletter form'))
                    ->choices(['yes' => __('Yes'), 'no' => __('No')])
                    ->selected(Arr::get($attributes, 'show_newsletter', 'yes'))
            );
        }

        return $form;
    });

    if (is_plugin_active('job-board')) {
        add_shortcode('job-list', __('Job list'), __('Show job list'), function (Shortcode $shortcode) {
            $filterInput = request()->input();

            if ($shortcode->category_id && empty($filterInput['job_categories'])) {
                $filterInput['job_categories'] = [$shortcode->category_id];
            }

            if ($shortcode->country_id && empty($filterInput['country_id'])) {
                $filterInput['country_id'] = $shortcode->country_id;
            }

            if ($shortcode->state_id && empty($filterInput['state_id'])) {
                $filterInput['state_id'] = $shortcode->state_id;
            }

            if ($shortcode->city_id && empty($filterInput['city_id'])) {
                $filterInput['city_id'] = $shortcode->city_id;
            }

            $requestQuery = JobBoardHelper::getJobFilters($filterInput);

            if (! empty($requestQuery['keyword'])) {
                SeoHelper::setTitle(__('Search results for ":keyword"', ['keyword' => $requestQuery['keyword']]));
            }

            if (! empty($requestQuery['job_categories'])) {
                $categories = Category::query()
                    ->whereIn('id', $requestQuery['job_categories'])
                    ->select('id', 'name')
                    ->get()
                    ->map(fn ($category) => $category->name)
                    ->implode(', ');

                if ($categories) {
                    if (! empty($requestQuery['keyword'])) {
                        SeoHelper::setTitle(__('Search results for ":keyword" in :categories', [
                            'keyword' => $requestQuery['keyword'],
                            'categories' => $categories,
                        ]));
                    } else {
                        SeoHelper::setTitle(__('Jobs in :categories', [
                            'keyword' => $requestQuery['keyword'],
                            'categories' => $categories,
                        ]));
                    }
                }
            }

            $sortBy = match (request()->input('sort_by') ?: 'newest') {
                'oldest' => [
                    'jb_jobs.created_at' => 'ASC',
                ],
                default => [
                    'jb_jobs.created_at' => 'DESC',
                ],
            };

            if (JobBoardHelper::isPinFeaturedJobsInTheTop()) {
                $sortBy = ['jb_jobs.is_featured' => 'DESC', ...$sortBy];
            }

            $jobs = app(JobInterface::class)->getJobs(
                $requestQuery,
                [
                    'order_by' => $sortBy,
                    'paginate' => [
                        'per_page' => $requestQuery['per_page'] ?: 10,
                        'current_paged' => $requestQuery['page'] ?: 1,
                    ],
                ],
            );

            $jobFeaturedCategories = collect();

            if (($shortcode->show_featured_categories ?? 'yes') === 'yes') {
                $jobFeaturedCategories = Cache::remember('job_featured_categories_with_counts', 3600, function () {
                    $categories = Category::query()
                        ->wherePublished()
                        ->where('is_featured', true)
                        ->with(['activeChildren.activeChildren.activeChildren'])
                        ->get();

                    Category::addJobsCountWithChildren($categories);

                    return $categories;
                });
            }

            if (theme_option('show_map_on_jobs_page', 'yes') == 'yes') {
                Theme::asset()->usePath()->add('leaflet-css', 'libs/leaflet/leaflet.css');
                Theme::asset()->container('footer')->usePath()->add('leaflet-js', 'libs/leaflet/leaflet.js');
                Theme::asset()->container('footer')->usePath()->add('markercluster-src-js', 'libs/leaflet/leaflet.markercluster-src.js');
            }

            return Theme::partial('shortcodes.job-list', compact(
                'shortcode',
                'jobs',
                'jobFeaturedCategories',
            ));
        });

        shortcode()->setAdminConfig('job-list', function (array $attributes) {
            $form = ShortcodeForm::createFromArray($attributes)
                ->add(
                    'title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Title'))
                        ->placeholder(__('Title'))
                )
                ->add(
                    'show_featured_categories',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Show featured categories'))
                        ->choices(['yes' => __('Yes'), 'no' => __('No')])
                        ->selected(Arr::get($attributes, 'show_featured_categories', 'yes'))
                );

            $categories = Category::query()
                ->wherePublished()
                ->pluck('name', 'id')
                ->all();

            if ($categories) {
                $form->add(
                    'category_id',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Category'))
                        ->choices(['' => __('-- All categories --')] + $categories)
                        ->selected(Arr::get($attributes, 'category_id'))
                );
            }

            if (is_plugin_active('location')) {
                $countries = Country::query()
                    ->wherePublished()
                    ->pluck('name', 'id')
                    ->all();

                if ($countries) {
                    $form->add(
                        'country_id',
                        SelectField::class,
                        SelectFieldOption::make()
                            ->label(__('Country'))
                            ->choices(['' => __('-- All countries --')] + $countries)
                            ->selected(Arr::get($attributes, 'country_id'))
                    );
                }

                $states = State::query()
                    ->wherePublished()
                    ->pluck('name', 'id')
                    ->all();

                if ($states) {
                    $form->add(
                        'state_id',
                        SelectField::class,
                        SelectFieldOption::make()
                            ->label(__('State'))
                            ->choices(['' => __('-- All states --')] + $states)
                            ->selected(Arr::get($attributes, 'state_id'))
                    );
                }

                $cities = City::query()
                    ->wherePublished()
                    ->pluck('name', 'id')
                    ->all();

                if ($cities) {
                    $form->add(
                        'city_id',
                        SelectField::class,
                        SelectFieldOption::make()
                            ->label(__('City'))
                            ->choices(['' => __('-- All cities --')] + $cities)
                            ->selected(Arr::get($attributes, 'city_id'))
                    );
                }
            }

            return $form;
        });

        add_shortcode('featured-job-categories', __('Featured job categories'), __('Featured job categories'), function (Shortcode $shortcode) {
            $categories = Category::query()
                ->wherePublished()
                ->where('is_featured', true)
                ->oldest('order')->latest()
                ->limit((int) $shortcode->limit ?: 8)
                ->with(['slugable', 'metadata', 'activeChildren.activeChildren.activeChildren'])
                ->get();

            if (($shortcode->show_jobs_count ?? 'yes') == 'yes') {
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

            return Theme::partial('shortcodes.featured-job-categories', compact('shortcode', 'categories', 'page'));
        });

        shortcode()->setAdminConfig('featured-job-categories', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add(
                    'title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Title'))
                        ->placeholder(__('Title'))
                )
                ->add(
                    'subtitle',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Subtitle'))
                        ->placeholder(__('Subtitle'))
                )
                ->add(
                    'show_jobs_count',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Show jobs count?'))
                        ->choices(['yes' => __('Yes'), 'no' => __('No')])
                        ->selected(Arr::get($attributes, 'show_jobs_count', 'yes'))
                )
                ->add(
                    'limit',
                    NumberField::class,
                    NumberFieldOption::make()
                        ->label(__('Limit'))
                        ->placeholder(__('Limit'))
                        ->defaultValue(8)
                );
        });

        add_shortcode('job-categories', __('Job categories'), __('Job categories'), function (Shortcode $shortcode) {
            $categories = Category::query()
                ->wherePublished()
                ->oldest('order')->latest()
                ->with(['slugable', 'activeChildren.activeChildren.activeChildren'])
                ->get();

            // Add jobs count including child categories if show_jobs_count is enabled
            if (($shortcode->show_jobs_count ?? 'yes') == 'yes') {
                Category::addJobsCountWithChildren($categories);
            }

            return Theme::partial('shortcodes.job-categories', compact('shortcode', 'categories'));
        });

        shortcode()->setAdminConfig('job-categories', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add(
                    'title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Title'))
                        ->placeholder(__('Title'))
                )
                ->add(
                    'subtitle',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Subtitle'))
                        ->placeholder(__('Subtitle'))
                )
                ->add(
                    'badge',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Badge'))
                        ->placeholder(__('Badge'))
                )
                ->add(
                    'show_jobs_count',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Show jobs count?'))
                        ->choices(['yes' => __('Yes'), 'no' => __('No')])
                        ->selected(Arr::get($attributes, 'show_jobs_count', 'yes'))
                );
        });

        add_shortcode('job-companies', __('Job companies'), __('Job companies'), function (Shortcode $shortcode) {
            $with = ['slugable'];
            if (is_plugin_active('location')) {
                $with[] = 'state';
            }

            $companies = Company::query()
                ->wherePublished()
                ->with($with)
                ->withCount([
                    'activeJobs as jobs_count',
                    'reviews',
                    'reviews as reviews_avg' => function (Builder $query): void {
                        $query->select(DB::raw('AVG(star)'));
                    },
                ])
                ->pinFeatured();

            $companies = match (request()->input('order_by')) {
                'oldest' => $companies->orderBy('created_at', 'ASC'),
                'jobs' => $companies->orderBy('jobs_count', 'DESC'),
                default => $companies->orderBy('created_at', 'DESC'),
            };

            $keyword = BaseHelper::stringify(request()->input('keyword'));

            $companies = $companies->when($keyword, function (Builder $query, $keyword) {
                if (
                    is_plugin_active('language') &&
                    is_plugin_active('language-advanced') &&
                    Language::getCurrentLocale() != Language::getDefaultLocale()
                ) {
                    return $query->where(function (Builder $query) use ($keyword): void {
                        $query->where('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhereHas('translations', function (Builder $query) use ($keyword): void {
                                $query->where('name', 'LIKE', '%' . $keyword . '%');
                            });
                    });
                }

                return $query->where('name', 'LIKE', '%' . $keyword . '%');
            });

            $companies = $companies->paginate($shortcode->number_per_page ?: 9);

            return Theme::partial('shortcodes.job-companies', compact('shortcode', 'companies'));
        });

        shortcode()->setAdminConfig('job-companies', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add(
                    'title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Title'))
                        ->placeholder(__('Title'))
                )
                ->add(
                    'number_per_page',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Number per page'))
                        ->placeholder(__('Number per page'))
                );
        });

        add_shortcode('job-candidates', __('Candidate list'), __('Candidate list'), function (Shortcode $shortcode) {
            request()->merge(['per_page' => $shortcode->number_per_page ?? 9]);

            $candidates = JobBoardHelper::filterCandidates(request()->input());

            return Theme::partial('shortcodes.job-candidates', compact('shortcode', 'candidates'));
        });

        shortcode()->setAdminConfig('job-candidates', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add(
                    'title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Title'))
                        ->placeholder(__('Title'))
                )
                ->add(
                    'number_per_page',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Number per page'))
                        ->placeholder(__('Number per page'))
                )
                ->add(
                    'style',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Style'))
                        ->choices(['list' => __('List'), 'grid' => __('Grid')])
                        ->selected(Arr::get($attributes, 'style', 'list'))
                );
        });

        add_shortcode('job-tabs', __('Job tabs'), __('Job tabs'), function (Shortcode $shortcode) {
            $with = [
                'slugable',
                'jobTypes',
                'company',
                'company.slugable',
                'tags',
                'tags.slugable',
                'jobExperience',
            ];

            if (is_plugin_active('location')) {
                $with = array_merge($with, array_keys(Location::getSupported(Job::class)));
            }

            $featuredJobs = app(JobInterface::class)->getFeaturedJobs(10, $with);

            return Theme::partial('shortcodes.job-tabs', compact('shortcode', 'featuredJobs'));
        });

        shortcode()->setAdminConfig('job-tabs', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add(
                    'title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Title'))
                        ->placeholder(__('Title'))
                )
                ->add(
                    'subtitle',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Subtitle'))
                        ->placeholder(__('Subtitle'))
                );
        });

        add_shortcode('featured-companies', __('Featured companies'), __('Featured companies'), function (Shortcode $shortcode) {
            $companyIds = [];
            $images = [];
            $attributes = $shortcode->toArray();

            for ($i = 1; $i < 7; $i++) {
                if (! empty($attributes['company_id_' . $i])) {
                    $companyIds[] = $attributes['company_id_' . $i];

                    $images[$attributes['company_id_' . $i]] = Arr::get($attributes, 'image_' . $i);
                }
            }

            $companyIds = array_filter($companyIds);

            $companies = Company::query()
                ->wherePublished()
                ->whereIn('id', $companyIds)->latest()
                ->with(['slugable'])
                ->get();

            if (count($images)) {
                foreach ($companies as &$company) {
                    if (! empty($images[$company->id])) {
                        $company->logo = $images[$company->id];
                    }
                }
            }

            return Theme::partial('shortcodes.featured-companies', compact('shortcode', 'companies'));
        });

        shortcode()->setAdminConfig('featured-companies', function (array $attributes) {
            $companies = Company::query()
                ->wherePublished()
                ->pluck('name', 'id')
                ->all();

            $form = ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading();

            for ($i = 1; $i < 7; $i++) {
                $form
                    ->add(
                        'company_id_' . $i,
                        SelectField::class,
                        SelectFieldOption::make()
                            ->label(__('Select company :count', ['count' => $i]))
                            ->choices(['' => __('-- select --')] + $companies)
                            ->selected(Arr::get($attributes, 'company_id_' . $i))
                    )
                    ->add(
                        'image_' . $i,
                        MediaImageField::class,
                        MediaImageFieldOption::make()
                            ->label(__('Select image :count (optional)', ['count' => $i]))
                    );
            }

            return $form;
        });

        add_shortcode('post-a-job', __('Post a job'), __('Post a job'), function (Shortcode $shortcode) {
            return Theme::partial('shortcodes.post-a-job', compact('shortcode'));
        });

        shortcode()->setAdminConfig('post-a-job', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add(
                    'title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Title'))
                        ->placeholder(__('Title'))
                )
                ->add(
                    'highlight_text',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Highlight text in title'))
                        ->placeholder(__('Highlight text in title'))
                )
                ->add(
                    'subtitle',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Subtitle'))
                        ->placeholder(__('Subtitle'))
                )
                ->add(
                    'button_text',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Button text'))
                        ->placeholder(__('Button text'))
                );
        });

        shortcode()->ignoreLazyLoading(['job-list', 'job-companies', 'job-candidates']);
    }

    if (is_plugin_active('testimonial')) {
        add_shortcode('testimonials', __('Testimonials'), __('Testimonials'), function (Shortcode $shortcode) {
            $testimonials = Testimonial::query()->wherePublished()->get();

            return Theme::partial('shortcodes.testimonials', compact('shortcode', 'testimonials'));
        });

        shortcode()->setAdminConfig('testimonials', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add(
                    'title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Title'))
                        ->placeholder(__('Title'))
                )
                ->add(
                    'subtitle',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Subtitle'))
                        ->placeholder(__('Subtitle'))
                );
        });
    }

    if (is_plugin_active('blog')) {
        add_shortcode('featured-news', __('Featured news'), __('Featured news'), function (Shortcode $shortcode) {
            $posts = Post::query()
                ->wherePublished()
                ->where('is_featured', true)
                ->limit(3)
                ->with(['slugable', 'author'])
                ->orderBy('created_at', 'desc')
                ->get();

            return Theme::partial('shortcodes.featured-news', compact('shortcode', 'posts'));
        });

        shortcode()->setAdminConfig('featured-news', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add(
                    'title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Title'))
                        ->placeholder(__('Title'))
                )
                ->add(
                    'subtitle',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Subtitle'))
                        ->placeholder(__('Subtitle'))
                );
        });
    }

    if (is_plugin_active('contact')) {
        add_filter(CONTACT_FORM_TEMPLATE_VIEW, function () {
            return Theme::getThemeNamespace() . '::partials.shortcodes.contact-form';
        }, 120);

        shortcode()->setAdminConfig('contact-form', function (array $attributes) {
            $form = ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add(
                    'title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Title'))
                        ->placeholder(__('Title'))
                )
                ->add(
                    'subtitle',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Subtitle'))
                        ->placeholder(__('Subtitle'))
                )
                ->add(
                    'image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Image'))
                )
                ->add(
                    'phone',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Phone'))
                        ->placeholder(__('Phone'))
                )
                ->add(
                    'email',
                    'email',
                    [
                        'label' => __('Email'),
                        'placeholder' => __('Email'),
                    ]
                )
                ->add(
                    'address',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Address'))
                        ->placeholder(__('Address'))
                );

            if (is_plugin_active('newsletter')) {
                $form->add(
                    'show_newsletter',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Show newsletter form'))
                        ->choices(['yes' => __('Yes'), 'no' => __('No')])
                        ->selected(Arr::get($attributes, 'show_newsletter', 'yes'))
                );
            }

            return $form;
        });
    }

    if (is_plugin_active('faq')) {
        add_shortcode('faq', __('FAQs'), __('FAQs'), function (Shortcode $shortcode) {
            $categories = FaqCategory::query()
                ->wherePublished()
                ->with(['faqs' => function (HasMany $query): void {
                    $query->wherePublished();
                }])
                ->oldest('order')->latest()
                ->get();

            return Theme::partial('shortcodes.faq', compact('shortcode', 'categories'));
        });

        shortcode()->setAdminConfig('faq', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add(
                    'title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Title'))
                        ->placeholder(__('Title'))
                )
                ->add(
                    'show_hotline',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Show hotline'))
                        ->choices(['yes' => __('Yes'), 'no' => __('No')])
                        ->selected(Arr::get($attributes, 'show_hotline', 'yes'))
                )
                ->add(
                    'show_email',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Show email'))
                        ->choices(['yes' => __('Yes'), 'no' => __('No')])
                        ->selected(Arr::get($attributes, 'show_email', 'yes'))
                );
        });
    }
});
