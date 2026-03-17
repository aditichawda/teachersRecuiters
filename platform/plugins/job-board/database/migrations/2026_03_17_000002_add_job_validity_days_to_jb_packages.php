<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_packages', function (Blueprint $table): void {
            if (! Schema::hasColumn('jb_packages', 'job_validity_days')) {
                $table->unsignedInteger('job_validity_days')->nullable()->after('validity_days');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jb_packages', function (Blueprint $table): void {
            if (Schema::hasColumn('jb_packages', 'job_validity_days')) {
                $table->dropColumn('job_validity_days');
            }
        });
    }
};

