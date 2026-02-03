<?php

namespace Database\Seeders\Themes\Jobcy;

use Botble\Base\Supports\BaseSeeder;
use Botble\Testimonial\Models\Testimonial;

class TestimonialSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('themes/jobcy/testimonials');

        $testimonials = [
            [
                'name' => 'Jeffrey Montgomery',
                'company' => 'Product Manager',
            ],
            [
                'name' => 'Rebecca Swartz',
                'company' => 'Creative Designer',
            ],
            [
                'name' => 'Charles Dickens',
                'company' => 'Store Assistant',
            ],
        ];

        Testimonial::query()->truncate();

        foreach ($testimonials as $index => $item) {
            $item['image'] = 'themes/jobcy/testimonials/' . ($index + 1) . '.png';
            $item['content'] = 'Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No shortcuts. Even if the client is being careless.';

            Testimonial::query()->create($item);
        }
    }
}
