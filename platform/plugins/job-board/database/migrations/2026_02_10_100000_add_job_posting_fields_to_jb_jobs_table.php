<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        // Add new columns to jb_jobs
        Schema::table('jb_jobs', function (Blueprint $table) {
            $table->string('job_type_category', 50)->nullable()->after('company_id')->comment('teaching or non-teaching');
            $table->text('required_certifications')->nullable()->after('degree_level_id')->comment('JSON array of certifications');
            $table->string('gender_preference', 50)->nullable()->after('number_of_positions');
            $table->string('application_location_type', 50)->nullable()->after('gender_preference')->comment('nearby, specific, anywhere');
            $table->text('application_locations')->nullable()->after('application_location_type')->comment('JSON for specific locations');
            $table->string('marital_status_preference', 50)->nullable()->after('application_locations');
            $table->text('language_proficiency')->nullable()->after('marital_status_preference')->comment('JSON array');
            $table->string('apply_type', 50)->nullable()->default('internal')->after('apply_url')->comment('internal, external, other_email');
            $table->string('apply_other_email', 255)->nullable()->after('apply_type');
            $table->boolean('is_remote')->default(false)->after('is_freelance');
        });

        // Create screening questions table
        Schema::create('jb_job_screening_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jb_jobs')->cascadeOnDelete();
            $table->text('question');
            $table->string('question_type', 50)->default('text')->comment('text, textarea, dropdown, checkbox, file, link');
            $table->text('options')->nullable()->comment('JSON for dropdown/checkbox options');
            $table->string('required_answer', 255)->nullable()->comment('correct answer for dropdown type');
            $table->boolean('is_required')->default(false);
            $table->integer('order')->default(0);
            $table->string('file_types', 255)->nullable()->comment('allowed file types for file upload');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jb_job_screening_questions');

        Schema::table('jb_jobs', function (Blueprint $table) {
            $table->dropColumn([
                'job_type_category',
                'required_certifications',
                'gender_preference',
                'application_location_type',
                'application_locations',
                'marital_status_preference',
                'language_proficiency',
                'apply_type',
                'apply_other_email',
                'is_remote',
            ]);
        });
    }
};
