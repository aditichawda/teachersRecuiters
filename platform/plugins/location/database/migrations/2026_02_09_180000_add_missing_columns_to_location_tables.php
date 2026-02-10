<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add missing 'order' column to countries table
        if (Schema::hasTable('countries') && !Schema::hasColumn('countries', 'order')) {
            Schema::table('countries', function (Blueprint $table) {
                $table->tinyInteger('order')->default(0)->after('name');
            });
        }

        // Add missing columns to states table
        if (Schema::hasTable('states')) {
            if (!Schema::hasColumn('states', 'order')) {
                Schema::table('states', function (Blueprint $table) {
                    $table->tinyInteger('order')->default(0)->after('country_id');
                });
            }
            if (!Schema::hasColumn('states', 'slug')) {
                Schema::table('states', function (Blueprint $table) {
                    $table->string('slug', 120)->nullable()->after('name');
                });
            }
            if (!Schema::hasColumn('states', 'abbreviation')) {
                Schema::table('states', function (Blueprint $table) {
                    $table->string('abbreviation', 10)->nullable()->after('name');
                });
            }
            if (!Schema::hasColumn('states', 'image')) {
                Schema::table('states', function (Blueprint $table) {
                    $table->string('image', 255)->nullable()->after('country_id');
                });
            }
            if (!Schema::hasColumn('states', 'is_default')) {
                Schema::table('states', function (Blueprint $table) {
                    $table->tinyInteger('is_default')->unsigned()->default(0)->after('order');
                });
            }
        }

        // Add missing columns to cities table
        if (Schema::hasTable('cities')) {
            if (!Schema::hasColumn('cities', 'order')) {
                Schema::table('cities', function (Blueprint $table) {
                    $table->tinyInteger('order')->default(0)->after('state_id');
                });
            }
            if (!Schema::hasColumn('cities', 'slug')) {
                Schema::table('cities', function (Blueprint $table) {
                    $table->string('slug', 120)->nullable()->after('name');
                });
            }
            if (!Schema::hasColumn('cities', 'image')) {
                Schema::table('cities', function (Blueprint $table) {
                    $table->string('image', 255)->nullable()->after('state_id');
                });
            }
            if (!Schema::hasColumn('cities', 'country_id')) {
                Schema::table('cities', function (Blueprint $table) {
                    $table->unsignedBigInteger('country_id')->nullable()->after('state_id');
                });
            }
            if (!Schema::hasColumn('cities', 'record_id')) {
                Schema::table('cities', function (Blueprint $table) {
                    $table->string('record_id', 40)->nullable()->after('country_id');
                });
            }
            if (!Schema::hasColumn('cities', 'is_default')) {
                Schema::table('cities', function (Blueprint $table) {
                    $table->tinyInteger('is_default')->unsigned()->default(0)->after('order');
                });
            }
        }
    }

    public function down(): void
    {
        $columnsToCheck = [
            'countries' => ['order'],
            'states' => ['order', 'slug', 'abbreviation', 'image', 'is_default'],
            'cities' => ['order', 'slug', 'image', 'country_id', 'record_id', 'is_default'],
        ];

        foreach ($columnsToCheck as $tableName => $columns) {
            if (Schema::hasTable($tableName)) {
                $dropColumns = [];
                foreach ($columns as $col) {
                    if (Schema::hasColumn($tableName, $col)) {
                        $dropColumns[] = $col;
                    }
                }
                if (!empty($dropColumns)) {
                    Schema::table($tableName, function (Blueprint $table) use ($dropColumns) {
                        $table->dropColumn($dropColumns);
                    });
                }
            }
        }
    }
};
