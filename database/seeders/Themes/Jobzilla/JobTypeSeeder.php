<?php

namespace Database\Seeders\Themes\Jobzilla;

use Botble\Base\Facades\MetaBox;
use Botble\Base\Supports\BaseSeeder;
use Botble\JobBoard\Models\JobType;
use Illuminate\Support\Arr;

class JobTypeSeeder extends BaseSeeder
{
    public function run(): void
    {
        JobType::query()->truncate();

        $data = [
            [
                'name' => 'Contract',
                'background_color' => '#2db346',
            ],
            [
                'name' => 'Freelance',
                'background_color' => '#2d9bb3',
            ],
            [
                'name' => 'Full Time',
                'is_default' => 1,
                'background_color' => '#8883ec',
            ],
            [
                'name' => 'Internship',
                'background_color' => '#b3692d',
            ],
            [
                'name' => 'Part Time',
                'background_color' => '#b7912a',
            ],
        ];

        foreach ($data as $item) {
            $jobType = JobType::query()->create(Arr::only($item, ['name', 'is_default']));

            if (Arr::has($item, 'background_color')) {
                MetaBox::saveMetaBoxData($jobType, 'background_color', Arr::get($item, 'background_color'));
            }
        }
    }
}
