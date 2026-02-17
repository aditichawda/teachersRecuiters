<?php

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Forms\FieldOptions\ColorFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\ColorField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Faq\Repositories\Interfaces\FaqCategoryInterface;
use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\Company;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\JobType;
use Botble\JobBoard\Repositories\Interfaces\AccountInterface;
use Botble\JobBoard\Repositories\Interfaces\CategoryInterface;
use Botble\JobBoard\Repositories\Interfaces\CompanyInterface;
use Botble\JobBoard\Repositories\Interfaces\JobInterface;
use Botble\JobBoard\Repositories\Interfaces\PackageInterface;
use Botble\Location\Models\City;
use Botble\Location\Models\State;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\Forms\FieldOptions\ShortcodeTabsFieldOption;
use Botble\Shortcode\Forms\Fields\ShortcodeTabsField;
use Botble\Shortcode\Forms\ShortcodeForm;
use Botble\Testimonial\Repositories\Interfaces\TestimonialInterface;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Supports\ThemeSupport;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

app()->booted(function (): void {
    ThemeSupport::registerGoogleMapsShortcode();
    ThemeSupport::registerYoutubeShortcode();

    add_shortcode('hero-banner', __('Hero banner'), __('Hero banner'), function ($shortcode) {
        $jobCategories = app(CategoryInterface::class)
            ->advancedGet([
                'condition' => [
                    'is_featured' => 1,
                ],
            ]);

        return Theme::partial('shortcodes.hero-banner.index', compact('shortcode', 'jobCategories'));
    });

    shortcode()->setAdminConfig('hero-banner', function ($attributes) {
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
                'browse_job',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Browse job'))
                    ->placeholder(__('Browse job'))
            )
            ->add(
                'description',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Description'))
                    ->placeholder(__('Description'))
            )
            ->add(
                'gradient_text',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Gradient text'))
                    ->placeholder(__('Gradient text'))
            )
            ->add(
                'title_bottom',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title bottom'))
                    ->placeholder(__('Title bottom'))
            )
            ->add(
                'subtitle_bottom',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle bottom'))
                    ->placeholder(__('Subtitle bottom'))
            )
            ->add(
                'banner_1',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Banner 1'))
            )
            ->add(
                'banner_2',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Banner 2'))
            )
            ->add(
                'bg_image_1',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background image 1'))
            )
            ->add(
                'bg_image_2',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background image 2'))
            )
            ->add(
                'bg_image_3',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background image 3'))
            )
            ->add(
                'button_name',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button name'))
                    ->placeholder(__('Button name'))
            )
            ->add(
                'button_url',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button URL'))
                    ->placeholder(__('Button URL'))
            )
            ->add(
                'popular_searches',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Popular searches'))
                    ->placeholder(__('Popular searches'))
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
                        'style-4' => __('Style 4'),
                        'style-5' => __('Style 5'),
                        'style-6' => __('Style 6'),
                        'style-7' => __('Style 7'),
                        'style-8' => __('Style 8'),
                    ])
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Tabs'))
                    ->fields([
                        'title' => [
                            'type' => 'text',
                            'title' => __('Title'),
                        ],
                        'count' => [
                            'type' => 'number',
                            'title' => __('Count'),
                        ],
                        'extra' => [
                            'type' => 'text',
                            'title' => __('Extra'),
                        ],
                        'image' => [
                            'type' => 'image',
                            'title' => __('Image'),
                        ],
                    ])
                    ->attrs($attributes)
            );

        return $form;
    });

    add_shortcode('quotation', __('Quotation'), __('Quotation'), function ($shortcode) {
        return Theme::partial('shortcodes.quotation.index', compact('shortcode'));
    });

    shortcode()->setAdminConfig('quotation', function ($attributes) {
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
                'recommended',
                NumberField::class,
                NumberFieldOption::make()
                    ->label(__('Recommended'))
                    ->placeholder(__('Recommended'))
            )
            ->add(
                'style',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Style'))
                    ->choices([
                        'style-1' => __('Style 1'),
                        'style-2' => __('Style 2'),
                    ])
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Tabs'))
                    ->fields([
                        'title' => [
                            'type' => 'text',
                            'title' => __('Title'),
                        ],
                        'subtitle' => [
                            'type' => 'text',
                            'title' => __('Subtitle'),
                        ],
                        'monthly_price' => [
                            'type' => 'text',
                            'title' => __('Monthly price'),
                        ],
                        'annual_price' => [
                            'type' => 'text',
                            'title' => __('Annual price'),
                        ],
                        'link' => [
                            'type' => 'text',
                            'title' => __('Link'),
                        ],
                        'title_link' => [
                            'type' => 'text',
                            'title' => __('Title link'),
                        ],
                        'checked' => [
                            'type' => 'text',
                            'title' => __('Checked list'),
                            'helper' => __('Enter a list with checked, separated by semicolons'),
                        ],
                        'uncheck' => [
                            'type' => 'text',
                            'title' => __('Uncheck list'),
                            'helper' => __('Enter a list with unchecked, separated by semicolons'),
                        ],
                    ])
                    ->attrs($attributes)
            );

        return $form;
    });

    add_shortcode('how-it-works', __('How It Works'), __('How It Works'), function ($shortcode) {
        return Theme::partial('shortcodes.how-it-works.index', compact('shortcode'));
    });

    shortcode()->setAdminConfig('how-it-works', function ($attributes) {
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
                'check_list',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Check list'))
                    ->placeholder(__('Check list'))
            )
            ->add(
                'image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image'))
            )
            ->add(
                'bg_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background image'))
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
                        'style-4' => __('Style 4'),
                        'style-7' => __('Style 7'),
                    ])
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Tabs'))
                    ->fields([
                        'title' => [
                            'type' => 'text',
                            'title' => __('Title'),
                        ],
                        'subtitle' => [
                            'type' => 'text',
                            'title' => __('Subtitle'),
                        ],
                        'image' => [
                            'type' => 'image',
                            'title' => __('Image'),
                        ],
                        'bg_color' => [
                            'type' => 'color',
                            'title' => __('Background color'),
                        ],
                    ])
                    ->attrs($attributes)
            );

        return $form;
    });

    add_shortcode('how-to-get-your-job', __('How To Get Your Job'), __('How To Get Your Job'), function ($shortcode) {
        return Theme::partial('shortcodes.how-to-get-your-job.index', compact('shortcode'));
    });

    shortcode()->setAdminConfig('how-to-get-your-job', function ($attributes) {
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
                'description',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Description'))
                    ->placeholder(__('Description'))
            )
            ->add(
                'image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image'))
            )
            ->add(
                'bg_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background image'))
            )
            ->add(
                'button_name',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button name'))
                    ->placeholder(__('Button name'))
            )
            ->add(
                'button_url',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button URL'))
                    ->placeholder(__('Button URL'))
            )
            ->add(
                'icon',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Icon'))
                    ->placeholder(__('Icon'))
            )
            ->add(
                'icon_title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Icon title'))
                    ->placeholder(__('Icon title'))
            )
            ->add(
                'icon_subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Icon subtitle'))
                    ->placeholder(__('Icon subtitle'))
            );

        for ($i = 1; $i <= 2; $i++) {
            $form->add(
                'tab_' . $i,
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Tab :number', ['number' => $i]))
                    ->fields([
                        'title' => [
                            'type' => 'text',
                            'title' => __('Title'),
                        ],
                        'subtitle' => [
                            'type' => 'text',
                            'title' => __('Subtitle'),
                        ],
                        'image' => [
                            'type' => 'image',
                            'title' => __('Image'),
                        ],
                        'site_button_title' => [
                            'type' => 'text',
                            'title' => __('Site button title'),
                        ],
                        'site_button_link' => [
                            'type' => 'text',
                            'title' => __('Site button link'),
                        ],
                        'bg_color' => [
                            'type' => 'color',
                            'title' => __('Background color'),
                        ],
                    ])
                    ->attrs($attributes)
                    ->max(1)
                    ->min(1)
            );
        }

        return $form;
    });

    add_shortcode('explore-new-life', __('Explore new life'), __('Explore new life'), function ($shortcode) {
        return Theme::partial('shortcodes.explore-new-life.index', compact('shortcode'));
    });

    shortcode()->setAdminConfig('explore-new-life', function ($attributes) {
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
                'description',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Description'))
                    ->placeholder(__('Description'))
            )
            ->add(
                'image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image'))
            )
            ->add(
                'bg_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background image'))
            )
            ->add(
                'button_name',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button name'))
                    ->placeholder(__('Button name'))
            )
            ->add(
                'button_url',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button URL'))
                    ->placeholder(__('Button URL'))
            )
            ->add(
                'button_icon',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button icon'))
                    ->placeholder(__('Button icon'))
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
                        'style-4' => __('Style 4'),
                        'style-5' => __('Style 5'),
                    ])
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Tabs'))
                    ->fields([
                        'title' => [
                            'type' => 'text',
                            'title' => __('Title'),
                        ],
                        'count' => [
                            'type' => 'number',
                            'title' => __('Count'),
                        ],
                        'extra' => [
                            'type' => 'text',
                            'title' => __('Extra'),
                        ],
                        'image' => [
                            'type' => 'image',
                            'title' => __('Image'),
                        ],
                    ])
                    ->attrs($attributes)
            );

        return $form;
    });

    add_shortcode('coming-soon', __('Coming Soon'), __('Coming Soon'), function ($shortcode) {
        return Theme::partial('shortcodes.coming-soon.index', compact('shortcode'));
    });

    shortcode()->setAdminConfig('coming-soon', function ($attributes) {
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
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Date'))
                    ->placeholder(__('Date'))
                    ->helperText(__('Format: Y-m-d'))
            )
            ->add(
                'time',
                'time',
                [
                    'label' => __('Time'),
                    'placeholder' => __('Time'),
                ]
            )
            ->add(
                'bg_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background image'))
            );

        if (is_plugin_active('newsletter')) {
            $form
                ->add(
                    'description',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Description'))
                        ->placeholder(__('Description'))
                )
                ->add(
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

    add_shortcode('job-banner', __('Job Banner'), __('Job Banner'), function ($shortcode) {
        $companies = app(CompanyInterface::class)
            ->advancedGet([
                'condition' => [
                    'is_featured' => 1,
                    'status' => BaseStatusEnum::PUBLISHED,
                ],
                'withCount' => [
                    'reviews',
                    'jobs',
                ],
                'withAvg' => [
                    'reviews',
                    'star',
                ],
                'take' => 10,
                'orderBy' => [
                    'created_at' => 'DESC',
                ],
            ]);

        return Theme::partial('shortcodes.job-banner.index', compact('shortcode', 'companies'));
    });

    shortcode()->setAdminConfig('job-banner', function ($attributes) {
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
                'description',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Description'))
                    ->placeholder(__('Description'))
            )
            ->add(
                'title_company_slider',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title company slider'))
                    ->placeholder(__('Title company slider'))
            )
            ->add(
                'image_job_1',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image job 1'))
            )
            ->add(
                'image_job_2',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image job 2'))
            )
            ->add(
                'image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image'))
            )
            ->add(
                'count_job_available',
                NumberField::class,
                NumberFieldOption::make()
                    ->label(__('Count job available'))
                    ->placeholder(__('Count job available'))
            )
            ->add(
                'button_primary_label',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button primary label'))
                    ->placeholder(__('Button primary label'))
            )
            ->add(
                'button_primary_action',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button primary action'))
                    ->placeholder(__('Button primary action'))
            )
            ->add(
                'button_secondary_label',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button secondary label'))
                    ->placeholder(__('Button secondary label'))
            )
            ->add(
                'button_secondary_action',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button secondary action'))
                    ->placeholder(__('Button secondary action'))
            )
            ->add(
                'style',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Style'))
                    ->choices([
                        'style-1' => __('Style 1'),
                        'style-2' => __('Style 2'),
                    ])
            );
    });

    add_shortcode('counter-information', __('Counter information'), __('Counter information'), function ($shortcode) {
        return Theme::partial('shortcodes.counter-information.index', compact('shortcode'));
    });

    shortcode()->setAdminConfig('counter-information', function ($attributes) {
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
                'bg_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background image'))
            )
            ->add(
                'style',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Style'))
                    ->choices([
                        'style-1' => __('Style 1'),
                        'style-2' => __('Style 2'),
                    ])
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Tabs'))
                    ->fields([
                        'title' => [
                            'type' => 'text',
                            'title' => __('Title'),
                        ],
                        'count' => [
                            'type' => 'number',
                            'title' => __('Count'),
                        ],
                        'extra' => [
                            'type' => 'text',
                            'title' => __('Extra'),
                        ],
                        'image' => [
                            'type' => 'image',
                            'title' => __('Image'),
                        ],
                        'icon' => [
                            'type' => 'themeIcon',
                            'title' => __('Icon'),
                        ],
                    ])
                    ->attrs($attributes)
            );

        return $form;
    });

    if (is_plugin_active('testimonial')) {
        add_shortcode('testimonials', __('Testimonials'), __('Testimonials'), function ($shortcode) {
            $testimonials = app(TestimonialInterface::class)->advancedGet([
                'condition' => [
                    'status' => BaseStatusEnum::PUBLISHED,
                ],
                'take' => (int) $shortcode->limit,
            ]);

            return Theme::partial('shortcodes.testimonials.index', compact('shortcode', 'testimonials'));
        });

        shortcode()->setAdminConfig('testimonials', function ($attributes) {
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
                    'description',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Description'))
                        ->placeholder(__('Description'))
                )
                ->add(
                    'highlight',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Highlight'))
                        ->placeholder(__('Highlight'))
                )
                ->add(
                    'limit',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Limit'))
                        ->placeholder(__('Limit'))
                )
                ->add(
                    'link',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Link'))
                        ->placeholder(__('Link'))
                )
                ->add(
                    'text_link',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Text link'))
                        ->placeholder(__('Text link'))
                )
                ->add(
                    'testimonial_outline_text',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Testimonial outline text'))
                        ->placeholder(__('Testimonial outline text'))
                )
                ->add(
                    'bg_color',
                    ColorField::class,
                    ColorFieldOption::make()
                        ->label(__('Background color'))
                )
                ->add(
                    'icon_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Icon image'))
                )
                ->add(
                    'banner_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Banner image'))
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
                            'style-7' => __('Style 7'),
                            'style-8' => __('Style 8'),
                        ])
                );
        });
    }

    if (is_plugin_active('job-board')) {
        add_shortcode('featured-companies', __('Featured companies'), __('Featured companies'), function ($shortcode) {
            $limit = (int) $shortcode->limit ?: 12;
            $with = ['slugable'];
            if (is_plugin_active('location')) {
                $with[] = 'state';
            }

            $companies = app(CompanyInterface::class)->getModel()
                ->select(['jb_companies.*'])
                ->where('jb_companies.status', BaseStatusEnum::PUBLISHED)
                ->with($with)
                ->withCount([
                    'jobs' => function (Builder $query): void {
                        // @phpstan-ignore-next-line
                        $query
                            ->where([
                                    'jb_jobs.hide_company' => false,
                                ] + JobBoardHelper::getJobDisplayQueryConditions())
                            ->notExpired();
                    },
                    'reviews',
                    'reviews as reviews_avg' => function (Builder $query): void {
                        $query->select(DB::raw('AVG(star)'));
                    },
                ])
                ->pinFeatured();

            // @phpstan-ignore-next-line
            $latestJob = Job::query()
                ->whereColumn('jb_jobs.company_id', 'jb_companies.id')
                ->where([
                        'jb_jobs.hide_company' => false,
                    ] + JobBoardHelper::getJobDisplayQueryConditions())
                ->notExpired();

            $orderBy = request()->input('order_by');

            switch ($orderBy) {
                case 'newest':
                    $latestJob = $latestJob->selectRaw('MAX(jb_jobs.created_at)');
                    $companies = $companies->selectSub($latestJob, 'job_created_at')
                        ->orderByRaw('ISNULL(job_created_at) ASC, job_created_at DESC');

                    break;
                case 'oldest':
                    $latestJob = $latestJob->selectRaw('MIN(jb_jobs.created_at)');
                    $companies = $companies->selectSub($latestJob, 'job_created_at')
                        ->orderByRaw('ISNULL(job_created_at) ASC, job_created_at ASC');

                    break;
                case 'jobs':
                    $companies = $companies->orderBy('jobs_count', 'DESC');

                    break;
                case 'random':
                    $companies = $companies->inRandomOrder();

                    break;
                default:
                    break;
            }

            $companies = $companies->paginate($limit);

            return Theme::partial('shortcodes.featured-companies.index', compact('shortcode', 'companies'));
        });

        shortcode()->setAdminConfig('featured-companies', function ($attributes) {
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
                    'limit',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Number of displays'))
                        ->placeholder(__('Number of displays'))
                        ->defaultValue('12')
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
                            'style-7' => __('Style 7'),
                            'style-8' => __('Style 8'),
                        ])
                )
                ->add(
                    'tabs',
                    ShortcodeTabsField::class,
                    ShortcodeTabsFieldOption::make()
                        ->label(__('Tabs'))
                        ->fields([
                            'title' => [
                                'type' => 'text',
                                'title' => __('Title'),
                            ],
                            'count' => [
                                'type' => 'number',
                                'title' => __('Count'),
                            ],
                            'extra' => [
                                'type' => 'text',
                                'title' => __('Extra'),
                            ],
                        ])
                        ->attrs($attributes)
                );

            return $form;
        });

        add_shortcode('jobs-list', __('Jobs List'), __('Jobs List'), function ($shortcode) {
            $jobs = app(JobInterface::class)->getFeaturedJobs((int) $shortcode->limit ?: 10);

            return Theme::partial('shortcodes.jobs-list.index', compact('shortcode', 'jobs'));
        });

        shortcode()->setAdminConfig('jobs-list', function ($attributes) {
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
                    'limit',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Number of displays'))
                        ->placeholder(__('Number of displays'))
                )
                ->add(
                    'type',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Type'))
                        ->choices([
                            'default' => __('Default'),
                            'featured' => __('Featured'),
                        ])
                )
                ->add(
                    'style',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Style'))
                        ->choices([
                            '1' => __('Style 1'),
                            '2' => __('Style 2'),
                            '3' => __('Style 3'),
                        ])
                )
                ->add(
                    'per_row',
                    NumberField::class,
                    NumberFieldOption::make()
                        ->label(__('Items per row'))
                        ->placeholder(__('Items per row'))
                );
        });

        add_shortcode('job-board-jobs', __('Job board - Jobs'), __('Job board - Jobs'), function ($shortcode) {
            $requestQuery = JobBoardHelper::getJobFilters(request()->input());

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
                        'per_page' => Arr::get($requestQuery, 'per_page') ?: (int) $shortcode->limit ?: 10,
                        'current_paged' => request()->integer('page'),
                    ],
                ],
            );

            return Theme::partial('shortcodes.jobs.index', compact('shortcode', 'jobs'));
        });

        shortcode()->setAdminConfig('job-board-jobs', function ($attributes) {
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
                    'number_of_displays',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Number of displays'))
                        ->placeholder(__('Number of displays'))
                )
                ->add(
                    'type',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Type'))
                        ->choices([
                            'default' => __('Default'),
                            'featured' => __('Featured'),
                        ])
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
                            'style-4' => __('Style 4'),
                            'style-7' => __('Style 7'),
                            'list' => __('List - Full page'),
                            'list-with-map' => __('List with map - Full page'),
                        ])
                )
                ->add(
                    'layout',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Layout'))
                        ->choices([
                            'grid-2' => __('Grid 2'),
                            'grid-3' => __('Grid 3'),
                            'grid-3x' => __('Grid 3x - Background blue'),
                            'list' => __('List'),
                            'recommend' => __('Recommend'),
                        ])
                );
        });

        add_shortcode('job-board-recommend', __('Job board - Recommend'), __('Job board - Recommend'), function ($shortcode) {
            $requestQuery = JobBoardHelper::getJobFilters(request()->input());

            $perPage = Arr::get($requestQuery, 'per_page') ?: (int) $shortcode->limit ?: 10;

            $jobs = app(JobInterface::class)->getJobs(
                $requestQuery,
                [
                    'order_by' => [
                        'jb_jobs.created_at' => 'desc',
                        'jb_jobs.is_featured' => 'desc',
                    ],
                    'paginate' => [
                        'per_page' => $perPage > 0 ? $perPage : 10,
                        'current_paged' => $requestQuery['page'],
                    ],
                ],
            );

            $jobTypes = JobType::query()->wherePublished()->get();

            return Theme::partial('shortcodes.recommend.index', compact('shortcode', 'jobs', 'jobTypes'));
        });

        shortcode()->setAdminConfig('job-board-recommend', function ($attributes) {
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
                    'button_name',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Button name'))
                        ->placeholder(__('Button name'))
                )
                ->add(
                    'limit',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Limit'))
                        ->placeholder(__('Limit'))
                )
                ->add(
                    'type',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Type'))
                        ->choices([
                            'default' => __('Default'),
                            'featured' => __('Featured'),
                        ])
                );
        });

        add_shortcode('featured-job-categories', __('Job board - Featured Categories'), __('Job board - Featured Categories'), function ($shortcode) {
            $limit = (int) $shortcode->limit ?: 12;

            $categories = app(CategoryInterface::class)->getFeaturedCategories($limit);

            return Theme::partial('shortcodes.featured-categories.index', compact('shortcode', 'categories'));
        });

        shortcode()->setAdminConfig('featured-job-categories', function ($attributes) {
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
                    'description',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Description'))
                        ->placeholder(__('Description'))
                )
                ->add(
                    'limit',
                    NumberField::class,
                    NumberFieldOption::make()
                        ->label(__('Limit'))
                        ->placeholder(__('Limit'))
                        ->defaultValue(6)
                )
                ->add(
                    'bg_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Background image'))
                )
                ->add(
                    'button_action_label',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Button action label'))
                        ->placeholder(__('Button action label'))
                )
                ->add(
                    'button_action_url',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Button action URL'))
                        ->placeholder(__('Button action URL'))
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
                            'style-4' => __('Style 4'),
                            'style-5' => __('Style 5'),
                            'style-6' => __('Style 6'),
                        ])
                );
        });

        add_shortcode('job-categories', __('Job board - Categories'), __('Job board - Categories'), function ($shortcode) {
            $perPage = (int) $shortcode->per_page ?: 15;

            $categories = app(CategoryInterface::class)->advancedGet([
                'condition' => [
                    'status' => BaseStatusEnum::PUBLISHED,
                ],
                'paginate' => [
                    'per_page' => $perPage,
                    'current_paged' => request()->integer('page') ?: 1,
                ],
                'order_by' => ['order' => 'ASC', 'created_at' => 'DESC'],
                'with' => ['slugable'],
                'withCount' => ['activeJobs'],
            ]);

            return Theme::partial('shortcodes.categories.index', compact('shortcode', 'categories'));
        });

        shortcode()->setAdminConfig('job-categories', function ($attributes) {
            return Theme::partial('shortcodes.categories.admin-config', compact('attributes'));
        });

        add_shortcode('job-board-candidates', __('Job board - Candidates'), __('Job board - Candidates'), function ($shortcode) {
            // Check if user is authenticated and is an employer
            $account = auth('account')->user();
            if (!$account || !$account->isEmployer()) {
                $message = __('Only employers can view candidates. Please login as an employer to access this page.');
                return '<div class="alert alert-warning" style="padding: 20px; margin: 20px 0; border: 1px solid #ffc107; background-color: #fff3cd; border-radius: 4px;">
                    <h4 style="margin-top: 0;">' . __('Access Denied') . '</h4>
                    <p>' . $message . '</p>
                    <p><a href="' . route('public.account.login') . '" class="btn btn-primary">' . __('Login') . '</a></p>
                </div>';
            }

            $with = ['avatar'];

            if (! JobBoardHelper::isDisabledPublicProfile()) {
                $with = ['avatar', 'slugable'];
            }

            $condition = [
                ['is_public_profile', '=', 1],
                ['type', '=', AccountTypeEnum::JOB_SEEKER],
            ];

            if (setting('verify_account_email', 0)) {
                $condition[] = ['confirmed_at', '!=', null];
            }

            $candidates = app(AccountInterface::class)
                ->select(['jb_accounts.*'])
                ->where($condition)
                ->with($with);

            $style = $shortcode->style;
            $orderBy = $shortcode->order_by;
            if ($style == 'list') {
                $orderBy = request()->input('order_by') ?: $orderBy;
            }

            $candidates = match ($orderBy) {
                'newest' => $candidates->orderBy('created_at', 'DESC'),
                'oldest' => $candidates->orderBy('created_at', 'ASC'),
                'random' => $candidates->inRandomOrder(),
                default => $candidates
                    ->orderBy('is_featured', 'DESC')
                    ->orderBy('views', 'DESC'),
            };

            $candidates = $candidates->paginate($shortcode->number_per_page ?? 12);

            return Theme::partial('shortcodes.candidates.index', compact('shortcode', 'candidates'));
        });

        shortcode()->setAdminConfig('job-board-candidates', function ($attributes) {
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
                    'number_per_page',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Number per page'))
                        ->placeholder(__('Number per page'))
                )
                ->add(
                    'bg_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Background Image'))
                )
                ->add(
                    'bg_map_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Background Map Image'))
                )
                ->add(
                    'map_title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Map Title'))
                        ->placeholder(__('Map Title'))
                )
                ->add(
                    'map_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Map Image'))
                )
                ->add(
                    'style',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Style'))
                        ->choices([
                            'style-1' => __('Style 1'),
                            'style-7' => __('Style 7'),
                            'list' => __('List'),
                        ])
                )
                ->add(
                    'layout',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Layout'))
                        ->choices([
                            'grid' => __('Grid'),
                            'list' => __('List'),
                            'list-2' => __('List - 2 column'),
                            'list-7' => __('List - 4 column'),
                        ])
                )
                ->add(
                    'order_by',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Order by'))
                        ->choices([
                            'default' => __('Default - Featured / Views'),
                            'newest' => __('Newest'),
                            'oldest' => __('Oldest'),
                            'random' => __('Random'),
                        ])
                )
                ->add(
                    'tabs',
                    ShortcodeTabsField::class,
                    ShortcodeTabsFieldOption::make()
                        ->label(__('Tabs'))
                        ->fields([
                            'title' => [
                                'type' => 'text',
                                'title' => __('Name Country'),
                            ],
                            'image' => [
                                'type' => 'image',
                                'title' => __('Image'),
                            ],
                        ])
                        ->attrs($attributes)
                );

            return $form;
        });

        add_shortcode('job-companies', __('Job companies'), __('Job companies'), function ($shortcode) {
            $companies = Company::query()
                ->wherePublished()
                ->withCount(['jobs', 'reviews'])
                ->withAvg('reviews', 'star')->latest()
                ->paginate((int) $shortcode->paginate ?: 12);

            return Theme::partial('shortcodes.companies.index', compact('shortcode', 'companies'));
        });

        shortcode()->setAdminConfig('job-companies', function ($attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add(
                    'style',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Style'))
                        ->choices([
                            'grid' => __('Grid'),
                            'list' => __('List'),
                        ])
                );
        });

        if (is_plugin_active('location')) {
            add_shortcode('job-board-cities', __('Job board - Cities'), __('Job board - Cities'), function ($shortcode) {
                $cityIds = Shortcode::fields()->getIds('city_ids', $shortcode);

                $cities = City::query()
                    ->wherePublished()
                    ->whereIn('id', $cityIds)
                    ->select(['id', 'name', 'image', 'slug'])
                    ->withCount(['jobs'])
                    ->get();

                return Theme::partial('shortcodes.cities.index', compact('shortcode', 'cities'));
            });

            shortcode()->setAdminConfig('job-board-cities', function ($attributes) {
                return ShortcodeForm::createFromArray($attributes)
                    ->withLazyLoading()
                    ->add(
                        'title',
                        TextField::class,
                        TextFieldOption::make()
                            ->label(__('Title'))
                    )
                    ->add(
                        'subtitle',
                        TextField::class,
                        TextFieldOption::make()
                            ->label(__('Subtitle'))
                    )
                    ->add(
                        'button_action_url',
                        TextField::class,
                        TextFieldOption::make()
                            ->label(__('Button action URL'))
                    )
                    ->add(
                        'button_action_label',
                        TextField::class,
                        TextFieldOption::make()
                            ->label(__('Button action label'))
                    )
                    ->add(
                        'type',
                        SelectField::class,
                        SelectFieldOption::make()
                            ->label(__('Type'))
                            ->choices([
                                'jobs_count' => __('Default - Jobs count'),
                                'order' => __('Order in city'),
                                'random' => __('Random'),
                            ])
                    )
                    ->add(
                        'style',
                        SelectField::class,
                        SelectFieldOption::make()
                            ->label(__('Style'))
                            ->choices([
                                1 => __('Style 1'),
                                2 => __('Style 2'),
                            ])
                    )
                    ->add(
                        'city_ids',
                        SelectField::class,
                        SelectFieldOption::make()
                            ->label(__('Cities'))
                            ->collapsible('type', 'city', Arr::get($attributes, 'type', 'city'))
                            ->searchable()
                            ->multiple()
                            ->choices(
                                City::query()
                                    ->wherePublished()
                                    ->pluck('name', 'id')
                                    ->all()
                            )
                            ->selected(explode(',', Arr::get($attributes, 'city_ids')))
                    );
            });
        }

        add_shortcode('job-board-search-bar', __('Job board - Search bar'), __('Job board - Search bar'), function ($shortcode) {
            return Theme::partial('shortcodes.search-bar.index', compact('shortcode'));
        });

        shortcode()->setAdminConfig('job-board-search-bar', function ($attributes) {
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
                    'popular_searches',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Popular Searches'))
                        ->placeholder(__('Popular searches'))
                )
                ->add(
                    'form_size',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Form size'))
                        ->choices([
                            'default' => __('Default'),
                            'mini' => __('Form mini'),
                        ])
                )
                ->add(
                    'tab_title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Tab title'))
                        ->placeholder(__('Tab title'))
                )
                ->add(
                    'tabs',
                    ShortcodeTabsField::class,
                    ShortcodeTabsFieldOption::make()
                        ->label(__('Tabs'))
                        ->fields([
                            'link' => [
                                'type' => 'text',
                                'title' => __('Link'),
                                'helper' => 'https://domain.com',
                            ],
                            'image' => [
                                'type' => 'image',
                                'title' => __('Image'),
                            ],
                        ])
                        ->attrs($attributes)
                );

            return $form;
        });

        // Jobs by Categories (Jobs by location / designation / etc.)
        add_shortcode('jobs-by-categories', __('Jobs by Categories'), __('Jobs by Categories'), function ($shortcode) {
            // Locations (states)
            $locations = collect();

            if (is_plugin_active('location')) {
                $locationLimit = (int) ($shortcode->location_limit ?: 20);

                $locations = State::query()
                    ->wherePublished()
                    ->orderBy('order')
                    ->orderBy('name')
                    ->limit($locationLimit)
                    ->get();
            }

            // Job roles (categories) - root level or specific parent
            $jobRoleLimit = (int) ($shortcode->job_role_limit ?: 20);
            $jobRoleParentId = !empty($shortcode->job_role_parent_id) ? (int) $shortcode->job_role_parent_id : 0;

            $jobRoles = app(CategoryInterface::class)->advancedGet([
                'condition' => [
                    'status' => BaseStatusEnum::PUBLISHED,
                    'parent_id' => $jobRoleParentId,
                ],
                'order_by' => ['order' => 'ASC', 'created_at' => 'DESC'],
                'take' => $jobRoleLimit,
                'with' => ['slugable'],
                'withCount' => ['activeJobs'],
            ]);

            // Teaching subjects (categories) - root level or specific parent
            $teachingSubjectLimit = (int) ($shortcode->teaching_subject_limit ?: 20);
            $teachingSubjectParentId = !empty($shortcode->teaching_subject_parent_id) ? (int) $shortcode->teaching_subject_parent_id : 0;

            $teachingSubjects = app(CategoryInterface::class)->advancedGet([
                'condition' => [
                    'status' => BaseStatusEnum::PUBLISHED,
                    'parent_id' => $teachingSubjectParentId,
                ],
                'order_by' => ['order' => 'ASC', 'created_at' => 'DESC'],
                'take' => $teachingSubjectLimit,
                'with' => ['slugable'],
                'withCount' => ['activeJobs'],
            ]);

            // Institution types (categories) - root level or specific parent
            $institutionTypeLimit = (int) ($shortcode->institution_type_limit ?: 20);
            $institutionTypeParentId = !empty($shortcode->institution_type_parent_id) ? (int) $shortcode->institution_type_parent_id : 0;

            $institutionTypes = app(CategoryInterface::class)->advancedGet([
                'condition' => [
                    'status' => BaseStatusEnum::PUBLISHED,
                    'parent_id' => $institutionTypeParentId,
                ],
                'order_by' => ['order' => 'ASC', 'created_at' => 'DESC'],
                'take' => $institutionTypeLimit,
                'with' => ['slugable'],
                'withCount' => ['activeJobs'],
            ]);

            return Theme::partial('shortcodes.jobs-by-categories.index', compact(
                'shortcode',
                'locations',
                'jobRoles',
                'teachingSubjects',
                'institutionTypes'
            ));
        });

        shortcode()->setAdminConfig('jobs-by-categories', function ($attributes) {
            $categories = app(CategoryInterface::class)->advancedGet([
                'condition' => ['status' => BaseStatusEnum::PUBLISHED],
            ]);

            $categoryChoices = [0 => __('-- None (Root Categories) --')] + $categories->pluck('name', 'id')->all();

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
                    'location_limit',
                    NumberField::class,
                    NumberFieldOption::make()
                        ->label(__('Location limit'))
                        ->placeholder(__('Number of locations to display'))
                        ->defaultValue(20)
                )
                ->add(
                    'job_role_parent_id',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Job Role Parent Category'))
                        ->choices($categoryChoices)
                        ->selected(Arr::get($attributes, 'job_role_parent_id', 0))
                )
                ->add(
                    'job_role_limit',
                    NumberField::class,
                    NumberFieldOption::make()
                        ->label(__('Job role limit'))
                        ->placeholder(__('Number of job roles to display'))
                        ->defaultValue(20)
                )
                ->add(
                    'teaching_subject_parent_id',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Teaching Subject Parent Category'))
                        ->choices($categoryChoices)
                        ->selected(Arr::get($attributes, 'teaching_subject_parent_id', 0))
                )
                ->add(
                    'teaching_subject_limit',
                    NumberField::class,
                    NumberFieldOption::make()
                        ->label(__('Teaching Subject limit'))
                        ->placeholder(__('Number of teaching subjects to display'))
                        ->defaultValue(20)
                )
                ->add(
                    'institution_type_parent_id',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Institution Type Parent Category'))
                        ->choices($categoryChoices)
                        ->selected(Arr::get($attributes, 'institution_type_parent_id', 0))
                )
                ->add(
                    'institution_type_limit',
                    NumberField::class,
                    NumberFieldOption::make()
                        ->label(__('Institution Type limit'))
                        ->placeholder(__('Number of institution types to display'))
                        ->defaultValue(20)
                )
                ->add(
                    'bg_color',
                    ColorField::class,
                    ColorFieldOption::make()
                        ->label(__('Background color'))
                );
        });

        add_shortcode('top-companies', __('Top companies'), __('Top companies'), function ($shortcode) {
            $companies = app(CompanyInterface::class)
                ->advancedGet([
                    'condition' => [
                        'is_featured' => 1,
                        'status' => BaseStatusEnum::PUBLISHED,
                    ],
                    'withCount' => [
                        'reviews',
                        'jobs',
                    ],
                    'withAvg' => [
                        'reviews',
                        'star',
                    ],
                    'take' => (int) $shortcode->limit ?: 15,
                    'orderBy' => [
                        'created_at' => 'DESC',
                    ],
                ]);

            return Theme::partial('shortcodes.top-companies.index', compact('shortcode', 'companies'));
        });

        shortcode()->setAdminConfig('top-companies', function ($attributes) {
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
                    'limit',
                    NumberField::class,
                    NumberFieldOption::make()
                        ->label(__('Limit'))
                        ->placeholder(__('Limit'))
                )
                ->add(
                    'button_action_label',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Button action label'))
                        ->placeholder(__('Button action label'))
                )
                ->add(
                    'button_action_url',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Button action URL'))
                        ->placeholder(__('Button action URL'))
                );
        });

        add_shortcode('job-of-the-days', __('Job of the days'), __('Job of the days'), function ($shortcode) {
            $jobs = app(JobInterface::class)->getFeaturedJobs((int) $shortcode->limit ?: 6);

            return Theme::partial('shortcodes.job-of-the-days.index', compact('shortcode', 'jobs'));
        });

        shortcode()->setAdminConfig('job-of-the-days', function ($attributes) {
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
                    'limit',
                    NumberField::class,
                    NumberFieldOption::make()
                        ->label(__('Limit'))
                        ->placeholder(__('Limit'))
                        ->defaultValue(6)
                )
                ->add(
                    'button_name',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Button name'))
                        ->placeholder(__('Button name'))
                )
                ->add(
                    'bg_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Background image'))
                );
        });

        add_shortcode('featured-jobs', __('Featured Jobs'), __('Featured Jobs'), function ($shortcode) {
            $jobs = app(JobInterface::class)->getFeaturedJobs((int) $shortcode->limit ?: 6);

            return Theme::partial('shortcodes.featured-jobs.index', compact('shortcode', 'jobs'));
        });

        shortcode()->setAdminConfig('featured-jobs', function ($attributes) {
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
                    'limit',
                    NumberField::class,
                    NumberFieldOption::make()
                        ->label(__('Limit'))
                        ->placeholder(__('Limit'))
                        ->defaultValue(6)
                )
                ->add(
                    'image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Image'))
                )
                ->add(
                    'button_label',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Button label'))
                        ->placeholder(__('Button label'))
                )
                ->add(
                    'button_action',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Button action'))
                        ->placeholder(__('Button action'))
                );
        });

        add_shortcode('packages', __('Packages - Pricing Table'), __('Packages - Pricing Table'), function ($shortcode) {
            if ($shortcode->package_ids) {
                $packages = app(PackageInterface::class)->advancedGet([
                    'condition' => [
                        'status' => BaseStatusEnum::PUBLISHED,
                        'IN' => ['id', 'IN', explode(',', $shortcode->package_ids)],
                    ],
                    'order_by' => ['created_at' => 'DESC'],
                ]);
            } else {
                $packages = collect();
            }

            return Theme::partial('shortcodes.packages.index', compact('shortcode', 'packages'));
        });

        shortcode()->setAdminConfig('packages', function ($attributes) {
            $packages = app(PackageInterface::class)->advancedGet([
                'condition' => ['status' => BaseStatusEnum::PUBLISHED],
            ]);

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
                    'package_ids',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Choose packages'))
                        ->choices($packages->pluck('name', 'id')->all())
                        ->selected(explode(',', Arr::get($attributes, 'package_ids', '')))
                        ->multiple()
                );
        });
    }

    if (is_plugin_active('blog')) {
        add_shortcode('blog-posts', __('Blog - Posts'), __('Blog - Posts'), function ($shortcode) {
            $numberOfDisplays = (int) $shortcode->limit ?: 3;
            $category = null;
            $posts = collect();
            $with = ['author', 'slugable'];

            if ($shortcode->category_id) {
                $category = get_category_by_id($shortcode->category_id);
                if ($category) {
                    $posts = get_posts_by_category($category->id, 0, $numberOfDisplays);
                }
            }

            if (! $category) {
                $posts = match ($shortcode->type) {
                    'featured' => get_featured_posts($numberOfDisplays, $with),
                    'recent' => get_recent_posts($numberOfDisplays),
                    default => get_latest_posts($numberOfDisplays, $with),
                };
            }

            if ($posts instanceof EloquentCollection) {
                $posts->loadMissing($with);
            }

            return Theme::partial('shortcodes.blog.posts.index', compact('shortcode', 'posts', 'category'));
        });

        shortcode()->setAdminConfig('blog-posts', function ($attributes) {
            $categories = [0 => __('-- None --')] + collect(get_categories_with_children())->pluck('name', 'id')->toArray();

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
                    'button_action_label',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Button action label'))
                        ->placeholder(__('Button action label'))
                )
                ->add(
                    'button_action_url',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Button action URL'))
                        ->placeholder(__('Button action URL'))
                )
                ->add(
                    'category_id',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Category'))
                        ->choices($categories)
                )
                ->add(
                    'type',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Type'))
                        ->choices([
                            'default' => __('Default'),
                            'featured' => __('Featured'),
                            'recent' => __('Recent'),
                        ])
                )
                ->add(
                    'limit',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Limit'))
                        ->placeholder(__('Limit'))
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
                            'style-4' => __('Style 4'),
                            'style-5' => __('Style 5'),
                            'style-6' => __('Style 6'),
                            'style-7' => __('Style 7'),
                            'style-8' => __('Style 8'),
                        ])
                );
        });
    }

    if (is_plugin_active('contact')) {
        add_filter(CONTACT_FORM_TEMPLATE_VIEW, function () {
            return Theme::getThemeNamespace('partials.shortcodes.contact.form');
        }, 120);

        shortcode()->setAdminConfig('contact-form', function ($attributes) {
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
                    'image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Image'))
                )
                ->add(
                    'phone_title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Phone title'))
                        ->placeholder(__('Phone title'))
                )
                ->add(
                    'phone_1',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Phone 1'))
                        ->placeholder(__('Phone 1'))
                )
                ->add(
                    'phone_2',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Phone 2'))
                        ->placeholder(__('Phone 2'))
                )
                ->add(
                    'email_title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Email title'))
                        ->placeholder(__('Email title'))
                )
                ->add(
                    'email_1',
                    'email',
                    [
                        'label' => __('Email 1'),
                        'placeholder' => __('Email 1'),
                    ]
                )
                ->add(
                    'email_2',
                    'email',
                    [
                        'label' => __('Email 2'),
                        'placeholder' => __('Email 2'),
                    ]
                )
                ->add(
                    'address_title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Address title'))
                        ->placeholder(__('Address title'))
                )
                ->add(
                    'address_1',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Address 1'))
                        ->placeholder(__('Address 1'))
                )
                ->add(
                    'address_2',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Address 2'))
                        ->placeholder(__('Address 2'))
                );
        });
    }

    if (is_plugin_active('faq')) {
        add_shortcode('faq', __('FAQs'), __('FAQs'), function ($shortcode) {
            $categories = app(FaqCategoryInterface::class)
                ->advancedGet([
                    'condition' => [
                        'status' => BaseStatusEnum::PUBLISHED,
                    ],
                    'with' => [
                        'faqs' => function ($query): void {
                            $query->where('status', BaseStatusEnum::PUBLISHED);
                        },
                    ],
                    'order_by' => [
                        'faq_categories.order' => 'ASC',
                        'faq_categories.created_at' => 'DESC',
                    ],
                ]);

            return Theme::partial('shortcodes.faq.index', compact('shortcode', 'categories'));
        });

        shortcode()->setAdminConfig('faq', function ($attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add(
                    'title',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Title'))
                        ->placeholder(__('Title'))
                );
        });
    }

    if (is_plugin_active('newsletter')) {
        add_shortcode('newsletter-minimal', __('Newsletter minimal'), __('Newsletter minimal'), function ($shortcode) {
            return Theme::partial('shortcodes.newsletter-minimal.index', compact('shortcode'));
        });

        shortcode()->setAdminConfig('newsletter-minimal', function ($attributes) {
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
                    'bg_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Background image'))
                );

            // Add 7 icon images
            for ($i = 1; $i <= 7; $i++) {
                $form->add(
                    'icon_image_' . $i,
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Icon image :number', ['number' => $i]))
                );
            }

            return $form;
        });

        add_shortcode('newsletter-large', __('Newsletter large'), __('Newsletter large'), function ($shortcode) {
            return Theme::partial('shortcodes.newsletter-large.index', compact('shortcode'));
        });

        shortcode()->setAdminConfig('newsletter-large', function ($attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->withLazyLoading()
                ->add(
                    'title_primary',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Title primary'))
                        ->placeholder(__('Title primary'))
                )
                ->add(
                    'subtitle_primary',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Subtitle primary'))
                        ->placeholder(__('Subtitle primary'))
                )
                ->add(
                    'title_secondary',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Title secondary'))
                        ->placeholder(__('Title secondary'))
                )
                ->add(
                    'subtitle_secondary',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Subtitle secondary'))
                        ->placeholder(__('Subtitle secondary'))
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
                );
        });
    }
});
