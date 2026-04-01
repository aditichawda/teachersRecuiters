<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_jobs', function (Blueprint $table) {
            $table->json('apply_internal_emails')->nullable()->after('apply_other_email')
                ->comment('Up to 3 internal/registered emails for receiving applications');
        });
    }

    public function down(): void
    {
        Schema::table('jb_jobs', function (Blueprint $table) {
            $table->dropColumn('apply_internal_emails');
        });
    }
};
