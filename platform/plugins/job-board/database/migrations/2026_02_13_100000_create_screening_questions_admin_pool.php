<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        // Admin-managed pool of screening questions
        Schema::create('jb_screening_questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->string('question_type', 50)->default('text')
                ->comment('text, textarea, dropdown, checkbox');
            $table->text('options')->nullable()->comment('JSON array for dropdown/checkbox options');
            $table->boolean('is_required')->default(false);
            $table->integer('order')->default(0);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        // Pivot: which admin questions are selected for each job
        Schema::create('jb_jobs_screening_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jb_jobs')->cascadeOnDelete();
            $table->foreignId('screening_question_id')->constrained('jb_screening_questions')->cascadeOnDelete();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->unique(['job_id', 'screening_question_id']);
        });

        // Drop old per-job questions table if exists (from 2026_02_10 migration)
        if (Schema::hasTable('jb_job_screening_questions')) {
            Schema::dropIfExists('jb_job_screening_questions');
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('jb_jobs_screening_questions');
        Schema::dropIfExists('jb_screening_questions');

        // Recreate old structure if needed
        Schema::create('jb_job_screening_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jb_jobs')->cascadeOnDelete();
            $table->text('question');
            $table->string('question_type', 50)->default('text');
            $table->text('options')->nullable();
            $table->string('required_answer', 255)->nullable();
            $table->boolean('is_required')->default(false);
            $table->integer('order')->default(0);
            $table->string('file_types', 255)->nullable();
            $table->timestamps();
        });
    }
};
