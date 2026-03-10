<?php

use Botble\JobBoard\Models\Currency;
use Botble\JobBoard\Models\Package;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('jb_packages') || ! Schema::hasTable('jb_currencies')) {
            return;
        }

        $currency = Currency::query()->where('is_default', 1)->first()
            ?? Currency::query()->orderBy('order')->first();

        $currencyId = $currency ? $currency->id : 1;

<<<<<<< HEAD
        $freePlan = Package::query()->firstOrCreate(
=======
        Package::query()->firstOrCreate(
>>>>>>> 37fac6c5 (10 march)
            [
                'name' => 'Basic Profile Plan',
                'package_type' => 'job-seeker',
            ],
            [
                'price' => 0,
                'currency_id' => $currencyId,
                'percent_save' => 0,
<<<<<<< HEAD
                'number_of_listings' => 0,
=======
                'number_of_listings' => 25,
>>>>>>> 37fac6c5 (10 march)
                'order' => 0,
                'account_limit' => null,
                'is_default' => 1,
                'status' => 'published',
                'validity_days' => null,
                'credits_included' => 0,
                'profile_views_allowed' => null,
                'worth' => null,
<<<<<<< HEAD
                'description' => 'Free plan: 25 job applications, Basic CV, unlimited validity. No featured profile, view contact info, WhatsApp alerts, or advanced CV.',
                'features' => json_encode([
                    '25 Job Applications',
                    'Basic CV',
=======
                'description' => 'Free plan: 25 job applications, Basic CV, unlimited validity. No featured profile, school contact info, or WhatsApp alerts.',
                'features' => json_encode([
                    '25 Job Applications',
                    'Basic CV / Resume Builder',
>>>>>>> 37fac6c5 (10 march)
                    'Unlimited Validity',
                    'Featured Profile: No',
                    'View School Contact Info: No',
                    'Job Alerts on WhatsApp: No',
<<<<<<< HEAD
                    'Advance CV: No',
                ]),
            ]
        );

        if (Schema::hasColumn('jb_packages', 'job_apply_limit')) {
            $freePlan->update(['job_apply_limit' => 25]);
        }
=======
                ]),
            ]
        );
>>>>>>> 37fac6c5 (10 march)
    }

    public function down(): void
    {
        if (! Schema::hasTable('jb_packages')) {
            return;
        }

        Package::query()
            ->where('name', 'Basic Profile Plan')
            ->where('package_type', 'job-seeker')
            ->delete();
    }
};
