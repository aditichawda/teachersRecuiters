<?php

namespace Database\Seeders\Themes\Jobcy;

use Botble\Base\Supports\BaseSeeder;
use Botble\JobBoard\Models\DegreeLevel;

class DegreeLevelSeeder extends BaseSeeder
{
    public function run(): void
    {
        DegreeLevel::query()->truncate();

        $data = [
            'Non-Matriculation',
            'Matriculation/O-Level',
            'Intermediate/A-Level',
            'Bachelors',
            'Masters',
            'MPhil/MS',
            'PHD/Doctorate',
            'Certification',
            'Diploma',
            'Short Course',
        ];

        foreach ($data as $item) {
            DegreeLevel::query()->create(['name' => $item]);
        }
    }
}
