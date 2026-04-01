<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_screening_questions', function (Blueprint $table) {
            $table->string('correct_answer', 500)->nullable()->after('category')
                ->comment('Default correct answer (employer can override per job in pivot)');
        });
    }

    public function down(): void
    {
        Schema::table('jb_screening_questions', function (Blueprint $table) {
            $table->dropColumn('correct_answer');
        });
    }
};
