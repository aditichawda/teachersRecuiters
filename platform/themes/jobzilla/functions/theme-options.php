<?php

use Botble\Theme\Events\RenderingThemeOptionSettings;
use Botble\Theme\Facades\ThemeOption;
use Botble\Theme\ThemeOption\Fields\ColorField;
use Botble\Theme\ThemeOption\Fields\ToggleField;
use Botble\Theme\ThemeOption\ThemeOptionSection;

app('events')->listen(RenderingThemeOptionSettings::class, function (): void {
    ThemeOption::setSection(
        ThemeOptionSection::make('opt-text-subsection-styles')
            ->title(__('Styles'))
            ->icon('ti ti-palette')
            ->fields([
                ColorField::make()
                    ->name('primary_color')
                    ->label(__('Primary color'))
                    ->defaultValue('#1967d2'),
                ColorField::make()
                    ->name('primary_color_dark')
                    ->label(__('Primary color dark'))
                    ->defaultValue('#f51b18'),
                ColorField::make()
                    ->name('top_header_background_color')
                    ->label(__('Top header background color'))
                    ->defaultValue('#1967d2'),
                ColorField::make()
                    ->name('top_header_text_color')
                    ->label(__('Top header text color'))
                    ->defaultValue('#fff'),
                ColorField::make()
                    ->name('main_header_background_color')
                    ->label(__('Main header background color'))
                    ->defaultValue('transparent'),
                ColorField::make()
                    ->name('main_header_text_color')
                    ->label(__('Main header text color'))
                    ->defaultValue('#2f2f2f'),
                ColorField::make()
                    ->name('main_header_border_color')
                    ->label(__('Main header border color'))
                    ->defaultValue('transparent'),
            ])
    );

    ThemeOption::setField([
            'id' => 'preloader_enabled',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'customSelect',
            'label' => __('Enable Preloader?'),
            'attributes' => [
                'name' => 'preloader_enabled',
                'list' => [
                    'yes' => trans('core/base::base.yes'),
                    'no' => trans('core/base::base.no'),
                ],
                'value' => 'yes',
            ],
        ])
        ->setField([
            'id' => 'primary_font',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'googleFonts',
            'label' => __('Primary font'),
            'attributes' => [
                'name' => 'primary_font',
                'value' => 'Rubik',
            ],
        ])
        ->setField([
            'id' => 'secondary_font',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'googleFonts',
            'label' => __('Secondary font'),
            'attributes' => [
                'name' => 'secondary_font',
                'value' => 'Poppins',
            ],
        ])
        ->setField([
            'id' => 'footer_background',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'mediaImage',
            'label' => __('Footer background'),
            'attributes' => [
                'name' => 'footer_background',
                'value' => '',
            ],
        ])
        ->setField([
            'id' => '404_page_image',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'mediaImage',
            'label' => __('404 page image'),
            'attributes' => [
                'name' => '404_page_image',
                'value' => '',
            ],
        ])
        ->setField([
            'id' => 'sign_in_page_image',
            'section_id' => 'opt-text-subsection-page',
            'type' => 'mediaImage',
            'label' => __('Sign in page image'),
            'attributes' => [
                'name' => 'sign_in_page_image',
                'value' => '',
            ],
        ])
        ->setField([
            'id' => 'sign_up_page_image',
            'section_id' => 'opt-text-subsection-page',
            'type' => 'mediaImage',
            'label' => __('Sign up page image'),
            'attributes' => [
                'name' => 'sign_up_page_image',
                'value' => '',
            ],
        ])
        ->setField([
            'id' => 'reset_password_page_image',
            'section_id' => 'opt-text-subsection-page',
            'type' => 'mediaImage',
            'label' => __('Reset password page image'),
            'attributes' => [
                'name' => 'reset_password_page_image',
                'value' => '',
            ],
        ])
        ->setField([
            'id' => 'signup_login_modal_image',
            'section_id' => 'opt-text-subsection-page',
            'type' => 'mediaImage',
            'label' => __('Sign up / Login popup left image'),
            'attributes' => [
                'name' => 'signup_login_modal_image',
                'value' => '',
            ],
        ])
        ->setField([
            'id' => 'logo_light',
            'section_id' => 'opt-text-subsection-logo',
            'type' => 'mediaImage',
            'label' => __('Logo light'),
            'attributes' => [
                'name' => 'logo_light',
                'value' => '',
            ],
        ])
        ->setField([
            'id' => 'background_breadcrumb_default',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'mediaImage',
            'label' => __('Background breadcrumb default'),
            'attributes' => [
                'name' => 'background_breadcrumb_default',
                'value' => '',
            ],
        ])
        ->setField([
            'id' => 'number_of_post_in_row',
            'section_id' => 'opt-text-subsection-blog',
            'type' => 'customSelect',
            'label' => __('Number of post in row'),
            'attributes' => [
                'name' => 'number_of_post_in_row',
                'list' => [
                    1 => __('One Post'),
                    2 => __('Two Posts'),
                    3 => __('Three Posts'),
                    4 => __('Four Posts'),
                ],
                'value' => 3,
            ],
        ])
        ->setField([
            'id' => 'style_box_post',
            'section_id' => 'opt-text-subsection-blog',
            'type' => 'customSelect',
            'label' => __('Choose style box post?'),
            'attributes' => [
                'name' => 'style_box_post',
                'list' => [
                    1 => __('Style 1'),
                    2 => __('Style 2'),
                    3 => __('Style 3'),
                ],
                'value' => 1,
            ],
        ])
        ->setField(
            ToggleField::make()
                ->sectionId('opt-text-subsection-blog')
                ->name('blog_post_detail_show_featured_image')
                ->label(__('Show featured image on post detail page'))
                ->helperText(__('Enable to display the featured image at the top of blog post detail pages'))
                ->defaultValue(false)
        )
        ->setField([
            'id' => 'jobs_list_page_layout',
            'section_id' => 'opt-text-subsection-job-board',
            'type' => 'customSelect',
            'label' => __('Jobs list page layout'),
            'attributes' => [
                'name' => 'jobs_list_page_layout',
                'list' => [
                    'list' => __('List'),
                    'grid' => __('Grid'),
                    'map' => __('Map'),
                ],
                'value' => '',
                'options' => [
                    'class' => 'form-control',
                ],
            ],
        ])
        ->setField([
            'id' => 'primary_font',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'googleFonts',
            'label' => __('Primary font'),
            'attributes' => [
                'name' => 'primary_font',
                'value' => 'Rubik',
            ],
        ])
        ->setField([
            'id' => 'secondary_font',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'googleFonts',
            'label' => __('Secondary font'),
            'attributes' => [
                'name' => 'secondary_font',
                'value' => 'Poppins',
            ],
        ])
        ->setField([
            'id' => 'primary_color',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'customColor',
            'label' => __('Primary color'),
            'attributes' => [
                'name' => 'primary_color',
                'value' => '#1967d2',
            ],
        ])
        ->setField([
            'id' => 'address',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'text',
            'label' => __('Address'),
            'attributes' => [
                'name' => 'address',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 255,
                ],
            ],
        ])
        ->setField([
            'id' => 'email',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'email',
            'label' => __('Email'),
            'attributes' => [
                'name' => 'email',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 255,
                ],
            ],
        ])
        ->setField([
            'id' => 'hotline',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'text',
            'label' => __('Hotline'),
            'attributes' => [
                'name' => 'hotline',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 255,
                ],
            ],
        ]);
});
