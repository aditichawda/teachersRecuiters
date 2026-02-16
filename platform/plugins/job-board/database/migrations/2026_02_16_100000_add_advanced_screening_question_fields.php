<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_screening_questions', function (Blueprint $table) {
            $table->string('category', 80)->nullable()->after('status')
                ->comment('education, experience, teaching_cert, language, relocation, notice_period, location, relevant_experience, why_applying, gender, interview, custom');
        });

        Schema::table('jb_jobs_screening_questions', function (Blueprint $table) {
            $table->text('question_override')->nullable()->after('is_required')
                ->comment('Employer-edited question text');
            $table->text('options_override')->nullable()->after('question_override')
                ->comment('Employer-edited options JSON');
            $table->string('correct_answer', 500)->nullable()->after('options_override')
                ->comment('Answer that is correct; wrong answer restricts candidate from applying');
        });
    }

    public function down(): void
    {
        Schema::table('jb_screening_questions', function (Blueprint $table) {
            $table->dropColumn('category');
        });
        Schema::table('jb_jobs_screening_questions', function (Blueprint $table) {
            $table->dropColumn(['question_override', 'options_override', 'correct_answer']);
        });
    }
};
