<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_transactions', function (Blueprint $table): void {
            if (! Schema::hasColumn('jb_transactions', 'feature_key')) {
                $table->string('feature_key', 80)->nullable()->after('account_type')
                    ->comment('Credit consumption feature key (e.g. job_posting, featured_job)');
            }

            if (! Schema::hasColumn('jb_transactions', 'meta')) {
                $table->json('meta')->nullable()->after('feature_key')
                    ->comment('Extra info for feature purchases (JSON)');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jb_transactions', function (Blueprint $table): void {
            if (Schema::hasColumn('jb_transactions', 'meta')) {
                $table->dropColumn('meta');
            }
            if (Schema::hasColumn('jb_transactions', 'feature_key')) {
                $table->dropColumn('feature_key');
            }
        });
    }
};

