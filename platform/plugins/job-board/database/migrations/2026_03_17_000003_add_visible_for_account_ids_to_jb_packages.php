<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_packages', function (Blueprint $table): void {
            if (! Schema::hasColumn('jb_packages', 'visible_for_account_ids')) {
                $table->json('visible_for_account_ids')->nullable()->after('show_for_consultancy');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jb_packages', function (Blueprint $table): void {
            if (Schema::hasColumn('jb_packages', 'visible_for_account_ids')) {
                $table->dropColumn('visible_for_account_ids');
            }
        });
    }
};

