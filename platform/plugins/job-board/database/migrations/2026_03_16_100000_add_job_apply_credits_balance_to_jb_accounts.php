<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table): void {
            if (! Schema::hasColumn('jb_accounts', 'job_apply_credits_balance')) {
                $table->unsignedInteger('job_apply_credits_balance')->default(0)->after('profile_view_credits_balance')
                    ->comment('Job seeker: pre-paid job application slots (purchased via wallet Use credits); 1 slot = 1 application when package limit exhausted');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table): void {
            if (Schema::hasColumn('jb_accounts', 'job_apply_credits_balance')) {
                $table->dropColumn('job_apply_credits_balance');
            }
        });
    }
};
