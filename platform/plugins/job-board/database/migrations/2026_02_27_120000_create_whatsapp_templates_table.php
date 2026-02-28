<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('whatsapp_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Template name (e.g., job_application_alert)');
            $table->string('display_name')->nullable()->comment('Human readable template name');
            $table->text('description')->nullable()->comment('Template description');
            $table->string('language_code', 10)->default('en')->comment('Template language code');
            $table->json('parameters')->nullable()->comment('Template parameters structure');
            $table->boolean('is_active')->default(true)->comment('Whether template is active');
            $table->timestamps();
            
            $table->index('name');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_templates');
    }
};
