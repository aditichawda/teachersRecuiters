<<<<<<< HEAD
=======
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

        $freePlan = Package::query()->firstOrCreate(
            [
                'name' => 'Basic Profile Plan',
                'package_type' => 'job-seeker',
            ],
            [
                'price' => 0,
                'currency_id' => $currencyId,
                'percent_save' => 0,
                'number_of_listings' => 0,
                'order' => 0,
                'account_limit' => null,
                'is_default' => 1,
                'status' => 'published',
                'validity_days' => null,
                'credits_included' => 0,
                'profile_views_allowed' => null,
                'worth' => null,
                'description' => 'Free plan: 25 job applications, Basic CV, unlimited validity. No featured profile, view contact info, WhatsApp alerts, or advanced CV.',
                'features' => json_encode([
                    '25 Job Applications',
                    'Basic CV',
                    'Unlimited Validity',
                    'Featured Profile: No',
                    'View School Contact Info: No',
                    'Job Alerts on WhatsApp: No',
                    'Advance CV: No',
                ]),
            ]
        );

        if (Schema::hasColumn('jb_packages', 'job_apply_limit')) {
            $freePlan->update(['job_apply_limit' => 25]);
        }
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
>>>>>>> f0f58692 (16 march)
