<?php

namespace Botble\JobBoard\Supports;

use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\CreditConsumption;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\Package;
use Botble\JobBoard\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Package context for an employer: last purchase, validity, job posts & profile views used/allowed.
 * - Package gives: validity_days, number_of_listings (job posts), profile_views_allowed, credits_included.
 * - Job posts: first N from package (no credit), extra = credit consumption.
 * - Profile views: first M from package (1 count per unique candidate); same employer same candidate = no extra count; extra = credit consumption.
 */
class PackageContext
{
    public ?Transaction $lastPurchase = null;

    public ?Package $package = null;

    public ?Carbon $periodStart = null;

    public ?Carbon $periodEnd = null;

    /** Job posts created by account in current package period */
    public int $jobPostsUsed = 0;

    /** Max job posts from package in this period (number_of_listings) */
    public int $jobPostsAllowed = 0;

    /** Unique candidate profile views (count of jb_account_candidate_views for this account) */
    public int $profileViewsUsed = 0;

    /** Max profile views from package (profile_views_allowed) */
    public int $profileViewsAllowed = 0;

    public function __construct(
        ?Transaction $lastPurchase = null,
        ?Package $package = null,
        ?Carbon $periodStart = null,
        ?Carbon $periodEnd = null,
        int $jobPostsUsed = 0,
        int $jobPostsAllowed = 0,
        int $profileViewsUsed = 0,
        int $profileViewsAllowed = 0
    ) {
        $this->lastPurchase = $lastPurchase;
        $this->package = $package;
        $this->periodStart = $periodStart;
        $this->periodEnd = $periodEnd;
        $this->jobPostsUsed = $jobPostsUsed;
        $this->jobPostsAllowed = $jobPostsAllowed;
        $this->profileViewsUsed = $profileViewsUsed;
        $this->profileViewsAllowed = $profileViewsAllowed;
    }

    public static function forAccount(Account $account): self
    {
        if (! $account->isEmployer() || ! app(JobBoardHelper::class)->isEnabledCreditsSystem()) {
            return new self();
        }

        $lastPurchase = Transaction::query()
            ->where('account_id', $account->getKey())
            ->where(function ($q): void {
                $q->whereNull('type')->orWhere('type', '!=', 'deduct');
            })
            ->whereNotNull('payment_id')
            ->whereNotNull('package_id')
            ->with('package')
            ->latest()
            ->first();

        $package = $lastPurchase?->package;
        $periodStart = $lastPurchase ? $lastPurchase->created_at : null;
        $periodEnd = null;
        $jobPostsAllowed = 0;
        $profileViewsAllowed = 0;

        if ($package && $periodStart) {
            if ($package->validity_days) {
                $periodEnd = Carbon::parse($periodStart)->addDays($package->validity_days);
            }
            $jobPostsAllowed = (int) ($package->number_of_listings ?? 0);
            $profileViewsAllowed = (int) ($package->profile_views_allowed ?? 0);
        }

        $jobPostsUsed = 0;
        if ($periodStart) {
            $jobPostsUsed = Job::query()
                ->where('author_id', $account->getKey())
                ->where('author_type', Account::class)
                ->where('created_at', '>=', $periodStart)
                ->count();
        }

        $profileViewsUsed = 0;
        if (Schema::hasTable('jb_account_candidate_views')) {
            $profileViewsUsed = (int) DB::table('jb_account_candidate_views')
                ->where('account_id', $account->getKey())
                ->count();
        }

        return new self(
            $lastPurchase,
            $package,
            $periodStart ? Carbon::parse($periodStart) : null,
            $periodEnd,
            $jobPostsUsed,
            $jobPostsAllowed,
            $profileViewsUsed,
            $profileViewsAllowed
        );
    }

    /** Whether employer has a package (ever purchased). */
    public function hasPackage(): bool
    {
        return $this->package !== null && $this->lastPurchase !== null;
    }

    /** Whether package period is still valid (before expiry). */
    public function isPeriodValid(): bool
    {
        if (! $this->periodEnd) {
            return true;
        }

        return Carbon::now()->lt($this->periodEnd);
    }

    /** Whether we can post a job: package slot OR pre-paid job post balance (bought via wallet popup). No auto-deduct. */
    public function canPostJob(Account $account): bool
    {
        if ($this->hasPackage() && $this->isPeriodValid() && $this->jobPostsUsed < $this->jobPostsAllowed) {
            return true;
        }
        $balance = 0;
        if (Schema::hasTable('jb_accounts') && Schema::hasColumn('jb_accounts', 'job_post_credits_balance')) {
            $balance = (int) ($account->getAttribute('job_post_credits_balance') ?? 0);
        }

        return $balance >= 1;
    }

    /** Whether this job post will use package slot (true) or pre-paid balance (false). */
    public function jobPostUsesPackageSlot(): bool
    {
        return $this->hasPackage() && $this->isPeriodValid() && $this->jobPostsUsed < $this->jobPostsAllowed;
    }

    /** Whether we can view one more candidate profile: package slot, then pre-paid profile view balance, then credits. */
    public function canViewProfile(Account $account, bool $alreadyViewedThisCandidate): bool
    {
        if ($alreadyViewedThisCandidate) {
            return true;
        }
        $profileViewCredits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_CANDIDATE_PROFILE_VIEW, 25);
        if (! $this->hasPackage() || ! $this->isPeriodValid()) {
            if (Schema::hasColumn('jb_accounts', 'profile_view_credits_balance')) {
                $balance = (int) ($account->getAttribute('profile_view_credits_balance') ?? 0);
                if ($balance >= 1) {
                    return true;
                }
            }
            return $account->credits >= $profileViewCredits;
        }
        if ($this->profileViewsAllowed <= 0) {
            return true;
        }
        if ($this->profileViewsUsed < $this->profileViewsAllowed) {
            return true;
        }

        // Package profile views exhausted: allow if pre-paid balance or credits
        if (Schema::hasColumn('jb_accounts', 'profile_view_credits_balance')) {
            $balance = (int) ($account->getAttribute('profile_view_credits_balance') ?? 0);
            if ($balance >= 1) {
                return true;
            }
        }
        return $account->credits >= $profileViewCredits;
    }

    /** Whether this profile view will use package slot (true) or credit (false). */
    public function profileViewUsesPackageSlot(bool $alreadyViewedThisCandidate): bool
    {
        if ($alreadyViewedThisCandidate) {
            return true;
        }
        if (! $this->hasPackage() || ! $this->isPeriodValid()) {
            return false;
        }
        if ($this->profileViewsAllowed <= 0) {
            return true;
        }

        return $this->profileViewsUsed < $this->profileViewsAllowed;
    }
}
