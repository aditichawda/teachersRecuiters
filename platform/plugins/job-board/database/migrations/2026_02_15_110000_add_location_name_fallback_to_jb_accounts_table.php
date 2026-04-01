<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            $table->string('country_name', 255)->nullable()->after('city_id');
            $table->string('state_name', 255)->nullable()->after('country_name');
            $table->string('city_name', 255)->nullable()->after('state_name');
            $table->string('native_country_name', 255)->nullable()->after('native_city_id');
            $table->string('native_state_name', 255)->nullable()->after('native_country_name');
            $table->string('native_city_name', 255)->nullable()->after('native_state_name');
        });
    }

    public function down(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            $table->dropColumn([
                'country_name', 'state_name', 'city_name',
                'native_country_name', 'native_state_name', 'native_city_name',
            ]);
        });
    }
};
