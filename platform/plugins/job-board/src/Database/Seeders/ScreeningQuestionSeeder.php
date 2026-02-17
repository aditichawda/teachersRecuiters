<?php

namespace Botble\JobBoard\Database\Seeders;

use Botble\JobBoard\Models\ScreeningQuestion;
use Illuminate\Database\Seeder;

class ScreeningQuestionSeeder extends Seeder
{
    public function run(): void
    {
        if (ScreeningQuestion::query()->exists()) {
            return;
        }

        $templates = [
            [
                'question' => 'Do you have Minimum {degree_level} in the relevant subject/specialization?',
                'question_type' => 'dropdown',
                'options' => "Yes, I have completed\nNo, I don't have",
                'order' => 1,
            ],
            [
                'question' => 'Do you have Minimum {experience_years} Experience as {job_title}?',
                'question_type' => 'dropdown',
                'options' => "Yes, I have {experience_years} Experience as {job_title}\nNo, I don't have",
                'order' => 2,
            ],
            [
                'question' => 'Have you completed Teaching Certification ({certification})?',
                'question_type' => 'dropdown',
                'options' => "Yes, I have completed ({certification})\nNo, I don't have",
                'order' => 3,
            ],
            [
                'question' => 'Select your Language proficiency in ({language})?',
                'question_type' => 'dropdown',
                'options' => "Good\nAverage\nExcellent",
                'order' => 4,
            ],
            [
                'question' => 'Are you willing to commute/relocate at {job_location}?',
                'question_type' => 'dropdown',
                'options' => "Yes, I'm ready for relocation\nNo, I can't relocate",
                'order' => 5,
            ],
            [
                'question' => 'What is your notice period for joining?',
                'question_type' => 'dropdown',
                'options' => "7-Days\n15-Days\n1-Month",
                'order' => 6,
            ],
            [
                'question' => 'Are you located in nearby areas of ({application_locations})?',
                'question_type' => 'dropdown',
                'options' => "Yes\nNo",
                'order' => 7,
            ],
            [
                'question' => 'Do you have relevant work experience for {company_name} ({institution_type})?',
                'question_type' => 'dropdown',
                'options' => "Yes, I have work experience in {institution_type}\nNo, I don't have relevant experience",
                'order' => 8,
            ],
            [
                'question' => 'Why do you want to apply for this {job_title} position?',
                'question_type' => 'textarea',
                'options' => null,
                'order' => 9,
            ],
            [
                'question' => 'Select your gender',
                'question_type' => 'dropdown',
                'options' => "Male\nFemale",
                'order' => 10,
            ],
            [
                'question' => 'Interview availability',
                'question_type' => 'dropdown',
                'options' => "I can attend offline/onsite interview\nI'm available for only online interview",
                'order' => 11,
            ],
        ];

        foreach ($templates as $t) {
            ScreeningQuestion::query()->create([
                'question' => $t['question'],
                'question_type' => $t['question_type'],
                'options' => $t['options'],
                'order' => $t['order'],
                'status' => 'published',
            ]);
        }
    }
}
