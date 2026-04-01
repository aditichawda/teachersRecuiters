<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_jobs', function (Blueprint $table) {
            $table->boolean('enable_whatsapp_notifications')->default(false)->after('apply_internal_phones')
                ->comment('Enable WhatsApp notifications for job applications');
        });
    }

    public function down(): void
    {
        Schema::table('jb_jobs', function (Blueprint $table) {
            $table->dropColumn('enable_whatsapp_notifications');
        });
    }
};
