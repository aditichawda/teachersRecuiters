<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_packages', function (Blueprint $table): void {
            $table->string('package_type', 30)->default('employer')->after('status');
            $table->unsignedInteger('validity_days')->nullable()->after('package_type');
            $table->unsignedInteger('credits_included')->nullable()->after('validity_days');
            $table->unsignedInteger('profile_views_allowed')->nullable()->after('credits_included');
            $table->decimal('worth', 15, 2)->nullable()->after('profile_views_allowed');
        });
    }

    public function down(): void
    {
        Schema::table('jb_packages', function (Blueprint $table): void {
            $table->dropColumn([
                'package_type',
                'validity_days',
                'credits_included',
                'profile_views_allowed',
                'worth',
            ]);
        });
    }
};
