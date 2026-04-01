<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jb_user_notifications', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('account_id')->constrained('jb_accounts')->onDelete('cascade');
            $table->string('type', 50)->default('general'); // job_alert, application, message, profile, etc.
            $table->string('title');
            $table->text('message');
            $table->string('icon', 50)->default('feather-bell'); // feather icon class
            $table->string('color', 20)->default('#1967d2'); // hex color
            $table->string('action_url')->nullable(); // URL to redirect when clicked
            $table->timestamp('read_at')->nullable();
            $table->json('data')->nullable(); // Additional data like job_id, application_id, etc.
            $table->timestamps();

            $table->index(['account_id', 'read_at']);
            $table->index(['account_id', 'type']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jb_user_notifications');
    }
};
