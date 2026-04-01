<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            $table->string('pin_code', 20)->nullable()->after('address');
            $table->string('locality', 255)->nullable()->after('pin_code');
            $table->boolean('native_same_as_current')->default(false)->after('work_location_preferences');
            $table->foreignId('native_country_id')->nullable()->after('native_same_as_current');
            $table->foreignId('native_state_id')->nullable()->after('native_country_id');
            $table->foreignId('native_city_id')->nullable()->after('native_state_id');
            $table->string('native_address', 500)->nullable()->after('native_city_id');
            $table->string('native_locality', 255)->nullable()->after('native_address');
            $table->string('native_pin_code', 20)->nullable()->after('native_locality');
            $table->string('work_location_preference_type', 50)->nullable()->after('native_pin_code')->comment('current_only, relocation_india, other');
        });
    }

    public function down(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            $table->dropColumn([
                'pin_code',
                'locality',
                'native_same_as_current',
                'native_country_id',
                'native_state_id',
                'native_city_id',
                'native_address',
                'native_locality',
                'native_pin_code',
                'work_location_preference_type',
            ]);
        });
    }
};
