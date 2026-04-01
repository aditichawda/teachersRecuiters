<?php

namespace Botble\JobBoard\Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\JobBoard\Models\WhatsAppTemplate;

class WhatsAppTemplateSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default job application alert template
        WhatsAppTemplate::updateOrCreate(
            ['name' => 'job_application_alert'],
            [
                'display_name' => 'Job Application Alert',
                'description' => 'Template for sending job application notifications to employers',
                'language_code' => 'en',
                'parameters' => [
                    [
                        'name' => 'job_title',
                        'type' => 'text',
                        'position' => 1,
                        'description' => 'Job Title',
                    ],
                    [
                        'name' => 'candidate_name',
                        'type' => 'text',
                        'position' => 2,
                        'description' => 'Candidate Name',
                    ],
                    [
                        'name' => 'candidate_email',
                        'type' => 'text',
                        'position' => 3,
                        'description' => 'Candidate Email',
                    ],
                    [
                        'name' => 'candidate_phone',
                        'type' => 'text',
                        'position' => 4,
                        'description' => 'Candidate Phone',
                    ],
                ],
                'is_active' => true,
            ]
        );
    }
}
