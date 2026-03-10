<?php

use Botble\JobBoard\Models\CreditConsumption;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('jb_credit_consumption')) {
            return;
        }

        CreditConsumption::query()
            ->where('account_type', 'employer')
            ->where('feature_key', CreditConsumption::FEATURE_DEDICATED_RECRUITER)
            ->update(['credits' => 2500]);
    }

    public function down(): void
    {
        // No reliable way to know previous value; keep as-is on rollback
    }
};

