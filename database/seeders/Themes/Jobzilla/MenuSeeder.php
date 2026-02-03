<?php

namespace Database\Seeders\Themes\Jobzilla;

use Botble\Base\Supports\BaseSeeder;
use Botble\Blog\Models\Post;
use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\Company;
use Botble\JobBoard\Models\Job;
use Botble\Menu\Database\Traits\HasMenuSeeder;
use Botble\Page\Database\Traits\HasPageSeeder;
use Botble\Page\Models\Page;

class MenuSeeder extends BaseSeeder
{
    use HasMenuSeeder;
    use HasPageSeeder;

    public function run(): void
    {
        $menus = [
            [
                'name' => 'Main menu',
                'location' => 'main-menu',
                'items' => [
                    [
                        'title' => 'How it Works',
                        'url' => '/how-it-works',
                    ],
                    [
                        'title' => 'Jobs',
                        'url' => '/jobs',
                        'children' => [
                            [
                                'title' => 'By Location',
                                'url' => '/jobs?filter=location',
                            ],
                            [
                                'title' => 'By Subject',
                                'url' => '/jobs?filter=subject',
                            ],
                            [
                                'title' => 'By Institution Type',
                                'url' => '/jobs?filter=institution-type',
                            ],
                        ],
                    ],
                    [
                        'title' => 'For Schools',
                        'url' => '/for-schools',
                    ],
                    [
                        'title' => 'Start Hiring',
                        'url' => '/start-hiring',
                    ],
                ],
            ],
            [
                'name' => 'For Candidate',
                'items' => [
                    [
                        'title' => 'User Dashboard',
                        'url' => 'account/dashboard',
                    ],
                    [
                        'title' => 'Candidates',
                        'url' => Account::query()->where('type', AccountTypeEnum::JOB_SEEKER)->where(
                            'is_public_profile',
                            1
                        )->first()->url,
                    ],
                ],
            ],
            [
                'name' => 'For Employers',
                'items' => [
                    [
                        'title' => 'Post Jobs',
                        'url' => 'account/jobs/create',
                    ],
                    [
                        'title' => 'Blog Grid',
                        'reference_id' => $this->getPageId('Blog'),
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Contact',
                        'reference_id' => $this->getPageId('Contact'),
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Jobs Listing',
                        'url' => JobBoardHelper::getJobsPageURL() . '?layout=list',
                    ],
                    [
                        'title' => 'Jobs details',
                        'url' => Job::query()->find(1)->url,
                    ],
                ],
            ],
            [
                'name' => 'Helpful Resources',
                'items' => [
                    [
                        'title' => 'Terms Of Use',
                        'reference_id' => $this->getPageId('Terms Of Use'),
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Terms & Conditions',
                        'reference_id' => $this->getPageId('Terms & Conditions'),
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'FAQ',
                        'reference_id' => $this->getPageId('FAQ'),
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Cookie Policy',
                        'reference_id' => $this->getPageId('Cookie Policy'),
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Coming Soon',
                        'reference_id' => $this->getPageId('Coming soon'),
                        'reference_type' => Page::class,
                    ],
                ],
            ],
            [
                'name' => 'Quick Links',
                'items' => [
                    [
                        'title' => 'Home',
                        'url' => '/',
                    ],
                    [
                        'title' => 'About us',
                        'reference_id' => $this->getPageId('About us'),
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Jobs',
                        'url' => JobBoardHelper::getJobsPageURL(),
                    ],
                    [
                        'title' => 'Companies',
                        'url' => JobBoardHelper::getJobCompaniesPageURL(),
                    ],
                ],
            ],
        ];

        $this->createMenus($menus);
    }
}
