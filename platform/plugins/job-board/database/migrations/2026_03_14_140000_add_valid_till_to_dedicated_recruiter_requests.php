<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('jb_dedicated_recruiter_requests') && ! Schema::hasColumn('jb_dedicated_recruiter_requests', 'valid_till')) {
            Schema::table('jb_dedicated_recruiter_requests', function (Blueprint $table): void {
                $table->date('valid_till')->nullable()->after('end_date')->comment('Feature valid until this date (e.g. 1 month from request)');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('jb_dedicated_recruiter_requests', 'valid_till')) {
            Schema::table('jb_dedicated_recruiter_requests', function (Blueprint $table): void {
                $table->dropColumn('valid_till');
            });
        }
    }
};
