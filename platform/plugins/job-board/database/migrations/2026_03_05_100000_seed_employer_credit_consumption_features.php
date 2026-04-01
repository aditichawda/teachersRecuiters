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

        $employerFeatures = [
            ['feature_key' => CreditConsumption::FEATURE_JOB_POSTING, 'feature_label' => 'Job Posting', 'credits' => 600, 'order' => 1],
            ['feature_key' => CreditConsumption::FEATURE_FEATURED_JOB, 'feature_label' => 'Featured Job (highlighted, top, WhatsApp alerts)', 'credits' => 250, 'order' => 2],
            ['feature_key' => CreditConsumption::FEATURE_APPLICATION_ALERT_WP, 'feature_label' => 'New Application Alert by WhatsApp (per alert)', 'credits' => 10, 'order' => 3],
            ['feature_key' => CreditConsumption::FEATURE_APPLICATION_ALERT_EMAIL, 'feature_label' => 'New Application Alert to Additional Email (one time)', 'credits' => 100, 'order' => 4],
            ['feature_key' => CreditConsumption::FEATURE_CANDIDATE_PROFILE_VIEW, 'feature_label' => 'Candidate Database Access (each profile view)', 'credits' => 25, 'order' => 5],
            ['feature_key' => CreditConsumption::FEATURE_INVITE_CANDIDATE, 'feature_label' => 'Invite Candidate to Apply for Job (each invite)', 'credits' => 25, 'order' => 6],
            ['feature_key' => CreditConsumption::FEATURE_FEATURED_PROFILE_EMPLOYER, 'feature_label' => 'Featured Profile for Employer (time as per plan)', 'credits' => 500, 'order' => 7],
            ['feature_key' => CreditConsumption::FEATURE_MULTIPLE_LOGIN, 'feature_label' => 'Multiple Login / Account Manage (per login)', 'credits' => 250, 'order' => 8],
            ['feature_key' => CreditConsumption::FEATURE_ADMISSION_ENQUIRY, 'feature_label' => 'Admission Enquiry Form (time as per plan)', 'credits' => 500, 'order' => 9],
            ['feature_key' => CreditConsumption::FEATURE_ADDITIONAL_EMPLOYER_PROFILE, 'feature_label' => 'Additional Employer Profile (per new profile)', 'credits' => 500, 'order' => 10],
            ['feature_key' => CreditConsumption::FEATURE_JOB_POSTING_ASSISTANCE, 'feature_label' => 'Job Posting Assistance', 'credits' => 250, 'order' => 11],
            ['feature_key' => CreditConsumption::FEATURE_WALKIN_DRIVE_AD, 'feature_label' => 'Walk-in Drive Ad Space (Home & Job Listing Page)', 'credits' => 2500, 'order' => 12],
            ['feature_key' => CreditConsumption::FEATURE_DEDICATED_RECRUITER, 'feature_label' => 'Dedicated Recruiter / Personal Account Manager (per month)', 'credits' => 5000, 'order' => 13],
            ['feature_key' => CreditConsumption::FEATURE_SOCIAL_PROMOTION, 'feature_label' => 'Post/Promote on LinkedIn/Other Social Pages', 'credits' => 3000, 'order' => 14],
        ];

        foreach ($employerFeatures as $row) {
            CreditConsumption::query()->firstOrCreate(
                [
                    'account_type' => 'employer',
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
            CreditConsumption::FEATURE_JOB_POSTING,
            CreditConsumption::FEATURE_FEATURED_JOB,
            CreditConsumption::FEATURE_APPLICATION_ALERT_WP,
            CreditConsumption::FEATURE_APPLICATION_ALERT_EMAIL,
            CreditConsumption::FEATURE_CANDIDATE_PROFILE_VIEW,
            CreditConsumption::FEATURE_INVITE_CANDIDATE,
            CreditConsumption::FEATURE_FEATURED_PROFILE_EMPLOYER,
            CreditConsumption::FEATURE_MULTIPLE_LOGIN,
            CreditConsumption::FEATURE_ADMISSION_ENQUIRY,
            CreditConsumption::FEATURE_ADDITIONAL_EMPLOYER_PROFILE,
            CreditConsumption::FEATURE_JOB_POSTING_ASSISTANCE,
            CreditConsumption::FEATURE_WALKIN_DRIVE_AD,
            CreditConsumption::FEATURE_DEDICATED_RECRUITER,
            CreditConsumption::FEATURE_SOCIAL_PROMOTION,
        ];
        CreditConsumption::query()->where('account_type', 'employer')->whereIn('feature_key', $keys)->delete();
    }
};
