<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('jb_job_posting_assistance_requests')) {
            Schema::create('jb_job_posting_assistance_requests', function (Blueprint $table): void {
                $table->id();
                $table->unsignedBigInteger('account_id')->comment('Employer');
                $table->unsignedBigInteger('company_id')->nullable()->comment('Institution id');
                $table->string('institution_name', 255)->nullable()->comment('Institution name stored on approve');
                $table->text('message')->nullable();
                $table->string('status', 30)->default('pending');
                $table->timestamp('requested_at');
                $table->timestamp('accepted_at')->nullable();
                $table->unsignedBigInteger('accepted_by')->nullable()->comment('Admin user id');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('jb_job_posting_assistance_requests');
    }
};
