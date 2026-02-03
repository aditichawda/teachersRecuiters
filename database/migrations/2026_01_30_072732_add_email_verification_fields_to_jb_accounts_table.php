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
        Schema::table('jb_accounts', function (Blueprint $table) {
            // Email verification fields
            $table->timestamp('email_verified_at')->nullable()->after('email');
            $table->string('email_verification_token', 64)->nullable()->after('email_verified_at');
            $table->timestamp('email_verification_token_expires_at')->nullable()->after('email_verification_token');
            $table->string('verification_code', 10)->nullable()->after('email_verification_token_expires_at');
            $table->timestamp('verification_code_expires_at')->nullable()->after('verification_code');
            $table->boolean('is_email_verified')->default(false)->after('verification_code_expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table) {
            $table->dropColumn([
                'email_verified_at',
                'email_verification_token',
                'email_verification_token_expires_at',
                'verification_code',
                'verification_code_expires_at',
                'is_email_verified',
            ]);
        });
    }
};
