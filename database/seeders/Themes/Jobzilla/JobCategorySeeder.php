<?php

namespace Database\Seeders\Themes\Jobzilla;

use Botble\Base\Facades\MetaBox;
use Botble\Base\Supports\BaseSeeder;
use Botble\JobBoard\Models\Category;
use Botble\Slug\Facades\SlugHelper;
use Botble\Slug\Models\Slug;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class JobCategorySeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('themes/jobzilla/job-categories');

        Category::query()->truncate();

        $data = [
            1 => [
                'title' => 'Business Development',
                'icon' => 'flaticon-dashboard',
            ],
            2 => [
                'title' => 'Project Management',
                'icon' => 'flaticon-project-management',
            ],
            3 => [
                'title' => 'Content Writer',
                'icon' => 'flaticon-note',
            ],
            4 => [
                'title' => 'Customer Services',
                'icon' => 'flaticon-customer-support',
            ],
            5 => [
                'title' => 'Accounting / Finance',
                'icon' => 'flaticon-bars',
            ],
            6 => [
                'title' => 'Marketing',
                'icon' => 'flaticon-user',
            ],
            7 => [
                'title' => 'Design & Art',
                'icon' => 'flaticon-computer',
            ],
            8 => [
                'title' => 'Web Development',
                'icon' => 'flaticon-coding',
            ],
            9 => [
                'title' => 'Human Resource',
                'icon' => 'flaticon-hr',
            ],
            10 => [
                'title' => 'Health and Care',
                'icon' => 'flaticon-healthcare',
            ],
            11 => [
                'title' => 'Automotive Jobs',
                'icon' => 'flaticon-repair',
            ],
            12 => [
                'title' => 'Teaching / Education',
                'icon' => 'flaticon-teacher',
            ],
            13 => [
                'title' => 'Banking',
                'icon' => 'flaticon-bank',
            ],
            14 => [
                'title' => 'Sales Marketing',
                'icon' => 'flaticon-deal',
            ],
            15 => [
                'title' => 'Restaurant / Food',
                'icon' => 'flaticon-tray',
            ],
            16 => [
                'title' => 'Telecommunications',
                'icon' => 'flaticon-tower',
            ],
            17 => [
                'title' => 'Fitness Trainer',
                'icon' => 'flaticon-lotus',
            ],
            18 => [
                'title' => 'Photography',
                'icon' => 'flaticon-camera-tripod',
            ],
            19 => [
                'title' => 'Audio + Music',
                'icon' => 'flaticon-multimedia',
            ],
            20 => [
                'title' => 'Real estate',
                'icon' => 'flaticon-contract',
            ],
            21 => [
                'title' => 'Construction',
                'icon' => 'flaticon-engineer',
            ],
        ];

        foreach ($data as $index => $item) {
            $category = Category::query()->create([
                'name' => Arr::get($item, 'title'),
                'order' => $index,
                'is_featured' => $index < 8,
            ]);

            if ($icon = Arr::get($item, 'icon')) {
                MetaBox::saveMetaBoxData($category, 'icon', $icon);
            }

            Slug::query()->create([
                'reference_type' => Category::class,
                'reference_id' => $category->id,
                'key' => Str::slug($category->name),
                'prefix' => SlugHelper::getPrefix(Category::class),
            ]);
        }
    }
}
