<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('jb_account_candidate_views', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('candidate_id');
            $table->timestamps();

            $table->unique(['account_id', 'candidate_id']);
            $table->foreign('account_id')->references('id')->on('jb_accounts')->cascadeOnDelete();
            $table->foreign('candidate_id')->references('id')->on('jb_accounts')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jb_account_candidate_views');
    }
};
