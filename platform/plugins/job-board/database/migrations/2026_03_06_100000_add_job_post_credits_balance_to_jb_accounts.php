<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table): void {
            if (! Schema::hasColumn('jb_accounts', 'job_post_credits_balance')) {
                $table->unsignedInteger('job_post_credits_balance')->default(0)->after('credits')
                    ->comment('Pre-paid job post slots (purchased via wallet popup); 1 slot = 1 job create allowed');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table): void {
            $table->dropColumn('job_post_credits_balance');
        });
    }
};
