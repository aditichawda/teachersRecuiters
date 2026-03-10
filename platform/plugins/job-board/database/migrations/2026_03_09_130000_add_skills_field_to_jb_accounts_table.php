<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table): void {
            if (! Schema::hasColumn('jb_accounts', 'skills')) {
                // Store selected skills (from favorite_skills) as JSON array on the account for quick access/search
                $table->json('skills')->nullable()->after('languages');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table): void {
            if (Schema::hasColumn('jb_accounts', 'skills')) {
                $table->dropColumn('skills');
            }
        });
    }
};

