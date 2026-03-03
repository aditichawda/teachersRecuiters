<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_transactions', function (Blueprint $table): void {
            $table->string('account_type', 50)->nullable()->after('account_id')->comment('employer or job_seeker');
            $table->json('user_details')->nullable()->after('account_type')->comment('name, email, phone, address etc');
            $table->string('institution_name', 255)->nullable()->after('user_details')->comment('employer company/institution name');
            $table->foreignId('package_id')->nullable()->after('payment_id')->constrained('jb_packages')->nullOnDelete();
            $table->string('package_name', 255)->nullable()->after('package_id');
        });
    }

    public function down(): void
    {
        Schema::table('jb_transactions', function (Blueprint $table): void {
            $table->dropForeign(['package_id']);
            $table->dropColumn([
                'account_type',
                'user_details',
                'institution_name',
                'package_id',
                'package_name',
            ]);
        });
    }
};
