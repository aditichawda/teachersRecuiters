<?php

namespace Database\Seeders\Themes\Jobzilla;

use Botble\ACL\Database\Seeders\UserSeeder;
use Botble\Base\Supports\BaseSeeder;

class DatabaseSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->prepareRun();

        $this->call([
            UserSeeder::class,
            LanguageSeeder::class,
            PageSeeder::class,
            BlogSeeder::class,
            ContactSeeder::class,
            SettingSeeder::class,
            ThemeOptionSeeder::class,
            LocationSeeder::class,
            CareerLevelSeeder::class,
            DegreeLevelSeeder::class,
            DegreeTypeSeeder::class,
            FunctionalAreaSeeder::class,
            JobCategorySeeder::class,
            JobExperienceSeeder::class,
            JobShiftSeeder::class,
            JobSkillSeeder::class,
            JobTypeSeeder::class,
            CompanySeeder::class,
            LanguageLevelSeeder::class,
            JobSeeder::class,
            CurrencySeeder::class,
            AccountSeeder::class,
            PackageSeeder::class,
            ReviewSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            MenuSeeder::class,
            JobApplicationSeeder::class,
            WidgetSeeder::class,
        ]);

        $this->finished();
    }
}
