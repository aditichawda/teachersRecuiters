<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('jb_company_admissions')) {
            Schema::create('jb_company_admissions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('company_id')->constrained('jb_companies')->cascadeOnDelete();
                $table->longText('content')->nullable()->comment('Admission details/content from school');
                $table->date('admission_deadline')->nullable();
                $table->string('status', 60)->default('published');
                $table->timestamps();
                $table->unique('company_id');
            });
        }

        if (! Schema::hasTable('jb_admission_enquiries')) {
            Schema::create('jb_admission_enquiries', function (Blueprint $table) {
                $table->id();
                $table->foreignId('company_id')->constrained('jb_companies')->cascadeOnDelete();
                $table->string('student_name');
                $table->string('contact_number', 50);
                $table->string('email');
                $table->string('admission_for_standard', 100)->nullable()->comment('Admission for which standard');
                $table->text('address')->nullable();
                $table->text('message')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('jb_admission_enquiries');
        Schema::dropIfExists('jb_company_admissions');
    }
};
