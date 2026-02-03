<?php

use Botble\Base\Supports\Database\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table): void {
            $table->string('salary_type', 20)->nullable()->after('available_for_hiring');
            $table->decimal('salary_amount', 15, 2)->nullable()->after('salary_type');
        });
    }

    public function down(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table): void {
            $table->dropColumn(['salary_type', 'salary_amount']);
        });
    }
};

