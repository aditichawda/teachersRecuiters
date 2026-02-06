<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('jb_accounts')) {
            Schema::table('jb_accounts', function (Blueprint $table) {
                if (!Schema::hasColumn('jb_accounts', 'institution_types')) {
                    $table->text('institution_types')->nullable()->after('institution_type');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('jb_accounts')) {
            Schema::table('jb_accounts', function (Blueprint $table) {
                if (Schema::hasColumn('jb_accounts', 'institution_types')) {
                    $table->dropColumn('institution_types');
                }
            });
        }
    }
};
