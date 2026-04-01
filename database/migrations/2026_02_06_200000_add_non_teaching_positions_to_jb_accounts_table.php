<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            if (!Schema::hasColumn('jb_accounts', 'non_teaching_positions')) {
                $table->json('non_teaching_positions')->nullable()->after('teaching_subjects');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            $table->dropColumn('non_teaching_positions');
        });
    }
};
