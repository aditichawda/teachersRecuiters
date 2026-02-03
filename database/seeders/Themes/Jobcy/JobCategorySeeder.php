<?php

namespace Database\Seeders\Themes\Jobcy;

use Botble\Base\Facades\MetaBox;
use Botble\Base\Supports\BaseSeeder;
use Botble\JobBoard\Models\Category;
use Botble\Slug\Facades\SlugHelper;

class JobCategorySeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('themes/jobcy/job-categories');

        Category::query()->truncate();

        $data = [
            'IT & Software',
            'Technology',
            'Government',
            'Accounting / Finance',
            'Construction / Facilities',
            'Tele-communications',
            'Design & Multimedia',
            'Human Resource',
            'Consumer Packaged Goods (CPG)',
            'Manufacturing',
            'Retail',
            'Distribution/Logistics',
            'Supply Chain Operations',
            'Healthcare & Medical',
            'Procurement / Sourcing',
            'Information Technology (IT)',
            'Sales/Business Development',
            'Legal & Professional Services',
            'Life Sciences & Healthcare',
        ];

        foreach ($data as $index => $item) {
            $category = Category::query()->create([
                'name' => $item,
                'order' => $index,
                'is_featured' => $index < 8,
            ]);

            if ($index < 8) {
                MetaBox::saveMetaBoxData($category, 'icon_image', 'themes/jobcy/job-categories/' . ($index + 1) . '.png');
            }

            SlugHelper::createSlug($category);
        }
    }
}
