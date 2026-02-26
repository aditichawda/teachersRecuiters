<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('jb_admission_enquiries') && ! Schema::hasColumn('jb_admission_enquiries', 'age')) {
            Schema::table('jb_admission_enquiries', function (Blueprint $table) {
                $table->string('age', 50)->nullable()->after('email')->comment('Student age as of today');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('jb_admission_enquiries', 'age')) {
            Schema::table('jb_admission_enquiries', function (Blueprint $table) {
                $table->dropColumn('age');
            });
        }
    }
};
