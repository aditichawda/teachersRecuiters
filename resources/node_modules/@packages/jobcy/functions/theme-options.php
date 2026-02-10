<?php

use Botble\Theme\Events\RenderingThemeOptionSettings;

use Botble\Theme\ThemeOption\Fields\ToggleField;

app('events')->listen(RenderingThemeOptionSettings::class, function (): void {
    theme_option()
        ->setField([
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
            'id' => 'hotline',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'text',
            'label' => __('Hotline'),
            'attributes' => [
                'name' => 'hotline',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 25,
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
                    'data-counter' => 120,
                ],
            ],
        ])
        ->setField([
            'id' => '404_page_image',
            'section_id' => 'opt-text-subsection-page',
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
        ->setSection([
            'title' => __('Style'),
            'desc' => __('Style of theme'),
            'id' => 'opt-text-subsection-style',
            'subsection' => true,
            'icon' => 'ti ti-brush',
        ])

        ->setField([
            'id' => 'primary_font',
            'section_id' => 'opt-text-subsection-style',
            'type' => 'googleFonts',
            'label' => __('Primary font'),
            'attributes' => [
                'name' => 'primary_font',
                'value' => 'Inter',
            ],
        ])
        ->setField([
            'id' => 'primary_color',
            'section_id' => 'opt-text-subsection-style',
            'type' => 'customColor',
            'label' => __('Primary color'),
            'attributes' => [
                'name' => 'primary_color',
                'value' => '#5749cd',
            ],
        ])
        ->setField(
            ToggleField::make()
                ->sectionId('opt-text-subsection-style')
                ->name('sticky_header_enabled')
                ->label(__('Enable sticky header'))
                ->defaultValue(true)
                ->priority(100)
        )
        ->setField(
            ToggleField::make()
                ->sectionId('opt-text-subsection-style')
                ->name('sticky_header_mobile_enabled')
                ->label(__('Enable sticky header on mobile'))
                ->defaultValue(true)
                ->priority(110)
        )
        ->setSection([
            'title' => __('Job Board'),
            'desc' => __('Job Board settings'),
            'id' => 'opt-text-subsection-job-board',
            'subsection' => true,
            'icon' => 'ti ti-briefcase',
        ])
        ->setField([
            'id' => 'post_a_job_url',
            'section_id' => 'opt-text-subsection-job-board',
            'type' => 'text',
            'label' => __('Post a job button URL'),
            'attributes' => [
                'name' => 'post_a_job_url',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => __('Leave empty to use default URL'),
                ],
            ],
        ])
        ->setField(
            ToggleField::make()
                ->sectionId('opt-text-subsection-blog')
                ->name('blog_post_detail_show_featured_image')
                ->label(__('Show featured image on post detail page'))
                ->helperText(__('Enable to display the featured image at the top of blog post detail pages'))
                ->defaultValue(false)
        );
});
