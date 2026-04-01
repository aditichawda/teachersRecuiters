<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('jb_wallet_recharges')) {
            return;
        }

        Schema::create('jb_wallet_recharges', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('account_id')->index();
            $table->string('token', 64)->unique();
            $table->unsignedInteger('amount_inr'); // INR amount
            $table->unsignedInteger('credits'); // credits to add
            $table->string('currency', 10)->default('INR');
            $table->string('gateway', 50)->default('razorpay');
            $table->string('razorpay_order_id', 100)->nullable()->index();
            $table->string('razorpay_payment_id', 100)->nullable()->index();
            $table->string('razorpay_signature', 255)->nullable();
            $table->string('status', 30)->default('pending')->index(); // pending|completed|failed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jb_wallet_recharges');
    }
};

