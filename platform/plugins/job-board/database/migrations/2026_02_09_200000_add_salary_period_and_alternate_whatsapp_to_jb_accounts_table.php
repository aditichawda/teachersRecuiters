<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            if (!Schema::hasColumn('jb_accounts', 'is_alternate_whatsapp_available')) {
                $table->boolean('is_alternate_whatsapp_available')->default(false)->after('alternate_phone_country_code');
            }
            if (!Schema::hasColumn('jb_accounts', 'current_salary_period')) {
                $table->string('current_salary_period', 20)->default('month')->after('current_salary');
            }
            if (!Schema::hasColumn('jb_accounts', 'expected_salary_period')) {
                $table->string('expected_salary_period', 20)->default('month')->after('expected_salary');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            if (Schema::hasColumn('jb_accounts', 'is_alternate_whatsapp_available')) {
                $table->dropColumn('is_alternate_whatsapp_available');
            }
            if (Schema::hasColumn('jb_accounts', 'current_salary_period')) {
                $table->dropColumn('current_salary_period');
            }
            if (Schema::hasColumn('jb_accounts', 'expected_salary_period')) {
                $table->dropColumn('expected_salary_period');
            }
        });
    }
};
