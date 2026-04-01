<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            // Change position_type from varchar(20) to varchar(255) to accommodate "teaching,non_teaching"
            $table->string('position_type', 255)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            $table->string('position_type', 20)->nullable()->change();
        });
    }
};
