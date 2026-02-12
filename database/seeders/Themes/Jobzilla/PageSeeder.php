<?php

namespace Database\Seeders\Themes\Jobzilla;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\Html;
use Botble\Base\Facades\MetaBox;
use Botble\Base\Supports\BaseSeeder;
use Botble\Location\Models\City;
use Botble\Page\Models\Page;
use Botble\Slug\Facades\SlugHelper;
use Botble\Slug\Models\Slug;
use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class PageSeeder extends BaseSeeder
{
    public function run(): void
    {
        Page::query()->truncate();

        $this->uploadFiles('themes/jobzilla/account-icons');
        $this->uploadFiles('themes/jobzilla/countries');

        $contact = $this->contactShortcode();

        $pages = [
            [
                'name' => 'Homepage 1',
                'content' =>
                    Html::tag(
                        'div',
                        '[hero-banner title="We Have {{208,000+}} Live Jobs" subtitle="Your {{Dream Job}} in one place" description="Find jobs that match your interests with us. Jobzilla provides a place you to find your Job." popular_searches="Developer;Designer;Architect;Engineer" banner_1="themes/jobzilla/general/right-pic-1.jpg" banner_2="themes/jobzilla/general/right-pic-2.jpg" button_name="Get Started" button_url="/" bg_image_1="themes/jobzilla/general/bg2.jpg" style="style-2" quantity="3" title_1="companies Jobs" count_1="12" extra_1="K+" image_1="themes/jobzilla/general/icon-4.png" title_2="Job For Countries" count_2="98" extra_2="+" image_2="themes/jobzilla/general/icon-5.png" title_3="Jobs Done" count_3="3" extra_3="+" image_3="themes/jobzilla/general/icon-3.png" ][/hero-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[job-board-search-bar title="" tab_title="Trusted By:" popular_searches="Developer;Designer;Architect;Engineer" quantity="3" link_1="https://google.com" image_1="themes/jobzilla/general/trusted-1.png" image_2="themes/jobzilla/general/trusted-2.png" image_3="themes/jobzilla/general/trusted-3.png" ][/job-board-search-bar]'
                    ) .
                    Html::tag(
                        'div',
                        '[how-it-works title="How It Works" subtitle="Follow our steps we will help you." check_list="Trusted & Quality Job;International Job;No Extra Charge;Top companies" style="style-2" quantity="4" title_1="Register Your Account" subtitle_1="You need to create an account to find the best and preferred job." image_1="themes/jobzilla/general/icon1.png" bg_color_1="#3898e2" title_2="Search Your Job" subtitle_2="You need to create an account to find the best and preferred job." image_2="themes/jobzilla/general/icon4.png" bg_color_2="#e2b438" title_3="Apply For Dream Job" subtitle_3="You need to create an account to find the best and preferred job." image_3="themes/jobzilla/general/icon2.png" bg_color_3="#bc84ca" title_4="Upload Your Resume" subtitle_4="You need to create an account to find the best and preferred job." image_4="themes/jobzilla/general/icon3.png" bg_color_4="#56d8b1" ][/how-it-works]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-job-categories title="Choose Your Desire Category" subtitle="Jobs by Categories" description="Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever since the when an printer took." style="style-2" ][/featured-job-categories]'
                    ) .
                    Html::tag(
                        'div',
                        '[explore-new-life title="For Employee" subtitle="We help you connect with the organizer" description="Get paid easily and security. Use our resources to become independent and showcase your professional skills." image="themes/jobzilla/general/gir-large-2.png" button_url="/" style="style-2" quantity="3" title_1="Million daily active users" count_1="5" extra_1="M+" title_2="Open job positions" count_2="9" extra_2="K+" title_3="Million stories shared" count_3="2" extra_3="M+" ][/explore-new-life]'
                    ) .
                    Html::tag(
                        'div',
                        '[jobs-list title="Find Your Career You Deserve it" subtitle="All Jobs Post" limit="6" type="default" style="2" per_row="3"][/jobs-list]'
                    ) .
                    Html::tag(
                        'div',
                        '[explore-new-life title="Explore New Life" subtitle="Build your personal account profile" description="Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever since the when an printer took. lorem Ipsum is simply dummy text of the printing and typesetting industry." image="themes/jobzilla/general/boy-large.png" style="style-3" ][/explore-new-life]'
                    ) .
                    Html::tag(
                        'div',
                        '[testimonials title="What Our Customers Say About Us" subtitle="Clients Testimonials" style="style-2" ][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[blog-posts title="Latest Article" subtitle="Our Blogs" number_of_displays="4" style="style-2" ][/blog-posts]'
                    ),
                'template' => 'homepage',
            ],
            [
                'name' => 'Homepage 2',
                'content' =>
                    Html::tag(
                        'div',
                        '[hero-banner title="FIND TOP IT JOBS" subtitle="For talent Developers" description="Type your keyword, then click search to find your perfect job." popular_searches="Developer;Designer;Architect;Engineer" bg_image_1="themes/jobzilla/general/banner1.jpg" gradient_text="7,000+ BROWSE JOBS" style="style-3" quantity="3" title_1="companies Jobs" count_1="12" extra_1="K+" title_2="Job For Countries" count_2="98" extra_2="+" title_3="Jobs Done" count_3="3" extra_3="+" image_3="themes/jobzilla/general/icon-3.png" ][/hero-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-companies title="Get hired in top companies" subtitle="Top companies" style="style-2" quantity="3" title_1="Million daily active users" count_1="5" extra_1="M+" title_2="Open job positions" count_2="9" extra_2="K+" title_3="Million stories shared" count_3="2" extra_3="M+" ][/featured-companies]'
                    ) .
                    Html::tag(
                        'div',
                        '[how-it-works title="How It Works" subtitle="Working Process" style="style-3" quantity="3" title_1="Register Your Account" subtitle_1="You need to create an account to find the best and preferred job." image_1="themes/jobzilla/general/icon1.png" bg_color_1="#3898e2" title_2="Apply For Dream Job" subtitle_2="You need to create an account to find the best and preferred job." image_2="themes/jobzilla/general/icon2.png" bg_color_2="#bc84ca" title_3="Upload Your Resume" subtitle_3="You need to create an account to find the best and preferred job." image_3="themes/jobzilla/general/icon3.png" bg_color_3="#56d8b1" ][/how-it-works]'
                    ) .
                    Html::tag(
                        'div',
                        '[job-board-cities title="Featured Cities" subtitle="Browse job offers by popular locations"  city_ids="' . City::query()->limit(6)->pluck('id')->implode(', ') . '"][/job-board-cities]'
                    ) .
                    Html::tag(
                        'div',
                        '[jobs-list title="Find Your Career You Deserve it" subtitle="All Jobs Post" limit="4" type="default" style="2" per_row="2"][/jobs-list]'
                    ) .
                    Html::tag(
                        'div',
                        '[job-board-candidates title="Candidates" subtitle="Featured Candidates" style="style-1" layout="list-2" ][/job-board-candidates]'
                    ) .
                    Html::tag(
                        'div',
                        '[blog-posts title="Latest Article" subtitle="Our Blogs" number_of_displays="3" style="style-3" ][/blog-posts]'
                    ),
                'template' => 'homepage',
                'header_css_class' => 'header-style-light',
            ],
            [
                'name' => 'Homepage 3',
                'content' =>
                    Html::tag(
                        'div',
                        '[hero-banner title="We Have {{208,000+}} Live Jobs" subtitle="Find the {{job}} that fits your life" description="Type your keyword, then click search to find your perfect job." popular_searches="Developer;Designer;Architect;Engineer" banner_1="themes/jobzilla/general/r-img2.png" banner_2="themes/jobzilla/general/r-img1.png" bg_image_1="themes/jobzilla/general/bg1.jpg" gradient_text="Jobs" style="style-1" quantity="3" title_1="companies Jobs" count_1="12" extra_1="K+" image_1="themes/jobzilla/general/icon-2.png" title_2="Job For Countries" count_2="98" extra_2="+" image_2="themes/jobzilla/general/icon-1.png" title_3="Jobs Done" count_3="3" extra_3="+" image_3="themes/jobzilla/general/icon-3.png" ][/hero-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[how-it-works title="How It Works" subtitle="Working Process" style="style-1" quantity="3" title_1="Register Your Account" subtitle_1="You need to create an account to find the best and preferred job." image_1="themes/jobzilla/general/icon1.png" bg_color_1="#3898e2" title_2="Apply For Dream Job" subtitle_2="You need to create an account to find the best and preferred job." image_2="themes/jobzilla/general/icon2.png" bg_color_2="#bc84ca" title_3="Upload Your Resume" subtitle_3="You need to create an account to find the best and preferred job." image_3="themes/jobzilla/general/icon3.png" bg_color_3="#56d8b1" ][/how-it-works]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-job-categories title="Choose Your Desire Category" subtitle="Jobs by Categories" description="Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever since the when an printer took." style="style-1" ][/featured-job-categories]'
                    ) .
                    Html::tag(
                        'div',
                        '[explore-new-life title="Explore New Life" subtitle="Don’t just find be found put your CV in front of great employers" description="Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever since the when an printer took." image="themes/jobzilla/general/gir-large.png" bg_image="themes/jobzilla/general/bg.png" button_url="/" button_name="Upload Your Resume" button_icon="feather-upload" style="style-1" ][/explore-new-life]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-companies title="Get hired in top companies" subtitle="Top companies" style="style-1" quantity="3" title_1="Million daily active users" count_1="5" extra_1="M+" title_2="Open job positions" count_2="9" extra_2="K+" title_3="Million stories shared" count_3="2" extra_3="M+" ][/featured-companies]'
                    ) .
                    Html::tag(
                        'div',
                        '[jobs-list title="Find Your Career You Deserve it" subtitle="All Jobs Post" limit="5" type="default" style="1"][/jobs-list]'
                    ) .
                    Html::tag(
                        'div',
                        '[testimonials title="What Our Customers Say About Us" subtitle="Clients Testimonials" style="style-1" ][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[blog-posts title="Latest Article" subtitle="Our Blogs" number_of_displays="4" style="style-1" ][/blog-posts]'
                    ),
                'template' => 'homepage',
            ],
            [
                'name' => 'Homepage 4',
                'content' =>
                    Html::tag(
                        'div',
                        '[hero-banner title="" subtitle="Your {{Dream Job}} in one place" description="Find jobs that match your interests with us." popular_searches="Developer;Designer;Architect;Engineer" banner_1="themes/jobzilla/general/user.png" style="style-4" ][/hero-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-job-categories title="Choose Your Desire Category" subtitle="Jobs by Categories" description="Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever since the when an printer took." style="style-3" ][/featured-job-categories]'
                    ) .
                    Html::tag(
                        'div',
                        '[how-it-works title="How It Works" subtitle="Follow our steps we will help you." check_list="Trusted & Quality Job;International Job;No Extra Charge;Top companies" image="themes/jobzilla/general/main-bg.png" style="style-4" quantity="4" title_1="Register Your Account" subtitle_1="You need to create an account to find the best and preferred job." image_1="themes/jobzilla/general/icon1.png" bg_color_1="#3898e2" title_2="Search Your Job" subtitle_2="You need to create an account to find the best and preferred job." image_2="themes/jobzilla/general/icon4.png" bg_color_2="#e2b438" title_3="Apply For Dream Job" subtitle_3="You need to create an account to find the best and preferred job." image_3="themes/jobzilla/general/icon2.png" bg_color_3="#bc84ca" title_4="Upload Your Resume" subtitle_4="You need to create an account to find the best and preferred job." image_4="themes/jobzilla/general/icon3.png" bg_color_4="#56d8b1" ][/how-it-works]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-companies title="Get hired in top companies" subtitle="Top companies" style="style-3" quantity="3" title_1="Million daily active users" count_1="5" extra_1="M+" title_2="Open job positions" count_2="9" extra_2="K+" title_3="Million stories shared" count_3="2" extra_3="M+" ][/featured-companies]'
                    ) .
                    Html::tag(
                        'div',
                        '[explore-new-life title="About" subtitle="We help you connect with the organizer" description="Get paid easily and security. Use our resources to become independent and showcase your professional skills." image="themes/jobzilla/general/employee.png" button_url="/" style="style-4" quantity="3" title_1="Million daily active users" count_1="5" extra_1="M+" title_2="Open job positions" count_2="9" extra_2="K+" title_3="Million stories shared" count_3="2" extra_3="M+" ][/explore-new-life]'
                    ) .
                    Html::tag(
                        'div',
                        '[jobs-list title="Find Your Career You Deserve it" subtitle="All Jobs Post" limit="6" type="default" style="3" per_row="3"][/jobs-list]'
                    ) .
                    Html::tag(
                        'div',
                        '[quotation title="Choose Your Plan" subtitle="Save up to 10%" recommended="2" style="style-1" quantity="3" title_1="Basic" subtitle_1="" monthly_price_1="$90" annual_price_1="$149" link_1="/" checked_1="1 job posting" uncheck_1="0 featured job;job displayed fo 20 days;Premium support 24/7" title_2="Standard" subtitle_2="" monthly_price_2="$248" annual_price_2="$499" link_2="/" checked_2="1 job posting;0 featured job;job displayed fo 20 days" uncheck_2="Premium support 24/7" title_3="Extended" subtitle_3="" monthly_price_3="$499" annual_price_3="$1499" link_3="/" checked_3="1 job posting;0 featured job;job displayed fo 20 days;Premium support 24/7" ][/quotation]'
                    ),
                'template' => 'homepage',
            ],
            [
                'name' => 'Blog',
                'content' => '---',
                'template' => 'blog-sidebar',
            ],
            [
                'name' => 'Contact',
                'content' =>
                    $contact .
                    Html::tag(
                        'div',
                        '[google-map]North Link Building, 10 Admiralty Street, 757695 Singapore[/google-map]'
                    ),
                'template' => 'static',
            ],
            [
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
            [
                'name' => 'FAQ',
                'content' => Html::tag('div', '[faq title="Frequently Asked Questions"][/faq]'),
                'template' => 'static',
            ],
            [
                'name' => 'About us',
                'content' =>
                    Html::tag(
                        'div',
                        '[featured-job-categories title="Jobs by Categories" subtitle="Choose Your Desire Category" type="default" style="style-2"][/featured-job-categories]'
                    ) .
                    Html::tag(
                        'div',
                        '[how-it-works title="How It Works" subtitle="Follow our steps we will help you." check_list="Trusted & Quality Job;International Job;No Extra Charge;Top companies" style="style-2" quantity="4" title_1="Register Your Account" subtitle_1="You need to create an account to find the best and preferred job." image_1="themes/jobzilla/general/icon1.png" bg_color_1="#3898e2" title_2="Search Your Job" subtitle_2="You need to create an account to find the best and preferred job." image_2="themes/jobzilla/general/icon4.png" bg_color_2="#e2b438" title_3="Apply For Dream Job" subtitle_3="You need to create an account to find the best and preferred job." image_3="themes/jobzilla/general/icon2.png" bg_color_3="#bc84ca" title_4="Upload Your Resume" subtitle_4="You need to create an account to find the best and preferred job." image_4="themes/jobzilla/general/icon3.png" bg_color_4="#56d8b1" ][/how-it-works]'
                    ) .
                    Html::tag(
                        'div',
                        '[explore-new-life title="Explore New Life" subtitle="Don’t just find be found put your CV in front of great employers" description="Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever since the when an printer took." image="themes/jobzilla/general/gir-large.png" bg_image="themes/jobzilla/general/bg-1.png" button_url="/" button_name="Upload Your Resume" button_icon="feather-upload" style="style-1" ][/explore-new-life]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-companies title="Get hired in top companies" subtitle="Top companies" type="default" style="style-1" quantity="6" ][/featured-companies]'
                    ),
                'template' => 'static',
            ],
            [
                'name' => 'Terms Of Use',
                'template' => 'static',
            ],
            [
                'name' => 'Terms & Conditions',
                'template' => 'static',
            ],
            [
                'name' => 'Job Categories',
                'content' =>
                    Html::tag(
                        'div',
                        '[job-categories title="Job Categories" subtitle="All categories" per_page="15"][/job-categories]'
                    ),
                'template' => 'static',
            ],
            [
                'name' => 'companies',
                'content' =>
                    Html::tag('div', '[job-companies style="grid"][/job-companies]'),
                'template' => 'static',
            ],
            [
                'name' => 'Coming Soon',
                'content' =>
                    Html::tag(
                        'div',
                        '[coming-soon title="Coming Soon !" subtitle="We’re doing something amazing almost done..." date="' . BaseHelper::formatDate(
                            now()->addMonths(1)
                        ) . '" time="00:00" bg_image="themes/jobzilla/general/bg-3.jpg"][/coming-soon]'
                    ),
                'template' => 'coming-soon',
            ],
            [
                'name' => 'Candidates',
                'content' => Html::tag(
                    'div',
                    '[job-board-candidates style="grid" layout="grid" order_by="default"][/job-board-candidates]'
                ),
                'template' => 'static',
            ],
            [
                'name' => 'Jobs',
                'content' => Html::tag('div', '[job-board-jobs limit="16"][/job-board-jobs]'),
                'template' => 'static',
            ],
            [
                'name' => 'Jobs Grid with Map',
                'content' => Html::tag(
                    'div',
                    '[job-board-jobs style="list-with-map" layout="grid-2"][/job-board-jobs]'
                ),
            ],
            [
                'name' => 'Jobs List',
                'content' => Html::tag('div', '[job-board-jobs style="list" layout="list"][/job-board-jobs]'),
            ],
            [
                'name' => 'Homepage 4',
                'content' =>
                    Html::tag(
                        'div',
                        '[hero-banner title="" subtitle="Your {{Dream Job}} in one place" description="Find jobs that match your interests with us." popular_searches="Developer;Designer;Architect;Engineer" banner_1="themes/jobzilla/general/user.png" style="style-4" ][/hero-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-job-categories title="Choose Your Desire Category" subtitle="Jobs by Categories" description="Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever since the when an printer took." style="style-3" ][/featured-job-categories]'
                    ) .
                    Html::tag(
                        'div',
                        '[how-it-works title="How It Works" subtitle="Follow our steps we will help you." check_list="Trusted & Quality Job;International Job;No Extra Charge;Top companies" image="themes/jobzilla/general/main-bg.png" style="style-4" quantity="4" title_1="Register Your Account" subtitle_1="You need to create an account to find the best and preferred job." image_1="themes/jobzilla/general/icon1.png" bg_color_1="#3898e2" title_2="Search Your Job" subtitle_2="You need to create an account to find the best and preferred job." image_2="themes/jobzilla/general/icon4.png" bg_color_2="#e2b438" title_3="Apply For Dream Job" subtitle_3="You need to create an account to find the best and preferred job." image_3="themes/jobzilla/general/icon2.png" bg_color_3="#bc84ca" title_4="Upload Your Resume" subtitle_4="You need to create an account to find the best and preferred job." image_4="themes/jobzilla/general/icon3.png" bg_color_4="#56d8b1" ][/how-it-works]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-companies title="Get hired in top companies" subtitle="Top companies" style="style-3" quantity="3" title_1="Million daily active users" count_1="5" extra_1="M+" title_2="Open job positions" count_2="9" extra_2="K+" title_3="Million stories shared" count_3="2" extra_3="M+" ][/featured-companies]'
                    ) .
                    Html::tag(
                        'div',
                        '[explore-new-life title="About" subtitle="We help you connect with the organizer" description="Get paid easily and security. Use our resources to become independent and showcase your professional skills." image="themes/jobzilla/general/employee.png" button_url="/" style="style-4" quantity="3" title_1="Million daily active users" count_1="5" extra_1="M+" title_2="Open job positions" count_2="9" extra_2="K+" title_3="Million stories shared" count_3="2" extra_3="M+" ][/explore-new-life]'
                    ) .
                    Html::tag(
                        'div',
                        '[job-board-jobs title="Find Your Career You Deserve it" subtitle="All Jobs Post" number_of_displays="6" style="style-4" layout="grid-3x" ][/job-board-jobs]'
                    ) .
                    Html::tag(
                        'div',
                        '[quotation title="Choose Your Plan" subtitle="Save up to 10%" recommended="2" style="style-1" quantity="3" title_1="Basic" subtitle_1="" monthly_price_1="$90" annual_price_1="$149" link_1="/" checked_1="1 job posting" uncheck_1="0 featured job;job displayed fo 20 days;Premium support 24/7" title_2="Standard" subtitle_2="" monthly_price_2="$248" annual_price_2="$499" link_2="/" checked_2="1 job posting;0 featured job;job displayed fo 20 days" uncheck_2="Premium support 24/7" title_3="Extended" subtitle_3="" monthly_price_3="$499" annual_price_3="$1499" link_3="/" checked_3="1 job posting;0 featured job;job displayed fo 20 days;Premium support 24/7" ][/quotation]'
                    ),
                'template' => 'homepage',
            ],
            [
                'name' => 'Homepage 5',
                'content' =>
                    Html::tag(
                        'div',
                        '[hero-banner title="It’s Easy to Find Your {{ Dream Job }}" subtitle="You dream job is waiting for you." banner_1="themes/jobzilla/general/r-pic1.png" bg_image_1="themes/jobzilla/general/r-pic2.png" bg_image_2="themes/jobzilla/general/r-pic3.png" bg_image_3="themes/jobzilla/general/r-pic4.png" style="style-5" quantity="6" title_1="Our More Candidates" count_1="3" extra_1="K+" image_1="themes/jobzilla/general/icon-3.png"][/hero-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-job-categories title="Browse By Category" subtitle="Find the job that’s perfect for you." bg_image="themes/jobzilla/general/cate-bg.jpg" type="default" style="style-4"][/featured-job-categories]'
                    ) .
                    Html::tag(
                        'div',
                        '[job-of-the-days title="Job of the day" subtitle="Connect with the right candidates faster." limit="6"][/job-of-the-days]'
                    ) .
                    Html::tag(
                        'div',
                        '[job-banner title="Find The One That’s Right For You" subtitle="Millions of Jobs" description="You need to create an account to find the best and preferred job. lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever since took." image="themes/jobzilla/general/main-pic.png" count_job_available="45" button_primary_label="Search Jobs" button_primary_url="/jobs" button_secondary_label="Learn more" button_secondary_action="/jobs"][/job-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[counter-information bg_image="themes/jobzilla/general/ctr-bg.jpg" quantity="4" title_1="Completed Cases" count_1="25" extra_1="K+" title_2="Our Office" count_2="17" extra_2="K+" title_3="Skilled People" count_3="86" title_4="Happy Client" count_4="28"][/counter-information]'
                    ) .
                    Html::tag(
                        'div',
                        '[top-companies title="Top Recruiters" description="Discover your next career move" limit="15" button_action_label="View all" button_action_url="/jobs"][/top-companies]'
                    ) .
                    Html::tag(
                        'div',
                        '[job-board-cities title="Find your favourite jobs and get." subtitle="Jobs by location" city_ids="' . City::query()->limit(6)->pluck('id')->implode(', ') . '" button_action_label="View all location" button_action_url="jobs" style="2"][/job-board-cities]'
                    ) .
                    Html::tag(
                        'div',
                        '[blog-posts title="News and Blogs" subtitle="Get the latest news, updates and tips" category_id="0" type="default" style="style-1"][/blog-posts]'
                    ) .
                    Html::tag(
                        'div',
                        '[newsletter-minimal title="Subscribe to Our Newsletter" subtitle="Get the latest updates mailed to you" bg_image="themes/jobzilla/general/dotted-map.png" icon_image_1="themes/jobzilla/account-icons/pic1.jpg" icon_image_2="themes/jobzilla/account-icons/pic2.jpg" icon_image_3="themes/jobzilla/account-icons/pic3.jpg" icon_image_4="themes/jobzilla/account-icons/pic4.jpg" icon_image_5="themes/jobzilla/account-icons/pic5.jpg" icon_image_6="themes/jobzilla/account-icons/pic6.jpg" icon_image_7="themes/jobzilla/account-icons/pic7.jpg"][/newsletter-minimal]'
                    ),
                'template' => 'homepage',
                'header_css_class' => 'header-style-3 no-fixed',
            ],
            [
                'name' => 'Homepage 6',
                'content' =>
                    Html::tag(
                        'div',
                        '[hero-banner title="Find Your Perfect {{ Job }} Platform" subtitle=" Stay connect to get upcoming job with {{ Jobzilla }}" description="Explore all the most exciting job roles based on your interest and study major. your dream job is waiting for you." banner_1="themes/jobzilla/general/main-pic.png" style="style-6" quantity="3" title_1="Upload CV" image_1="themes/jobzilla/general/cv-icon.png" title_2="People Got Hired" count_2="25" extra_2="K+" image_2="themes/jobzilla/general/bag.png" image_3="themes/jobzilla/general/pdf-file.png"][/hero-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-job-categories title="Find the job that’s perfect for you." subtitle="Browse By Category" number_of_displays="10" button_action_label="All Categories" button_action_url="jobs" type="default" style="style-5"][/featured-job-categories]'
                    ) .
                    Html::tag(
                        'div',
                        '[job-banner title="Get World {{ 1500+ }} Talented People in one place" subtitle="Get Jobs" description="You need to create an account to find the best and preferred job. lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever took." title_company_slider="Trusted by more than {{ +100 companies }}" image="themes/jobzilla/general/get-job-pic.png" button_primary_label="About more" button_primary_action="jobs" style="style-2"][/job-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-jobs title="Jobs Category" subtitle="Featured Jobs" limit="5" image="themes/jobzilla/general/large-pic-1.png" button_label="Show All Jobs" button_action="jobs"][/featured-jobs]'
                    ) .
                    Html::tag(
                        'div',
                        '[counter-information title="Join our community of talented and professionals by applying for a job today!." subtitle="Our Community" bg_image="themes/jobzilla/general/our-com-bg.jpg" style="style-2" quantity="4" title_1="Completed Cases" count_1="1590" icon_1="flaticon-dashboard" title_2="Our Office" count_2="1740" icon_2="flaticon-user" title_3="Skilled People" count_3="800" icon_3="flaticon-hr" title_4="Happy Client" count_4="16" icon_4="flaticon-note"][/counter-information]'
                    ) .
                    Html::tag(
                        'div',
                        '[testimonials title="Testimonials" subtitle="Quotes from our customer about us" description="You need to create an account to find the best and preferred job. lorem Ipsum is simply dummy text of the printing and typesetting the standard dummy text ever since the when an printer took." link="jobs" text_link="Show All Quotes" bg_color="#000" icon_image="themes/jobzilla/general/dotted-block.png" style="style-3"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[blog-posts title="Latest Blog" subtitle="Our Regular Updated Blog Posts" button_action_label="Explore All Blogs" button_action_url="blog" category_id="0" type="default" number_of_displays="8" style="style-4"][/blog-posts]'
                    ) .
                    Html::tag(
                        'div',
                        '[newsletter-large title_primary="Get your {{ FREE }} web consultation" subtitle_primary="Latest Blog" title_secondary="Subscribe for free" subtitle_secondary="Join our email subscription now to get updates on new jobs and notifications." phone=" 555-281-5426" email="contact@botble.com"][/newsletter-large]'
                    ),
                'template' => 'homepage',
            ],
            [
                'name' => 'Homepage 7',
                'content' =>
                    Html::tag(
                        'div',
                        '[hero-banner title="FIND TOP IT {{JOBS}}" subtitle="For talent Developers," browse_job="you deserve!" description="Type your keyword, then click search to find your perfect job." bg_image_1="themes/jobzilla/general/h7-banner.jpg" popular_searches="Developer;Designer;Architect;Engineer" style="style-7" quantity="3"][/hero-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[job-board-recommend title="Jobs Category" subtitle="Recommended Jobs" button_name="View ALL" type="default"][/job-board-recommend]'
                    ) .
                    Html::tag(
                        'div',
                        '[how-to-get-your-job title="How to get your job" subtitle="Build Your Personal Account Profile" description="Create an account for job information that you wanted, get notification everyday and you can easily apply directly to the company you want create and account now for free." image="themes/jobzilla/general/hig-pic.png" button_name="Edit Profile" button_url="/" icon="flaticon-bell" icon_title="New Interview" icon_subtitle="You has new interview today" quantity="2" title_1="Complete your profile" subtitle_1="95% Completed" image_1="themes/jobzilla/accounts/4.jpg" site_button_title_1="Hire Me!" site_button_link_1="/" bg_color_1="#fff" title_2="Complete your profile" subtitle_2="95% Completed" image_2="themes/jobzilla/accounts/2.jpg" bg_color_2="#fff"][/how-to-get-your-job]'
                    ) .
                    Html::tag(
                        'div',
                        '[how-it-works title="Working Process" subtitle="Follow Our Steps, We Will Help You" bg_image="themes/jobzilla/general/hiw-bg.jpg" style="style-7" quantity="3" title_1="Register Your Account" subtitle_1="You need to create an account to find the best and preferred job." image_1="themes/jobzilla/general/icon1.png" bg_color_1="cyan" title_2="Apply For Dream Job" subtitle_2="You need to create an account to find the best and preferred job." image_2="themes/jobzilla/general/icon2.png" bg_color_2="violet" title_3="Upload Your Resume" subtitle_3="You need to create an account to find the best and preferred job." image_3="themes/jobzilla/general/icon4.png" bg_color_3="yellow"][/how-it-works]'
                    ) .
                    Html::tag(
                        'div',
                        '[job-board-candidates title="Candidates" subtitle="Featured Candidates" bg_image="themes/jobzilla/general/bg-pattern-can.png" bg_map_image="themes/jobzilla/general/ofr-bg.jpg" map_title="We also have {{job offers}} in other countries" map_image="themes/jobzilla/general/map-img.png" style="style-7" layout="list-7" order_by="default" quantity="6" title_1="Americans" image_1="themes/jobzilla/countries/americans.jpg" title_2="Denmark" image_2="themes/jobzilla/countries/denmark.jpg" title_3="France" image_3="themes/jobzilla/countries/france.jpg" title_4="United Kingdom" image_4="themes/jobzilla/countries/united-kingdom.jpg"][/job-board-candidates]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-companies title="Top companies" subtitle="Get hired in top companies" type="featured" style="style-7" quantity="3" title_1="Million daily active users" count_1="5" extra_1="M+" title_2="Open job positions" count_2="9" extra_2="K+" title_3="Million stories shared" count_3="2" extra_3="M+"][/featured-companies]'
                    ) .
                    Html::tag(
                        'div',
                        '[blog-posts title="Our Blogs" subtitle="Latest Article" category_id="0" type="default" style="style-7"][/blog-posts]'
                    ) .
                    Html::tag(
                        'div',
                        '[testimonials title="Testimonials" subtitle="Jobseeker reviews through {{Jobzilla}}" testimonial_outline_text="Testimonials" bg_color="#000" style="style-7"][/testimonials]'
                    ),
                'template' => 'homepage',
                'header_css_class' => 'header-style-light',
            ],
            [
                'name' => 'Homepage 8',
                'content' =>
                    Html::tag(
                        'div',
                        '[hero-banner title="GOT TALENT?" subtitle="MEET OPPORTUNITY" description="Over {{1800+}} jobs are waiting for you" gradient_text="Jobs" banner_1="themes/jobzilla/general/bnr-right-pic.png" bg_image_1="themes/jobzilla/general/h8-banner.jpg" popular_searches="Developer;Designer;Architect;Engineer" style="style-8" quantity="3"][/hero-banner]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-job-categories title="Jobs at a glance" subtitle="Jobs at a glance" type="default" style="style-6"][/featured-job-categories]'
                    ) .
                    Html::tag(
                        'div',
                        '[job-of-the-days title="Job of the day" subtitle="Connect with the right candidates faster." limit="6" button_name="View All"][/job-of-the-days]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-companies title="Get hired in top companies" subtitle="Top companies" type="featured" style="style-8" quantity="3" title_1="Million daily active users" count_1="5" extra_1="M+" title_2="Open job positions" count_2="9" extra_2="K+" title_3="Million stories shared" count_3="2" extra_3="M+"][/featured-companies]'
                    ) .
                    Html::tag(
                        'div',
                        '[how-to-get-your-job title="How to get your job" subtitle="Build Your Personal Account Profile" description="Create an account for job information that you wanted, get notification everyday and you can easily apply directly to the company you want create and account now for free." image="themes/jobzilla/general/hig-pic2.png" button_name="Edit Profile" button_url="/" icon="flaticon-bell" icon_title="New Interview" icon_subtitle="You has new interview today" quantity="2" title_1="Complete your profile" subtitle_1="95% Completed" image_1="themes/jobzilla/accounts/4.jpg" site_button_title_1="Hire Me!" site_button_link_1="/" bg_color_1="#fff" title_2="Complete your profile" subtitle_2="95% Completed" image_2="themes/jobzilla/accounts/2.jpg" bg_color_2="#fff"][/how-to-get-your-job]'
                    ) .
                    Html::tag(
                        'div',
                        '[testimonials title="Testimonials" subtitle="Jobseeker reviews through Jobzilla." testimonial_outline_text="Jobseeker" bg_color="#fff" banner_image="themes/jobzilla/general/testimonial-3d-pic.png" style="style-8"][/testimonials]'
                    ) .
                    Html::tag(
                        'div',
                        '[quotation title="Choose Your Plan" subtitle="Save up to 10%" recommended="2" style="style-1" quantity="3" title_1="Basic" subtitle_1="" monthly_price_1="$90" annual_price_1="$149" link_1="/" checked_1="1 job posting" uncheck_1="0 featured job;job displayed fo 20 days;Premium support 24/7" title_2="Standard" subtitle_2="" monthly_price_2="$248" annual_price_2="$499" link_2="/" checked_2="1 job posting;0 featured job;job displayed fo 20 days" uncheck_2="Premium support 24/7" title_3="Extended" subtitle_3="" monthly_price_3="$499" annual_price_3="$1499" link_3="/" checked_3="1 job posting;0 featured job;job displayed fo 20 days;Premium support 24/7" ][/quotation]'
                    ) .
                    Html::tag(
                        'div',
                        '[blog-posts title="News and Blogs" subtitle="Get the latest news, updates and tips" category_id="0" type="default" style="style-8"][/blog-posts]'
                    ),
                'template' => 'homepage',
            ],
            [
                'name' => 'Pricing',
                'content' =>
                    Html::tag(
                        'div',
                        '[packages title="Choose Your Plan" subtitle="Save up to 10%" package_ids="1,2,3"][/packages]'
                    ),
                'template' => 'static',
            ],
        ];

        foreach ($pages as $item) {
            $item['user_id'] = 1;

            if (! isset($item['template'])) {
                $item['template'] = 'default';
            }

            if (! isset($item['content'])) {
                $item['content'] =
                    Html::tag('p', fake()->realText(500)) . Html::tag('p', fake()->realText(500)) .
                    Html::tag('p', fake()->realText(500)) . Html::tag('p', fake()->realText(500));
            }

            $only = Arr::only($item, ['name', 'content', 'template', 'user_id']);
            $page = Page::query()->create($only);

            Slug::query()->create([
                'reference_type' => Page::class,
                'reference_id' => $page->id,
                'key' => Arr::get($item, 'slug', Str::slug($page->name)),
                'prefix' => SlugHelper::getPrefix(Page::class),
            ]);

            if (Arr::has($item, 'header_css_class')) {
                MetaBox::saveMetaBoxData($page, 'header_css_class', Arr::get($item, 'header_css_class'));
            }
        }
    }

    protected function contactShortcode(): HtmlString
    {
        $data = [
            'title' => 'Send Us a Message',
            'subtitle' => 'Feel free to contact us and we will get back to you as soon as we can.',
            'address_title' => 'In the bay area?',
            'address_1' => '1363-1385 Sunset Blvd Los Angeles, CA 90026, USA',
            'address_2' => '',
            'phone_title' => 'Feel free to contact us',
            'phone_1' => '+2 900 234 4241',
            'phone_2' => '+2 900 234 3219',
            'email_title' => 'Support',
            'email_1' => 'infohelp@gmail.com',
            'email_2' => 'support12@gmail.com',
        ];

        return $this->getShortcode('contact-form', $data);
    }

    protected function getShortcode(string $name, array $data, array $list = []): HtmlString
    {
        $text = '';

        if (count($list) && ! Arr::get($data, 'quantity')) {
            $data['quantity'] = count($list);
        }

        foreach ($data as $key => $value) {
            $text .= ($key . '="' . $value . '" ');
        }

        foreach ($list as $i => $item) {
            foreach ($item as $key => $value) {
                $text .= ($key . '_' . $i . '="' . $value . '" ');
            }
        }

        return Html::tag('div', '[' . $name . ' ' . $text . '][/' . $name . ']');
    }
}
