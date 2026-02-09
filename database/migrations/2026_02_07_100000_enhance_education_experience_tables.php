<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        // Add new columns to education table
        Schema::table('jb_account_educations', function (Blueprint $table) {
            $table->string('level', 50)->nullable()->after('school'); // diploma, bachelors, masters, doctorate
            $table->boolean('is_current')->default(false)->after('ended_at');
        });

        // Add new columns to experience table
        Schema::table('jb_account_experiences', function (Blueprint $table) {
            $table->string('employment_type', 50)->nullable()->after('position'); // full_time, part_time, contract, internship, freelance
            $table->string('location', 255)->nullable()->after('employment_type');
            $table->boolean('is_current')->default(false)->after('ended_at');
        });
    }

    public function down(): void
    {
        Schema::table('jb_account_educations', function (Blueprint $table) {
            $table->dropColumn(['level', 'is_current']);
        });

        Schema::table('jb_account_experiences', function (Blueprint $table) {
            $table->dropColumn(['employment_type', 'location', 'is_current']);
        });
    }
};
