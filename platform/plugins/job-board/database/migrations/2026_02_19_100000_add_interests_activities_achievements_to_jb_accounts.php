<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            if (! Schema::hasColumn('jb_accounts', 'interests')) {
                $table->text('interests')->nullable();
            }
            if (! Schema::hasColumn('jb_accounts', 'activities')) {
                $table->text('activities')->nullable();
            }
            if (! Schema::hasColumn('jb_accounts', 'achievements')) {
                $table->text('achievements')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            $table->dropColumn(['interests', 'activities', 'achievements']);
        });
    }
};
