<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table): void {
            if (! Schema::hasColumn('jb_accounts', 'profile_view_credits_balance')) {
                $table->unsignedInteger('profile_view_credits_balance')->default(0)->after('job_post_credits_balance')
                    ->comment('Pre-paid candidate profile view slots (purchased via wallet); 1 slot = 1 profile view when package limit exhausted');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table): void {
            if (Schema::hasColumn('jb_accounts', 'profile_view_credits_balance')) {
                $table->dropColumn('profile_view_credits_balance');
            }
        });
    }
};
