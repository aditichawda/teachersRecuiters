<?php

namespace Database\Seeders\Themes\Jobzilla;

use Botble\Base\Supports\BaseSeeder;
use Botble\Page\Database\Traits\HasPageSeeder;
use Botble\Theme\Database\Traits\HasThemeOptionSeeder;
use Botble\Theme\Supports\ThemeSupport;

class ThemeOptionSeeder extends BaseSeeder
{
    use HasThemeOptionSeeder;
    use HasPageSeeder;

    public function run(): void
    {
        $this->uploadFiles('themes/jobzilla/general');

        $this->createThemeOptions([
            'site_title' => 'JobZilla - Laravel Job Board Script',
            'copyright' => '©%Y Botble Technologies. All right reserved.',
            'favicon' => 'themes/jobzilla/general/favicon.png',
            'logo' => 'themes/jobzilla/general/logo.png',
            'hotline' => '+(123) 345-6789',
            'address' => '65 Sunset CA 90026, USA',
            'cookie_consent_message' => 'Your experience on this site will be improved by allowing cookies ',
            'cookie_consent_learn_more_url' => '/cookie-policy',
            'cookie_consent_learn_more_text' => 'Cookie Policy',
            'homepage_id' => 1,
            'blog_page_id' => 5,
            'preloader_enabled' => 'no',
            'job_categories_page_id' => 12,
            'job_companies_page_id' => 13,
            'job_candidates_page_id' => 15,
            'job_list_page_id' => 16,
            'default_company_cover_image' => 'themes/jobzilla/general/job-detail-bg-2.jpg',
            'email' => 'contact@botble.com',
            '404_page_image' => 'themes/jobzilla/general/404.png',
            'logo_light' => 'themes/jobzilla/general/logo-light.png',
            'background_breadcrumb_default' => 'themes/jobzilla/general/background-breadcrumb.jpg',
            'number_of_post_in_row' => 2,
            'style_box_post' => 1,
            'jobs_list_page_layout' => 'list',
            'primary_font' => 'Rubik',
            'secondary_font' => 'Poppins',
            'primary_color' => '#1967d2',
            'primary_color_dark' => '#f51b18',
            'social_links' => ThemeSupport::getDefaultSocialLinksData(),
            'social_sharing' => ThemeSupport::getDefaultSocialSharingData(),
            'lazy_load_images' => true,
            'lazy_load_placeholder_image' => $this->filePath('themes/jobzilla/general/placeholder.png'),
            'newsletter_popup_enable' => true,
            'newsletter_popup_image' => $this->filePath('themes/jobzilla/general/newsletter-image.jpg'),
            'newsletter_popup_title' => 'Let’s join our newsletter!',
            'newsletter_popup_subtitle' => 'Weekly Updates',
            'newsletter_popup_description' => 'Do not worry we don’t spam!',
        ]);
    }
}
