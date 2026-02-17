<?php

/**
 * Cursor AI: Stash apply se restore. Employer profile fields (institution_type, principal_name, etc.). See CURSOR_AI_CHANGES.md - 17 Feb 2026
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_companies', function (Blueprint $table): void {
            // Institution type
            $table->string('institution_type', 100)->nullable()->after('name');

            // Total staff
            $table->unsignedSmallInteger('total_staff')->nullable()->after('principal_name');

            // Campus type
            $table->string('campus_type', 50)->nullable()->after('total_staff');

            // Facilities available for staff
            $table->json('staff_facilities')->nullable()->after('campus_type');

            // Standard level
            $table->json('standard_level')->nullable()->after('staff_facilities');

            // YouTube video link
            $table->string('youtube_video', 500)->nullable()->after('instagram');

            // Google link
            $table->string('google', 255)->nullable()->after('youtube_video');

            // Awards (JSON array: [{title, year, photo}])
            $table->json('awards')->nullable()->after('google');

            // Affiliations (JSON array: [{title, photo}])
            $table->json('affiliations')->nullable()->after('awards');

            // Team members (JSON array: [{name, designation, social_links}])
            $table->json('team_members')->nullable()->after('affiliations');
        });
    }

    public function down(): void
    {
        Schema::table('jb_companies', function (Blueprint $table): void {
            $table->dropColumn([
                'institution_type',
                'principal_name',
                'total_staff',
                'campus_type',
                'staff_facilities',
                'standard_level',
                'youtube_video',
                'google',
                'awards',
                'affiliations',
                'team_members',
            ]);
        });
    }
};
