<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasColumn('jb_accounts', 'parent_account_id')) {
            Schema::table('jb_accounts', function (Blueprint $table): void {
                $table->unsignedBigInteger('parent_account_id')->nullable()->after('id');
                $table->string('sub_account_role', 60)->nullable()->after('parent_account_id');
            });
        }

        if (! Schema::hasTable('jb_job_invites')) {
            Schema::create('jb_job_invites', function (Blueprint $table): void {
                $table->id();
                $table->unsignedBigInteger('job_id');
                $table->unsignedBigInteger('account_id')->comment('Employer who sent invite');
                $table->unsignedBigInteger('candidate_id')->nullable();
                $table->string('email', 255)->nullable();
                $table->string('status', 30)->default('sent');
                $table->timestamp('invited_at');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('jb_dedicated_recruiter_requests')) {
            Schema::create('jb_dedicated_recruiter_requests', function (Blueprint $table): void {
                $table->id();
                $table->unsignedBigInteger('account_id')->comment('Employer');
                $table->unsignedSmallInteger('duration_months')->default(1);
                $table->unsignedBigInteger('company_id')->nullable()->comment('Institution id');
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->text('note')->nullable();
                $table->string('status', 30)->default('pending');
                $table->timestamp('requested_at');
                $table->timestamp('accepted_at')->nullable();
                $table->unsignedBigInteger('accepted_by')->nullable()->comment('Admin user id');
                $table->unsignedBigInteger('staff_id')->nullable()->comment('Staff assigned - admin fills');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('jb_social_promotion_requests')) {
            Schema::create('jb_social_promotion_requests', function (Blueprint $table): void {
                $table->id();
                $table->unsignedBigInteger('account_id')->comment('Employer');
                $table->unsignedBigInteger('company_id')->nullable()->comment('Institution id');
                $table->string('title', 255)->nullable();
                $table->string('tag', 255)->nullable();
                $table->string('platform', 60)->nullable();
                $table->text('message')->nullable();
                $table->string('image', 500)->nullable();
                $table->string('status', 30)->default('pending');
                $table->timestamp('requested_at');
                $table->timestamp('accepted_at')->nullable();
                $table->unsignedBigInteger('accepted_by')->nullable();
                $table->timestamp('posted_at')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('jb_social_promotion_requests');
        Schema::dropIfExists('jb_dedicated_recruiter_requests');
        Schema::dropIfExists('jb_job_invites');
        if (Schema::hasColumn('jb_accounts', 'parent_account_id')) {
            Schema::table('jb_accounts', function (Blueprint $table): void {
                $table->dropColumn(['parent_account_id', 'sub_account_role']);
            });
        }
    }
};
