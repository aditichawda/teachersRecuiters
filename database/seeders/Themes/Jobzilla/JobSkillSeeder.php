<?php

namespace Database\Seeders\Themes\Jobzilla;

use Botble\Base\Supports\BaseSeeder;
use Botble\JobBoard\Models\JobSkill;
use Illuminate\Support\Facades\DB;

class JobSkillSeeder extends BaseSeeder
{
    public function run(): void
    {
        JobSkill::query()->truncate();
        DB::table('jb_jobs_skills')->truncate();

        $data = [
            'Javascript',
            'PHP',
            'Python',
            'Laravel',
            'CakePHP',
            'Wordpress',
        ];

        foreach ($data as $item) {
            JobSkill::query()->create(['name' => $item]);
        }
    }
}
