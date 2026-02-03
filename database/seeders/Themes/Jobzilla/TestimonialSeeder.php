<?php

namespace Database\Seeders\Themes\Jobzilla;

use Botble\Base\Supports\BaseSeeder;
use Botble\Testimonial\Models\Testimonial;

class TestimonialSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('themes/jobzilla/testimonials');

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
            [
                'name' => 'Daniel L. Estrada',
                'company' => 'Rickel',
            ],
        ];

        Testimonial::query()->truncate();

        foreach ($testimonials as $index => $item) {
            $item['image'] = 'themes/jobzilla/testimonials/' . ($index + 1) . '.png';
            $item['content'] = 'Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No shortcuts. Even if the client is being careless.';

            Testimonial::query()->create($item);
        }
    }
}
