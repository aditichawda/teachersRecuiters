<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_jobs', function (Blueprint $table) {
            $table->json('apply_internal_phones')->nullable()->after('apply_internal_emails')
                ->comment('Up to 3 phone numbers for receiving applications');
        });
    }

    public function down(): void
    {
        Schema::table('jb_jobs', function (Blueprint $table) {
            $table->dropColumn('apply_internal_phones');
        });
    }
};
