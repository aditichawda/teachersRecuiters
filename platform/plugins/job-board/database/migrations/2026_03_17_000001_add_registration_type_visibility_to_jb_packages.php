<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_packages', function (Blueprint $table): void {
            if (! Schema::hasColumn('jb_packages', 'show_for_school_institution')) {
                $table->boolean('show_for_school_institution')->default(true)->after('package_type');
            }

            if (! Schema::hasColumn('jb_packages', 'show_for_consultancy')) {
                $table->boolean('show_for_consultancy')->default(true)->after('show_for_school_institution');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jb_packages', function (Blueprint $table): void {
            $drops = [];

            if (Schema::hasColumn('jb_packages', 'show_for_school_institution')) {
                $drops[] = 'show_for_school_institution';
            }

            if (Schema::hasColumn('jb_packages', 'show_for_consultancy')) {
                $drops[] = 'show_for_consultancy';
            }

            if ($drops) {
                $table->dropColumn($drops);
            }
        });
    }
};

