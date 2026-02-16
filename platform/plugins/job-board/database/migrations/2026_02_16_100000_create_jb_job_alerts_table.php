<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('jb_job_alerts', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('account_id')->constrained('jb_accounts')->onDelete('cascade');
            $table->string('name', 255)->nullable()->comment('Alert name e.g., "Math Teacher Jobs"');
            $table->string('keywords', 500)->nullable()->comment('Search keywords');
            $table->foreignId('job_category_id')->nullable()->constrained('jb_categories')->onDelete('set null');
            $table->foreignId('job_type_id')->nullable()->constrained('jb_job_types')->onDelete('set null');
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('set null');
            $table->foreignId('state_id')->nullable()->constrained('states')->onDelete('set null');
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('set null');
            $table->decimal('salary_from', 15, 2)->nullable();
            $table->decimal('salary_to', 15, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->enum('frequency', ['instant', 'daily', 'weekly'])->default('instant');
            $table->timestamp('last_sent_at')->nullable();
            $table->timestamps();

            $table->index(['account_id', 'is_active']);
            $table->index('last_sent_at');
        });

        // Pivot table to track which jobs have been sent to which alerts
        Schema::create('jb_job_alert_jobs', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('job_alert_id')->constrained('jb_job_alerts')->onDelete('cascade');
            $table->foreignId('job_id')->constrained('jb_jobs')->onDelete('cascade');
            $table->timestamp('sent_at')->useCurrent();
            $table->unique(['job_alert_id', 'job_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jb_job_alert_jobs');
        Schema::dropIfExists('jb_job_alerts');
    }
};
