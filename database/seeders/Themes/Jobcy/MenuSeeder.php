<?php

namespace Database\Seeders\Themes\Jobcy;

use Botble\Base\Supports\BaseSeeder;
use Botble\Blog\Models\Post;
use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\Category;
use Botble\JobBoard\Models\Company;
use Botble\JobBoard\Models\Job;
use Botble\Menu\Database\Traits\HasMenuSeeder;
use Botble\Page\Models\Page;

class MenuSeeder extends BaseSeeder
{
    use HasMenuSeeder;

    public function run(): void
    {
        $candidate = Account::query()
            ->where('is_public_profile', true)
            ->where('type', AccountTypeEnum::JOB_SEEKER)
            ->inRandomOrder()
            ->first();

        $data = [
            [
                'name' => 'Main menu',
                'slug' => 'main-menu',
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
                'name' => 'Company',
                'slug' => 'company',
                'items' => [
                    [
                        'title' => 'About Us',
                        'reference_id' => 6,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Contact Us',
                        'reference_id' => 3,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Services',
                        'reference_id' => 7,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Blog',
                        'reference_id' => 2,
                        'reference_type' => Page::class,
                    ],
                ],
            ],
            [
                'name' => 'For Jobs',
                'slug' => 'for-jobs',
                'items' => [
                    [
                        'title' => 'Browse Categories',
                        'reference_id' => 10,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Browse Jobs',
                        'url' => '/jobs',
                    ],
                    [
                        'title' => 'Job Details',
                        'url' => Job::query()->first()->url,
                    ],
                    [
                        'title' => 'Saved Jobs',
                        'url' => '/jobs/saved-jobs',
                    ],
                    [
                        'title' => 'Job External',
                        'url' => Job::query()->skip(1)->first()->url,
                    ],
                    [
                        'title' => 'Job Hide Company',
                        'url' => Job::query()->skip(2)->first()->url,
                    ],
                ],
            ],
            [
                'name' => 'For Candidates',
                'slug' => 'for-candidates',
                'items' => [
                    [
                        'title' => 'Candidates List',
                        'reference_id' => 15,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Candidates Grid',
                        'reference_id' => 16,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Candidates Details',
                        'url' => $candidate->url,
                    ],
                ],
            ],
            [
                'name' => 'Support',
                'slug' => 'support',
                'items' => [
                    [
                        'title' => 'Terms Of Use',
                        'reference_id' => 8,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Terms & Conditions',
                        'reference_id' => 9,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'FAQ',
                        'reference_id' => 5,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Cookie Policy',
                        'reference_id' => 4,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Coming Soon',
                        'reference_id' => 12,
                        'reference_type' => Page::class,
                    ],
                ],
            ],
        ];

        $this->createMenus($data);
    }
}
