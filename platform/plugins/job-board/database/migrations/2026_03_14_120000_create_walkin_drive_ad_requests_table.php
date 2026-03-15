<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('jb_walkin_drive_ad_requests')) {
            Schema::create('jb_walkin_drive_ad_requests', function (Blueprint $table): void {
                $table->id();
                $table->unsignedBigInteger('account_id')->comment('Employer');
                $table->unsignedBigInteger('company_id')->nullable()->comment('Institution');
                $table->string('banner_image', 500)->nullable()->comment('Banner image URL');
                $table->string('placement', 100)->default('home')->comment('home, job_listing, both');
                $table->text('message')->nullable();
                $table->string('status', 30)->default('pending');
                $table->timestamp('requested_at');
                $table->timestamp('approved_at')->nullable();
                $table->unsignedBigInteger('approved_by')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('jb_walkin_drive_ad_requests');
    }
};
