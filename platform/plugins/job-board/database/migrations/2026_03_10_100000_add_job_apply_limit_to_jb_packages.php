<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_packages', function (Blueprint $table): void {
            if (! Schema::hasColumn('jb_packages', 'job_apply_limit')) {
                $table->unsignedInteger('job_apply_limit')->nullable()->after('profile_views_allowed')->comment('Job seeker: max job applications in package period');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jb_packages', function (Blueprint $table): void {
            $table->dropColumn('job_apply_limit');
        });
    }
};
