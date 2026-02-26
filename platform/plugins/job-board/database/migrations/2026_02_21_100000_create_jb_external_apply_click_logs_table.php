<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('jb_external_apply_click_logs', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('job_id')->constrained('jb_jobs')->cascadeOnDelete();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->foreignId('account_id')->nullable()->constrained('jb_accounts')->nullOnDelete();
            $table->string('referer', 500)->nullable();
            $table->timestamp('clicked_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jb_external_apply_click_logs');
    }
};
