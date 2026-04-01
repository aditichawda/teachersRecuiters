<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('jb_credit_consumption', function (Blueprint $table): void {
            $table->id();
            // account_type: 'employer' | 'job-seeker' (who sees this feature)
            $table->string('account_type', 30);
            $table->string('feature_key', 100)->comment('e.g. featured_job, application_alert_wp');
            $table->string('feature_label', 255);
            $table->unsignedInteger('credits')->default(0);
            $table->unsignedTinyInteger('order')->default(0);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jb_credit_consumption');
    }
};
