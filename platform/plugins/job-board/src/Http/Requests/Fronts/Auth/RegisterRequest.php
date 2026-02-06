<?php

namespace Botble\JobBoard\Http\Requests\Fronts\Auth;

use Botble\Base\Facades\BaseHelper;
use Botble\Support\Http\Requests\Request;

class RegisterRequest extends Request
{
    public function rules(): array
    {
        // Get temp account ID from session to exclude from unique check
        $sessionData = session('registration_email_verification', []);
        $tempAccountId = $sessionData['temp_account_id'] ?? null;
        
        $emailRule = ['required', 'max:60', 'min:6', 'email'];
        if ($tempAccountId) {
            $emailRule[] = 'unique:jb_accounts,email,' . $tempAccountId;
        } else {
            $emailRule[] = 'unique:jb_accounts,email';
        }
        
        $rules = [
            // Step 1: Basic Information
            'full_name' => ['required', 'max:250', 'min:2'],
            'email' => $emailRule,
            'phone' => ['required', BaseHelper::getPhoneValidationRule()],
            'phone_country_code' => ['nullable', 'string', 'max:10'],
            'is_whatsapp_available' => ['nullable', 'boolean'],
            'resume' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'], // Made nullable for multi-step registration
            'password' => ['required', 'min:6', 'confirmed'],
            
            // Step 2: Institution Type
            'institution_type' => ['nullable', 'in:school,edtech-company,online-education-platform,college,coaching-institute,book-publishing-company,non-profit-organization'],
            'institution_name' => ['nullable', 'string', 'max:200'],
            
            // Step 3: Location
            'country_id' => ['nullable', 'numeric'],
            'state_id' => ['nullable', 'numeric'],
            'city_id' => ['nullable', 'numeric'],
            'location_type' => ['nullable', 'in:current,native'],
            
            // Field 23: Educational Institutions (up to 3 with priority)
            'educational_institutions' => ['nullable', 'array', 'max:3'],
            'educational_institutions.*.type' => ['required', 'in:school,edtech-company,online-education-platform,college,coaching-institute,book-publishing-company,non-profit-organization,university,distance-learning,teacher-training-academy,sports-academy'],
            'educational_institutions.*.priority' => ['required', 'in:1,2,3'],
            'educational_institutions.*.school_board_type' => ['nullable', 'in:cbse,cicse,cambridge,igcse,ib,primary,play,state-board'],
            'educational_institutions.*.state_board' => ['nullable', 'in:mp-board,rajasthan-board,maharashtra-board,gujarat-board,karnataka-board,tamil-nadu-board,west-bengal-board,up-board'],
            'educational_institutions.*.college_type' => ['nullable', 'in:medical-college,engineering-college,nursing-college,arts-college,commerce-college,science-college'],
            'educational_institutions.*.coaching_type' => ['nullable', 'in:jee-neet,banking,ssc,upsc,gate,cat'],
            'educational_institutions_json' => ['nullable', 'string'],
            
            // Field 24: Position Type
            'position_type' => ['nullable', 'array'],
            'position_type.*' => ['in:teaching,non-teaching'],
            
            // Field 25: Teaching Subject or Post (up to 3 with priority)
            'subject_posts' => ['nullable', 'array', 'max:3'],
            'subject_posts.*.type' => ['required', 'in:teaching,non-teaching'],
            'subject_posts.*.teaching_subject' => ['nullable', 'in:english-primary,english-upper-primary,social-studies-primary,mathematics-secondary,physics-secondary,commerce-higher-secondary,mathematics-higher-secondary,english-degree-college,biology-higher-secondary,zoology-degree-college,mechanics-engineering-college'],
            'subject_posts.*.non_teaching_position' => ['nullable', 'in:school-principal,administrator,hr,hostel-warden,counselor,academic-coordinator'],
            'subject_posts.*.priority' => ['required', 'in:1,2,3'],
            'subject_post_type' => ['nullable', 'in:teaching,non-teaching'],
            'teaching_subjects_posts_json' => ['nullable', 'string'],
            
            // Field 26: Job Type
            'job_type' => ['nullable', 'array'],
            'job_type.*' => ['in:full-time,part-time,internship,freelance,contract,remote'],
            'full_time_options' => ['nullable', 'array', 'max:2'],
            'full_time_options.*.type' => ['required', 'in:regular,permanent,fixed-term,probationary'],
            'full_time_options.*.priority' => ['required', 'in:1,2'],
            'job_types_json' => ['nullable', 'string'],
            
            // Verification code for direct registration
            'verification_code' => ['nullable', 'regex:/^[0-9]{5,6}$/'],
        ];

        // Add account type validation when employer registration is enabled
        if (setting('job_board_enabled_register_as_employer', 1)) {
            $rules['account_type'] = ['nullable', 'in:job-seeker,employer'];
        }

        return $rules;
    }
}
