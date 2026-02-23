<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ads', function (Blueprint $table): void {
            if (!Schema::hasColumn('ads', 'banner_type')) {
                $table->string('banner_type', 50)->default('single')->after('ads_type')->comment('single, double, multiple');
            }
            if (!Schema::hasColumn('ads', 'page_type')) {
                $table->string('page_type', 100)->nullable()->after('location')->comment('home, jobs, candidates, company, etc.');
            }
            if (!Schema::hasColumn('ads', 'position')) {
                $table->string('position', 100)->nullable()->after('page_type')->comment('top, sidebar, bottom, between-content, etc.');
            }
            if (!Schema::hasColumn('ads', 'image_2')) {
                $table->string('image_2')->nullable()->after('mobile_image')->comment('Second image for double/multiple banners');
            }
            if (!Schema::hasColumn('ads', 'image_3')) {
                $table->string('image_3')->nullable()->after('image_2')->comment('Third image for multiple banners');
            }
            if (!Schema::hasColumn('ads', 'url_2')) {
                $table->string('url_2')->nullable()->after('url')->comment('URL for second banner');
            }
            if (!Schema::hasColumn('ads', 'url_3')) {
                $table->string('url_3')->nullable()->after('url_2')->comment('URL for third banner');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ads', function (Blueprint $table): void {
            $table->dropColumn([
                'banner_type',
                'page_type',
                'position',
                'image_2',
                'image_3',
                'url_2',
                'url_3',
            ]);
        });
    }
};
