<?php

namespace Database\Seeders\Themes\Jobcy;

use Botble\ACL\Database\Seeders\UserSeeder;
use Botble\Base\Supports\BaseSeeder;
use Botble\Contact\Database\Seeders\ContactSeeder;
use Botble\JobBoard\Database\Seeders\CurrencySeeder;
use Botble\JobBoard\Database\Seeders\ReviewSeeder;
use Botble\Language\Database\Seeders\LanguageSeeder;

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
            WidgetSeeder::class,
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
            AccountSeeder::class,
            CurrencySeeder::class,
            PackageSeeder::class,
            ReviewSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            MenuSeeder::class,
            JobApplicationSeeder::class,
        ]);

        $this->finished();
    }
}
