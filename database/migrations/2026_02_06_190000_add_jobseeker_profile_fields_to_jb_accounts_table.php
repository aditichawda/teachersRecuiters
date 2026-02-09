<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            // Personal Details
            $table->string('alternate_phone', 30)->nullable()->after('phone');
            $table->string('alternate_phone_country_code', 10)->nullable()->after('alternate_phone');
            $table->string('marital_status', 20)->nullable()->after('gender'); // single, married, separated, others
            
            // Salary fields
            $table->decimal('current_salary', 12, 2)->nullable()->after('salary_amount');
            $table->decimal('expected_salary', 12, 2)->nullable()->after('current_salary');
            
            // Profile Visibility
            $table->boolean('profile_visibility')->default(true)->after('is_public_profile'); // Open for School View
            $table->boolean('hide_resume')->default(false)->after('hide_cv');
            $table->boolean('hide_name_for_employer')->default(false)->after('hide_resume');
            $table->json('hidden_for_schools')->nullable()->after('hide_name_for_employer'); // Array of school IDs
            
            // Work Status
            $table->string('current_work_status', 30)->nullable()->after('available_for_hiring'); // not_working, working
            $table->string('notice_period', 20)->nullable()->after('current_work_status'); // 7_days, 15_days, 1_month, 2_months, 3_months
            $table->boolean('available_for_immediate_joining')->default(false)->after('notice_period');
            
            // About/Bio (already exists as 'bio', adding career_aspiration)
            $table->text('career_aspiration')->nullable()->after('bio');
            
            // Introductory Audio
            $table->string('introductory_audio')->nullable()->after('career_aspiration');
            $table->integer('introductory_audio_duration')->nullable()->after('introductory_audio'); // in seconds
            
            // Qualifications (JSON array)
            $table->json('qualifications')->nullable()->after('introductory_audio_duration');
            // Format: [{"level": "bachelors", "specialization": "education", "institution": "...", "year": 2020}]
            
            // Certifications
            $table->json('teaching_certifications')->nullable()->after('qualifications');
            // Format: ["b_ed", "ctet", "tet"]
            
            // Experience
            $table->string('total_experience', 20)->nullable()->after('teaching_certifications'); // fresher, intern, 1-15+ years
            
            // Location preferences
            $table->boolean('ready_for_relocation')->default(false)->after('location_type');
            $table->json('work_location_preferences')->nullable()->after('ready_for_relocation');
            // Format: [{"priority": 1, "country_id": 1, "state_id": 2, "city_id": 3}]
            
            // Languages
            $table->json('languages')->nullable()->after('work_location_preferences');
            // Format: [{"language": "English", "proficiency": "fluent", "priority": 1}]
            
            // Skills
            $table->json('skills')->nullable()->after('languages');
            // Format: [{"skill": "Classroom Management", "priority": 1}]
            
            // Position type
            $table->string('position_type', 20)->nullable()->after('institution_types'); // teaching, non_teaching
            
            // Teaching subjects/posts (already may exist, adding if not)
            $table->json('teaching_subjects')->nullable()->after('position_type');
            // Format: [{"subject": "english_primary", "priority": 1}]
            
            // Non-Teaching positions
            $table->json('non_teaching_positions')->nullable()->after('teaching_subjects');
            // Format: ["principal", "administrator", "counselor"]
            
            // Job Type preferences
            $table->json('job_type_preferences')->nullable()->after('non_teaching_positions');
            // Format: [{"type": "full_time", "priority": 1}, {"type": "remote", "priority": 2}]
            $table->boolean('remote_only')->default(false)->after('job_type_preferences');
            
            // Cover letter (already exists)
            
            // Social Links
            $table->json('social_links')->nullable()->after('cover_letter');
            // Format: {"linkedin": "...", "facebook": "...", "twitter": "...", "instagram": "..."}
            
            // YouTube Video
            $table->string('introductory_video_url')->nullable()->after('social_links');
            
            // Resume parsing permission
            $table->boolean('resume_parsing_allowed')->default(false)->after('resume');
        });
    }

    public function down(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            $table->dropColumn([
                'alternate_phone',
                'alternate_phone_country_code',
                'marital_status',
                'current_salary',
                'expected_salary',
                'profile_visibility',
                'hide_resume',
                'hide_name_for_employer',
                'hidden_for_schools',
                'current_work_status',
                'notice_period',
                'available_for_immediate_joining',
                'career_aspiration',
                'introductory_audio',
                'introductory_audio_duration',
                'qualifications',
                'teaching_certifications',
                'total_experience',
                'ready_for_relocation',
                'work_location_preferences',
                'languages',
                'skills',
                'position_type',
                'teaching_subjects',
                'job_type_preferences',
                'remote_only',
                'social_links',
                'introductory_video_url',
                'resume_parsing_allowed',
            ]);
        });
    }
};
