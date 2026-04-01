<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_applications', function (Blueprint $table) {
            $table->json('screening_answers')->nullable()->after('message')->comment('JSON: question_id => answer');
        });
    }

    public function down(): void
    {
        Schema::table('jb_applications', function (Blueprint $table) {
            $table->dropColumn('screening_answers');
        });
    }
};
