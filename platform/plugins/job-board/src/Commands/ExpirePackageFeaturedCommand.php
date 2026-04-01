<?php

namespace Botble\JobBoard\Commands;

use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\Company;
use Botble\JobBoard\Supports\PackageContext;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('cms:job-board:expire-package-featured', 'Remove featured from companies whose employer package (Featured Profile) has expired')]
class ExpirePackageFeaturedCommand extends Command
{
    public function handle(): int
    {
        $this->components->info('Expiring featured profile for employers whose package period ended...');

        if (! JobBoardHelper::isEnabledCreditsSystem()) {
            $this->components->warn('Credits system is disabled. Skipping.');

            return self::SUCCESS;
        }

        $count = 0;
        $featuredCompanyIds = Company::query()->where('is_featured', true)->pluck('id');
        if ($featuredCompanyIds->isEmpty()) {
            $this->components->info('No featured companies to check.');

            return self::SUCCESS;
        }

        $employerIdsWithFeaturedCompany = DB::table('jb_companies_accounts')
            ->whereIn('company_id', $featuredCompanyIds)
            ->distinct()
            ->pluck('account_id')
            ->toArray();

        if (empty($employerIdsWithFeaturedCompany)) {
            $this->components->info('No featured companies to check.');

            return self::SUCCESS;
        }

        $accounts = Account::query()
            ->whereIn('id', $employerIdsWithFeaturedCompany)
            ->get();

        foreach ($accounts as $account) {
            if (! $account->isEmployer()) {
                continue;
            }
            $ctx = PackageContext::forAccount($account);
            if ($ctx->hasPackage() && $ctx->package->hasFeatureText('Featured Profile') && ! $ctx->isPeriodValid()) {
                $account->companies()->update(['is_featured' => 0]);
                $count++;
            }
        }

        $this->components->info(sprintf('Expired featured for %d employer(s).', $count));

        return self::SUCCESS;
    }
}
