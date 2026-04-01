<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            // Step 1: Full name (replacing first_name + last_name)
            $table->string('full_name', 250)->nullable()->after('last_name');
            
            // Step 1: Phone and resume fields
            $table->string('phone_country_code', 10)->nullable()->after('phone');
            $table->boolean('is_whatsapp_available')->default(false)->after('phone_country_code');
            
            // Step 2: Institution fields
            $table->string('institution_type', 100)->nullable()->after('type');
            $table->string('institution_name', 200)->nullable()->after('institution_type');
            
            // Step 3: Location type
            $table->string('location_type', 50)->nullable()->after('city_id'); // 'current' or 'native'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            $table->dropColumn([
                'full_name',
                'phone_country_code',
                'is_whatsapp_available',
                'institution_type',
                'institution_name',
                'location_type',
            ]);
        });
    }
};
