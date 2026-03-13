<?php

namespace Botble\JobBoard\Commands;

use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Supports\PackageContext;
use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('cms:job-board:sync-package-featured', 'Set is_featured=1 for companies whose employer has a valid package with Featured Profile')]
class SyncPackageFeaturedCommand extends Command
{
    public function handle(): int
    {
        $this->components->info('Syncing featured profile from packages...');

        if (! JobBoardHelper::isEnabledCreditsSystem()) {
            $this->components->warn('Credits system is disabled. Skipping.');

            return self::SUCCESS;
        }

        $count = 0;
        $employers = Account::query()
            ->where('type', AccountTypeEnum::EMPLOYER)
            ->get();

        foreach ($employers as $account) {
            if (! $account->isEmployer()) {
                continue;
            }
            $ctx = PackageContext::forAccount($account);
            if ($ctx->hasFeature('Featured Profile')) {
                $updated = $account->companies()->where('is_featured', '!=', 1)->update(['is_featured' => 1]);
                if ($updated > 0) {
                    $count += $updated;
                }
            }
        }

        $this->components->info(sprintf('Synced featured for %d company/companies.', $count));

        return self::SUCCESS;
    }
}
