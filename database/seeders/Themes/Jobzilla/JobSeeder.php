<?php

namespace Database\Seeders\Themes\Jobzilla;

use Botble\Base\Facades\MetaBox;
use Botble\Base\Supports\BaseSeeder;
use Botble\JobBoard\Database\Traits\HasJobSeeder;
use Botble\JobBoard\Models\Company;
use Botble\JobBoard\Models\Job;
use Illuminate\Support\Arr;

class JobSeeder extends BaseSeeder
{
    use HasJobSeeder;

    public function run(): void
    {
        $this->uploadFiles('themes/jobzilla/jobs');
        $this->uploadFiles('themes/jobzilla/cities');

        $this->createJobTags($this->getDefaultJobTags());
        $this->createJobs($this->getDefaultJobNames(), $this->getDefaultJobContent());

        // Set layout for specific job
        $job = Job::query()->find(3);
        if ($job) {
            MetaBox::saveMetaBoxData($job, 'layout', 'v2');
        }

        // Update city images
        $this->updateCityImages();
    }

    protected function setJobFeaturedImage($job, int $index, string $prefix = 'themes/jobzilla/jobs/img'): void
    {
        $imageNumber = ($index + 1) > 9 ? rand(1, 9) : ($index + 1);
        MetaBox::saveMetaBoxData(
            $job,
            'featured_image',
            $prefix . $imageNumber . '.png'
        );
    }

    protected function updateCityImages(): void
    {
        $companies = Company::query()->get();

        foreach ($companies as $company) {
            $city = $company->city;

            if (! $city || ! $city->id) {
                continue;
            }

            $city->image = 'themes/jobzilla/cities/' . Arr::random([1, 2, 3]) . '.jpg';
            $city->save();
        }
    }
}
