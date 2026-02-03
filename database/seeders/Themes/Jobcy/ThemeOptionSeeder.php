<?php

namespace Database\Seeders\Themes\Jobcy;

use Botble\Base\Supports\BaseSeeder;
use Botble\Page\Models\Page;
use Botble\Theme\Database\Traits\HasThemeOptionSeeder;
use Botble\Theme\Supports\ThemeSupport;

class ThemeOptionSeeder extends BaseSeeder
{
    use HasThemeOptionSeeder;

    public function run(): void
    {
        $this->uploadFiles('themes/jobcy/general');

        $this->createThemeOptions([
            'site_title' => 'Jobcy - Laravel Job Board Script',
            'seo_description' => 'Jobcy – is a modern job board Laravel script designed to connect people looking for a job with work hunting employers. This script represents simple design to help build the website for advertising vacancies, finding suitable staff, receiving employer’s resumes and CV',
            'copyright' => '©%Y Botble Technologies. All right reserved.',
            'favicon' => 'themes/jobcy/general/favicon.png',
            'logo' => 'themes/jobcy/general/logo.png',
            'hotline' => '+(123) 345-6789',
            'cookie_consent_message' => 'Your experience on this site will be improved by allowing cookies ',
            'cookie_consent_learn_more_url' => '/cookie-policy',
            'cookie_consent_learn_more_text' => 'Cookie Policy',
            'homepage_id' => Page::query()->value('id'),
            'blog_page_id' => Page::query()->skip(1)->value('id'),
            'preloader_enabled' => 'no',
            'job_categories_page_id' => Page::query()->skip(9)->value('id'),
            'job_companies_page_id' => Page::query()->skip(10)->value('id'),
            'job_candidates_page_id' => Page::query()->skip(14)->value('id'),
            'job_list_page_id' => Page::query()->skip(16)->value('id'),
            'default_company_cover_image' => 'themes/jobcy/general/cover-image.jpg',
            'email' => 'contact@jobcy.com',
            '404_page_image' => 'themes/jobcy/general/404.png',
            'newsletter_popup_enable' => true,
            'newsletter_popup_image' => $this->filePath('themes/jobcy/general/newsletter-image.png'),
            'newsletter_popup_title' => 'Let’s join our newsletter!',
            'newsletter_popup_subtitle' => 'Weekly Updates',
            'newsletter_popup_description' => 'Do not worry we don’t spam!',
            'social_links' => ThemeSupport::getDefaultSocialLinksData(),
            'primary_color' => '#5749cd',
        ]);
    }
}
