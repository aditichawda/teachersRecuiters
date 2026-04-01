<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Job-specific screening questions (employer adds per job, not stored in admin pool).
     */
    public function up(): void
    {
        if (Schema::hasTable('jb_job_screening_questions')) {
            return;
        }

        Schema::create('jb_job_screening_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jb_jobs')->cascadeOnDelete();
            $table->text('question');
            $table->string('question_type', 50)->default('text')
                ->comment('text, textarea, dropdown, checkbox');
            $table->text('options')->nullable()->comment('JSON array for dropdown/checkbox options');
            $table->boolean('is_required')->default(false);
            $table->string('correct_answer', 500)->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jb_job_screening_questions');
    }
};
