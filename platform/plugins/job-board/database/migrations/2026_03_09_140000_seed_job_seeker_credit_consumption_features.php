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

        $jobSeekerFeatures = [
            ['feature_key' => CreditConsumption::FEATURE_JOB_APPLY, 'feature_label' => 'Job Apply (per application)', 'credits' => 50, 'order' => 1],
            ['feature_key' => CreditConsumption::FEATURE_FEATURED_CANDIDATE_PROFILE, 'feature_label' => 'Featured Candidate Profile (time limit as per plan)', 'credits' => 250, 'order' => 2],
            ['feature_key' => CreditConsumption::FEATURE_ADVANCED_CV, 'feature_label' => 'Advanced CV / Resume Builder', 'credits' => 250, 'order' => 3],
            ['feature_key' => CreditConsumption::FEATURE_JOB_ALERT_WP_JOBSEEKER, 'feature_label' => 'Job Alert on WhatsApp (per alert)', 'credits' => 10, 'order' => 4],
        ];

        foreach ($jobSeekerFeatures as $row) {
            CreditConsumption::query()->firstOrCreate(
                [
                    'account_type' => 'job-seeker',
                    'feature_key' => $row['feature_key'],
                ],
                [
                    'feature_label' => $row['feature_label'],
                    'credits' => $row['credits'],
                    'order' => $row['order'],
                    'status' => 'published',
                ]
            );
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('jb_credit_consumption')) {
            return;
        }

        $keys = [
            CreditConsumption::FEATURE_JOB_APPLY,
            CreditConsumption::FEATURE_FEATURED_CANDIDATE_PROFILE,
            CreditConsumption::FEATURE_ADVANCED_CV,
            CreditConsumption::FEATURE_JOB_ALERT_WP_JOBSEEKER,
        ];

        CreditConsumption::query()
            ->where('account_type', 'job-seeker')
            ->whereIn('feature_key', $keys)
            ->delete();
    }
};

