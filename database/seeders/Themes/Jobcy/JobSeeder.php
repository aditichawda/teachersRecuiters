<?php

namespace Database\Seeders\Themes\Jobcy;

use Botble\Base\Facades\MetaBox;
use Botble\Base\Supports\BaseSeeder;
use Botble\JobBoard\Database\Traits\HasJobSeeder;

class JobSeeder extends BaseSeeder
{
    use HasJobSeeder;

    public function run(): void
    {
        $this->createJobTags($this->getDefaultJobTags());
        $this->createJobs($this->getDefaultJobNames(), $this->getDefaultJobContent());
    }

    protected function setJobFeaturedImage($job, int $index, string $prefix = 'themes/jobcy/jobs/img'): void
    {
        $imageNumber = ($index + 1) > 9 ? rand(1, 9) : ($index + 1);
        MetaBox::saveMetaBoxData(
            $job,
            'featured_image',
            $prefix . $imageNumber . '.png'
        );
    }
}
