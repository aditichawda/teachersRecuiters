<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_jobs', function (Blueprint $table): void {
            if (! Schema::hasColumn('jb_jobs', 'hiring_institution_type')) {
                $table->string('hiring_institution_type', 100)->nullable()->after('application_locations');
            }
            if (! Schema::hasColumn('jb_jobs', 'hiring_school_name')) {
                $table->string('hiring_school_name', 255)->nullable()->after('hiring_institution_type');
            }
            if (! Schema::hasColumn('jb_jobs', 'hide_hiring_school_name')) {
                $table->boolean('hide_hiring_school_name')->default(false)->after('hiring_school_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jb_jobs', function (Blueprint $table): void {
            $cols = [];
            if (Schema::hasColumn('jb_jobs', 'hiring_institution_type')) {
                $cols[] = 'hiring_institution_type';
            }
            if (Schema::hasColumn('jb_jobs', 'hiring_school_name')) {
                $cols[] = 'hiring_school_name';
            }
            if (Schema::hasColumn('jb_jobs', 'hide_hiring_school_name')) {
                $cols[] = 'hide_hiring_school_name';
            }
            if (! empty($cols)) {
                $table->dropColumn($cols);
            }
        });
    }
};
