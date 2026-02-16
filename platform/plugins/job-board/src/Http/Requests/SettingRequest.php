<?php

namespace Botble\JobBoard\Http\Requests;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Supports\Language;
use Botble\JobBoard\Enums\AccountGenderEnum;
use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class SettingRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            'first_name' => 'required|max:120|min:2',
            'last_name' => 'nullable|max:120',
            'phone' => 'nullable|max:30',
            'phone_country_code' => 'nullable|max:10',
            'dob' => 'nullable|date',
            'address' => 'nullable|max:250',
            'pin_code' => 'nullable|string|max:20',
            'locality' => 'nullable|string|max:255',
            'gender' => 'nullable|' . Rule::in(AccountGenderEnum::values()),
            'description' => 'nullable|max:4000',
            'bio' => 'nullable',
            'career_aspiration' => 'nullable|max:10000',
            'country_id' => 'nullable|numeric',
            'state_id' => 'nullable|numeric',
            'city_id' => 'nullable|numeric',
            'country_name' => 'nullable|string|max:255',
            'state_name' => 'nullable|string|max:255',
            'city_name' => 'nullable|string|max:255',
            'native_country_name' => 'nullable|string|max:255',
            'native_state_name' => 'nullable|string|max:255',
            'native_city_name' => 'nullable|string|max:255',
            'locale' => ['sometimes', 'required', Rule::in(array_keys(Language::getAvailableLocales()))],
        ];

        $account = auth('account')->user();
        if ($account && ! $account->type->getKey()) {
            $rules['type'] = Rule::in(AccountTypeEnum::values());
        }

        if ($account && $account->isJobSeeker()) {
            $rules = array_merge($rules, [
                // Basic info
                'is_whatsapp_available' => Rule::in([0, 1]),
                'alternate_phone' => 'nullable|max:30',
                'alternate_phone_country_code' => 'nullable|max:10',
                'is_alternate_whatsapp_available' => Rule::in([0, 1]),
                'marital_status' => 'nullable|in:single,married,separated,others',
                
                // Salary
                'current_salary' => 'nullable|numeric|min:0|max:99999999.99',
                'current_salary_period' => 'nullable|in:month,hour',
                'expected_salary' => 'nullable|numeric|min:0|max:99999999.99',
                'expected_salary_period' => 'nullable|in:month,hour',
                'salary_type' => 'nullable|in:yearly,monthly,weekly,hourly',
                'salary_amount' => 'nullable|numeric|min:0|max:999999999.99',
                
                // Profile visibility
                'is_public_profile' => Rule::in([0, 1]),
                'profile_visibility' => Rule::in([0, 1]),
                'hide_cv' => Rule::in([0, 1]),
                'hide_resume' => Rule::in([0, 1]),
                'hide_name_for_employer' => Rule::in([0, 1]),
                'hidden_for_schools' => 'nullable|array',
                
                // Work status
                'available_for_hiring' => Rule::in([0, 1]),
                'available_for_immediate_joining' => Rule::in([0, 1]),
                'current_work_status' => 'nullable|in:not_working,working',
                'notice_period' => 'nullable|in:7_days,15_days,1_month,2_months,3_months',
                
                // Documents
                'resume' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:2048',
                'resume_parsing_allowed' => Rule::in([0, 1]),
                'cover_letter' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:2048',
                'introductory_audio' => 'nullable|file|mimes:mp4,wav,ogg,m4a,webm|max:1536',
                'introductory_video_url' => 'nullable|url|max:500',
                
                // Qualifications & Experience
                'qualifications' => 'nullable|array',
                'qualifications.*.level' => 'nullable|in:diploma,bachelors,masters,doctorate',
                'qualifications.*.specialization' => 'nullable|string|max:200',
                'qualifications.*.institution' => 'nullable|string|max:200',
                'teaching_certifications' => 'nullable|array',
                'total_experience' => 'nullable|string|max:20',
                
                // Location
                'location_type' => 'nullable|in:current,native',
                'ready_for_relocation' => Rule::in([0, 1]),
                'native_same_as_current' => Rule::in([0, 1]),
                'native_country_id' => 'nullable|numeric',
                'native_state_id' => 'nullable|numeric',
                'native_city_id' => 'nullable|numeric',
                'native_address' => 'nullable|string|max:500',
                'native_locality' => 'nullable|string|max:255',
                'native_pin_code' => 'nullable|string|max:20',
                'work_location_preference_type' => 'nullable|in:current_only,relocation_india,other',
                'work_location_preferences' => 'nullable|array|max:3',
                'work_location_preferences.*.country_id' => 'nullable|numeric',
                'work_location_preferences.*.state_id' => 'nullable|numeric',
                'work_location_preferences.*.city_id' => 'nullable|numeric',
                'work_location_preferences.*.country_name' => 'nullable|string|max:255',
                'work_location_preferences.*.state_name' => 'nullable|string|max:255',
                'work_location_preferences.*.city_name' => 'nullable|string|max:255',
                'work_location_preferences.*.locality' => 'nullable|string|max:255',
                
                // Skills & Languages
                'favorite_skills' => 'nullable|string|max:5000',
                'favorite_tags' => 'nullable|string|max:5000',
                'languages' => 'nullable|array|max:3',
                'languages.*.language' => 'nullable|string|max:100',
                'languages.*.proficiency' => 'nullable|in:basic,intermediate,fluent,native',
                'skills' => 'nullable|array',
                
                // Job preferences
                'institution_types' => 'nullable|array',
                'position_type' => 'nullable|array',
                'teaching_subjects' => 'nullable|array',
                'non_teaching_positions' => 'nullable|array',
                'job_type_preferences' => 'nullable|array',
                'job_type_preferences.*' => 'nullable|in:full_time,part_time,contract,temporary,visiting_faculty,ad_hoc,internship,freelance,remote',
                'remote_only' => Rule::in([0, 1]),
                
                // Social links
                'social_links' => 'nullable|array',
                'social_links.linkedin' => 'nullable|url|max:500',
                'social_links.facebook' => 'nullable|url|max:500',
                'social_links.twitter' => 'nullable|url|max:500',
                'social_links.instagram' => 'nullable|url|max:500',
                'social_links.youtube' => 'nullable|url|max:500',
            ]);
        }

        return $rules;
    }

    /**
     * Get the body parameters for API documentation.
     */
    public function bodyParameters(): array
    {
        return [
            'first_name' => [
                'description' => 'User\'s first name',
                'example' => 'John',
            ],
            'last_name' => [
                'description' => 'User\'s last name',
                'example' => 'Doe',
            ],
            'phone' => [
                'description' => 'User\'s phone number',
                'example' => '+1234567890',
            ],
            'dob' => [
                'description' => 'Date of birth',
                'example' => '1990-01-01',
            ],
            'address' => [
                'description' => 'User\'s address',
                'example' => '123 Main St, City, State',
            ],
            'gender' => [
                'description' => 'User\'s gender',
                'example' => 'male',
            ],
            'description' => [
                'description' => 'User\'s description',
                'example' => 'Experienced software developer...',
            ],
            'bio' => [
                'description' => 'User\'s bio',
                'example' => 'Passionate about technology...',
            ],
            'country_id' => [
                'description' => 'Country ID',
                'example' => 1,
            ],
            'state_id' => [
                'description' => 'State ID',
                'example' => 1,
            ],
            'city_id' => [
                'description' => 'City ID',
                'example' => 1,
            ],
            'avatar' => [
                'description' => 'Avatar image file',
                'example' => 'No-example',
            ],
            'resume' => [
                'description' => 'Resume file',
                'example' => 'No-example',
            ],
            'cover_letter' => [
                'description' => 'Cover letter file',
                'example' => 'No-example',
            ],
            'is_public_profile' => [
                'description' => 'Whether profile is public (job seekers only)',
                'example' => true,
            ],
            'hide_cv' => [
                'description' => 'Whether to hide CV (job seekers only)',
                'example' => false,
            ],
            'available_for_hiring' => [
                'description' => 'Whether available for hiring (job seekers only)',
                'example' => true,
            ],
        ];
    }
}
