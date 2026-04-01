<?php

namespace Database\Seeders\Themes\Jobcy;

use Botble\Base\Facades\Html;
use Botble\Base\Supports\BaseSeeder;
use Botble\Page\Models\Page;
use Botble\Slug\Facades\SlugHelper;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class PageSeeder extends BaseSeeder
{
    public function run(): void
    {
        Page::query()->truncate();

        $pages = [
            1 => [
                'name' => 'Homepage',
                'content' => Html::tag(
                    'div',
                    '[search-box subtitle="We have {count} live jobs" jobs_count="150,000+" title="Find your dream jobs with Jobcy" highlight_text="Jobcy" trending_keywords="Design,Development,Manager,Senior" description="Find jobs, create trackable resumes and enrich your applications.Carefully crafted after analyzing the needs of different industries." image="themes/jobcy/general/process-02.png"][/search-box]'
                ) .
                    Html::tag(
                        'div',
                        '[featured-job-categories title="Browser Jobs Categories" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers."][/featured-job-categories]'
                    ) .
                    Html::tag(
                        'div',
                        '[job-tabs title="New & Random Jobs" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers."][/job-tabs]'
                    ) .
                    Html::tag(
                        'div',
                        '[how-it-work title="How It Work" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers." step_1_title="Register an account" step_1_description="Due to its widespread use as filler text for layouts, non-readability is of great importance." step_1_image="themes/jobcy/general/how-it-work-1.png" step_2_title="Find your job" step_2_description="There are many variations of passages of avaibookmark-label, but the majority lteration in some form." step_2_image="themes/jobcy/general/how-it-work-2.png" step_3_title="Apply for job" step_3_description="It is a long established fact that a reader will be distracted by the radable content of a page." step_3_image="themes/jobcy/general/how-it-work-2.png"][/how-it-work]'
                    ) .
                    Html::tag(
                        'div',
                        '[post-a-job title="Browse Our 5,000+ Latest Jobs" highlight_text="5,000+" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers."][/post-a-job]'
                    ) .
                    Html::tag(
                        'div',
                        '[testimonials title="Happy Candidates" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers."][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-news title="Quick Career Tips" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers."][/featured-news]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-companies company_id_1="11" image_1="themes/jobcy/companies/17.png" company_id_2="12" image_2="themes/jobcy/companies/12.png" company_id_3="13" image_3="themes/jobcy/companies/13.png" company_id_4="14" image_4="themes/jobcy/companies/14.png" company_id_5="15" image_5="themes/jobcy/companies/15.png" company_id_6="16" image_6="themes/jobcy/companies/16.png"][/featured-companies]'
                    ),
                'template' => 'homepage',
            ],
            2 => [
                'name' => 'Blog',
                'content' => '---',
            ],
            3 => [
                'name' => 'Contact',
                'content' => Html::tag(
                    'div',
                    '[contact-form title="Get in touch" subtitle="Start working with Jobcy that can provide everything you need to generate awareness, drive traffic, connect." image="themes/jobcy/general/contact.png" email="contactus@Jobcy.com" address="2453 Clinton StreetLittle Rock, California, USA" phone="(+245) 223 1245"][/contact-form]'
                ) .
                    Html::tag(
                        'div',
                        '[google-map]North Link Building, 10 Admiralty Street, 757695 Singapore[/google-map]'
                    ),
            ],
            4 => [
                'name' => 'Cookie Policy',
                'content' => Html::tag('h3', 'EU Cookie Consent') .
                    Html::tag(
                        'p',
                        'To use this website we are using Cookies and collecting some Data. To be compliant with the EU GDPR we give you to choose if you allow us to use certain Cookies and to collect some Data.'
                    ) .
                    Html::tag('h4', 'Essential Data') .
                    Html::tag(
                        'ul',
                        Html::tag(
                            'li',
                            'The Essential Data is needed to run the Site you are visiting technically. You can not deactivate them.'
                        ) .
                        Html::tag(
                            'li',
                            'Session Cookie: PHP uses a Cookie to identify user sessions. Without this Cookie the Website is not working.'
                        ) .
                        Html::tag(
                            'li',
                            'XSRF-Token Cookie: Laravel automatically generates a CSRF "token" for each active user session managed by the application. This token is used to verify that the authenticated user is the one actually making the requests to the application.'
                        )
                    ),
                'template' => 'static',
            ],
            5 => [
                'name' => 'FAQ',
                'content' => Html::tag('div', '[faq title="Frequently Asked Questions"][/faq]'),
            ],
            6 => [
                'name' => 'About us',
                'template' => 'static',
            ],
            7 => [
                'name' => 'Services',
                'template' => 'static',
            ],
            8 => [
                'name' => 'Terms Of Use',
                'template' => 'static',
            ],
            9 => [
                'name' => 'Terms & Conditions',
                'template' => 'static',
            ],
            10 => [
                'name' => 'Job Categories',
                'content' => Html::tag(
                    'div',
                    '[job-categories badge="Jobs Live Today" title="Browse Job By Categories" subtitle="Post a job to tell us about your project. We’ll quickly match you with the right freelancers."][/job-categories]'
                ) .
                    Html::tag(
                        'div',
                        '[start-working title="See everything about your employee at one place." subtitle="Start working with Jobcy that can provide everything you need to generate awareness, drive traffic, connect." button_1_icon="uil uil-rocket" button_1_text="Get Started Now" button_1_url="#" button_2_icon="uil uil-capsule" button_2_text="Free Trial" button_2_url="#"][/start-working]'
                    ),
            ],
            11 => [
                'name' => 'companies',
                'content' => Html::tag('div', '[job-companies number_per_page="9"][/job-companies]'),
            ],
            12 => [
                'name' => 'Coming Soon',
                'content' => Html::tag(
                    'div',
                    '[coming-soon title="We’re Launching Soon..!!" subtitle="Start working with Jobcy that can provide everything you need to generate awareness, drive traffic, connect." date="' . Carbon::now()->addYear()->toDateTimeLocalString() . '" image="themes/jobcy/general/animat-rocket-color.gif"][/coming-soon]'
                ),
                'template' => 'coming-soon',
            ],
            13 => [
                'name' => 'Homepage 2',
                'content' => Html::tag(
                    'div',
                    '[search-box style="style-2" subtitle="We have {count} live jobs" jobs_count="150,000+" title="Search Between More Then 10,000+ Open Jobs." highlight_text="10,000+" description="" image="themes/jobcy/general/img-01.png" trending_keywords="Design,Development,Manager,Senior"][/search-box]'
                ) .
                Html::tag(
                    'div',
                    '[featured-job-categories title="Browser Jobs Categories" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers."][/featured-job-categories]'
                ) .
                Html::tag(
                    'div',
                    '[job-tabs title="New & Random Jobs" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers."][/job-tabs]'
                ) .
                Html::tag(
                    'div',
                    '[how-it-work title="How It Work" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers." step_1_title="Register an account" step_1_description="Due to its widespread use as filler text for layouts, non-readability is of great importance." step_1_image="themes/jobcy/general/how-it-work-1.png" step_2_title="Find your job" step_2_description="There are many variations of passages of avaibookmark-label, but the majority lteration in some form." step_2_image="themes/jobcy/general/how-it-work-2.png" step_3_title="Apply for job" step_3_description="It is a long established fact that a reader will be distracted by the radable content of a page." step_3_image="themes/jobcy/general/how-it-work-2.png"][/how-it-work]'
                ) .
                Html::tag(
                    'div',
                    '[post-a-job title="Browse Our 5,000+ Latest Jobs" highlight_text="5,000+" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers."][/post-a-job]'
                ) .
                Html::tag(
                    'div',
                    '[testimonials title="Happy Candidates" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers."][/testimonials]'
                ) .
                Html::tag(
                    'div',
                    '[featured-news title="Quick Career Tips" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers."][/featured-news]'
                ) .
                Html::tag(
                    'div',
                    '[featured-companies company_id_1="11" image_1="themes/jobcy/companies/17.png" company_id_2="12" image_2="themes/jobcy/companies/12.png" company_id_3="13" image_3="themes/jobcy/companies/13.png" company_id_4="14" image_4="themes/jobcy/companies/14.png" company_id_5="15" image_5="themes/jobcy/companies/15.png" company_id_6="16" image_6="themes/jobcy/companies/16.png"][/featured-companies]'
                ),
                'template' => 'homepage',
            ],
            14 => [
                'name' => 'Homepage 3',
                'content' => Html::tag(
                    'div',
                    '[search-box style="style-3" subtitle="We have {count} live jobs" jobs_count="150,000+" title="Thousand of Jobs is Waiting for you" trending_keywords="Design,Development,Manager,Senior" description="Find jobs, create trackable resumes and enrich your applications.Carefully crafted after analyzing the needs of different industries." images="themes/jobcy/general/img-02.jpg,themes/jobcy/general/img-03.jpg,themes/jobcy/general/img-04.jpg"][/search-box]'
                ) .
                Html::tag(
                    'div',
                    '[featured-job-categories title="Browser Jobs Categories" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers."][/featured-job-categories]'
                ) .
                Html::tag(
                    'div',
                    '[job-tabs title="New & Random Jobs" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers."][/job-tabs]'
                ) .
                Html::tag(
                    'div',
                    '[how-it-work title="How It Work" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers." step_1_title="Register an account" step_1_description="Due to its widespread use as filler text for layouts, non-readability is of great importance." step_1_image="themes/jobcy/general/how-it-work-1.png" step_2_title="Find your job" step_2_description="There are many variations of passages of avaibookmark-label, but the majority lteration in some form." step_2_image="themes/jobcy/general/how-it-work-2.png" step_3_title="Apply for job" step_3_description="It is a long established fact that a reader will be distracted by the radable content of a page." step_3_image="themes/jobcy/general/how-it-work-2.png"][/how-it-work]'
                ) .
                Html::tag(
                    'div',
                    '[post-a-job title="Browse Our 5,000+ Latest Jobs" highlight_text="5,000+" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers."][/post-a-job]'
                ) .
                Html::tag(
                    'div',
                    '[testimonials title="Happy Candidates" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers."][/testimonials]'
                ) .
                Html::tag(
                    'div',
                    '[featured-news title="Quick Career Tips" subtitle="Post a job to tell us about your project. We\'ll quickly match you with the right freelancers."][/featured-news]'
                ) .
                Html::tag(
                    'div',
                    '[featured-companies company_id_1="1" image_1="themes/jobcy/companies/12.png" company_id_2="12" image_2="themes/jobcy/companies/13.png" company_id_3="13" image_3="themes/jobcy/companies/14.png" company_id_4="14" image_4="themes/jobcy/companies/15.png" company_id_5="15" image_5="themes/jobcy/companies/16.png" company_id_6="16" image_6="themes/jobcy/companies/17.png"][/featured-companies]'
                ),
                'template' => 'homepage',
            ],
            15 => [
                'name' => 'Candidates Grid',
                'slug' => 'candidates',
                'content' => Html::tag('div', '[job-candidates style="grid" number_per_page="9"][/job-candidates]'),
            ],
            16 => [
                'name' => 'Candidates List',
                'content' => Html::tag('div', '[job-candidates number_per_page="9"][/job-candidates]'),
            ],
            17 => [
                'name' => 'Jobs',
                'content' => Html::tag('div', '[job-list][/job-list]'),
            ],
        ];

        $faker = fake();

        foreach ($pages as $item) {
            $item['user_id'] = 1;

            if (! isset($item['template'])) {
                $item['template'] = 'default';
            }

            if (! isset($item['content'])) {
                $item['content'] = Html::tag('p', $faker->realText(500)) . Html::tag('p', $faker->realText(500)) .
                    Html::tag('p', $faker->realText(500)) . Html::tag('p', $faker->realText(500));
            }

            $page = Page::query()->create(Arr::except($item, ['slug']));

            SlugHelper::createSlug($page);
        }
    }
}
