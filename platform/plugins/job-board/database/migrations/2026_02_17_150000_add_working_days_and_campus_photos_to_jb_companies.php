<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_companies', function (Blueprint $table): void {
            if (!Schema::hasColumn('jb_companies', 'working_days')) {
                $table->json('working_days')->nullable();
            }
            if (!Schema::hasColumn('jb_companies', 'working_hours_start')) {
                $table->string('working_hours_start', 10)->nullable();
            }
            if (!Schema::hasColumn('jb_companies', 'working_hours_end')) {
                $table->string('working_hours_end', 10)->nullable();
            }
            if (!Schema::hasColumn('jb_companies', 'campus_photos')) {
                $table->json('campus_photos')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('jb_companies', function (Blueprint $table): void {
            $table->dropColumn(['working_days', 'working_hours_start', 'working_hours_end', 'campus_photos']);
        });
    }
};
