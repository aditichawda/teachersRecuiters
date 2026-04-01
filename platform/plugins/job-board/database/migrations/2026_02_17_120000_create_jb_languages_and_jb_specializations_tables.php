<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('jb_languages')) {
            Schema::create('jb_languages', function (Blueprint $table) {
                $table->id();
                $table->string('name', 120);
                $table->integer('order')->default(0);
                $table->tinyInteger('is_default')->unsigned()->default(0);
                $table->string('status', 60)->default('published');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('jb_specializations')) {
            Schema::create('jb_specializations', function (Blueprint $table) {
                $table->id();
                $table->string('name', 120);
                $table->integer('order')->default(0);
                $table->tinyInteger('is_default')->unsigned()->default(0);
                $table->string('status', 60)->default('published');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('jb_specializations');
        Schema::dropIfExists('jb_languages');
    }
};
