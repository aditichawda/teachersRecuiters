<?php

namespace Botble\JobBoard\Supports;

use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\CreditConsumption;
use Botble\JobBoard\Models\JobApplication;
use Botble\JobBoard\Models\Package;
use Botble\JobBoard\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

/**
 * Package context for a job seeker: current package, validity, job applications used/limit,
 * and feature flags (Featured Profile, View Contact Info, Job Alerts WhatsApp, Basic CV, Advance CV).
 * Used to gate: Job Apply (by limit), Featured Profile, View School Contact, WhatsApp Alerts, CV templates.
 */
class JobSeekerPackageContext
{
    public ?Transaction $lastPurchase = null;

    public ?Package $package = null;

    public ?Carbon $periodStart = null;

    public ?Carbon $periodEnd = null;

    /** Job applications by this account in current package period */
    public int $jobApplicationsUsed = 0;

    /** Max job applications allowed from package (job_apply_limit); null = unlimited */
    public ?int $jobApplyLimit = null;

    /** Pre-paid job apply slots (purchased via wallet Use credits) */
    public int $jobApplyCreditsBalance = 0;

    /** Account ID (for entitlement checks when no lastPurchase) */
    public ?int $accountId = null;

    /** @var array<int, self> Request-level cache by account id */
    private static array $forAccountCache = [];

    public function __construct(
        ?Transaction $lastPurchase = null,
        ?Package $package = null,
        ?Carbon $periodStart = null,
        ?Carbon $periodEnd = null,
        int $jobApplicationsUsed = 0,
        ?int $jobApplyLimit = null
    ) {
        $this->lastPurchase = $lastPurchase;
        $this->package = $package;
        $this->periodStart = $periodStart;
        $this->periodEnd = $periodEnd;
        $this->jobApplicationsUsed = $jobApplicationsUsed;
        $this->jobApplyLimit = $jobApplyLimit;
    }

    public static function forAccount(Account $account): self
    {
        $id = (int) $account->getKey();
        if (isset(self::$forAccountCache[$id])) {
            return self::$forAccountCache[$id];
        }

        if (! $account->isJobSeeker()) {
            $result = new self();
            $result->accountId = $id;
            self::$forAccountCache[$id] = $result;

            return $result;
        }

        // Any latest row with a job-seeker package_id counts (credit or debit).
        // Wallet / internal flows may log package purchase as TYPE_DEBIT; excluding debits broke entitlement.
        $lastPurchase = Transaction::query()
            ->where('account_id', $account->getKey())
            ->whereNotNull('package_id')
            ->whereHas('package', fn ($q) => $q->where('package_type', 'job-seeker'))
            ->with('package')
            ->latest()
            ->first();

        // Subscription / admin attach: jb_account_packages (may be newer than an old wallet transaction).
        $pivotAttachedPackage = $account->packages()
            ->where('jb_packages.package_type', 'job-seeker')
            ->where('jb_packages.status', 'published')
            ->orderByDesc('jb_account_packages.created_at')
            ->first();

        $pivotCreated = $pivotAttachedPackage?->pivot?->created_at
            ? Carbon::parse($pivotAttachedPackage->pivot->created_at)
            : null;
        $purchaseCreated = $lastPurchase?->created_at
            ? Carbon::parse($lastPurchase->created_at)
            : null;

        // Prefer whichever entitlement was granted most recently so a new pivot plan is not ignored
        // when an older jb_transactions row still exists (wrongly showed "upgrade" / expired period).
        $usePivotAsPrimary = $pivotCreated && (! $purchaseCreated || $pivotCreated->greaterThan($purchaseCreated));

        $package = null;
        $periodStart = null;

        if ($usePivotAsPrimary && $pivotAttachedPackage) {
            $package = $pivotAttachedPackage;
            $periodStart = $pivotCreated;
        } elseif ($lastPurchase) {
            $package = $lastPurchase->package;
            if ($package) {
                $periodStart = $purchaseCreated;
            } elseif ($pivotAttachedPackage) {
                $package = $pivotAttachedPackage;
                $periodStart = $pivotCreated;
            }
        } elseif ($pivotAttachedPackage) {
            $package = $pivotAttachedPackage;
            $periodStart = $pivotCreated;
        }

        if (! $package) {
            $package = Package::query()
                ->where('package_type', 'job-seeker')
                ->where('is_default', 1)
                ->where('status', 'published')
                ->first();
        }

        $hasPivotJobSeekerPackage = $pivotAttachedPackage !== null;

        $isDefaultPackage = ! $lastPurchase && ! $hasPivotJobSeekerPackage && $package && (bool) ($package->is_default ?? false);

        // Default/free: fresh period from now. Otherwise use periodStart from pivot/purchase above, or account age.
        if ($package && $periodStart === null) {
            $periodStart = $isDefaultPackage ? Carbon::now() : $account->created_at;
        }

        $periodEnd = null;

        if ($package && $periodStart) {
            $periodStart = Carbon::parse($periodStart);
            if ($package->validity_days) {
                $periodEnd = $periodStart->copy()->addDays((int) $package->validity_days);
            }
        }

        $jobApplyLimit = $package ? (Schema::hasColumn('jb_packages', 'job_apply_limit') ? $package->job_apply_limit : null) : null;
        if ($jobApplyLimit !== null) {
            $jobApplyLimit = (int) $jobApplyLimit;
        }

        $jobApplicationsUsed = 0;
        if ($periodStart) {
            $q = JobApplication::query()
                ->where('account_id', $account->getKey())
                ->where('created_at', '>=', $periodStart);
            if ($periodEnd) {
                $q->where('created_at', '<', $periodEnd);
            }
            $jobApplicationsUsed = $q->count();
        }

        $result = new self(
            $lastPurchase,
            $package,
            $periodStart,
            $periodEnd,
            $jobApplicationsUsed,
            $jobApplyLimit
        );
        $result->accountId = $id;
        if (Schema::hasColumn('jb_accounts', 'job_apply_credits_balance')) {
            $result->jobApplyCreditsBalance = (int) ($account->getAttribute('job_apply_credits_balance') ?? 0);
        }
        self::$forAccountCache[$id] = $result;

        return $result;
    }

    public static function clearCache(?int $accountId = null): void
    {
        if ($accountId !== null) {
            unset(self::$forAccountCache[$accountId]);
        } else {
            self::$forAccountCache = [];
        }
    }

    /** Whether job seeker has a package (purchased or default). */
    public function hasPackage(): bool
    {
        return $this->package !== null;
    }

    /** Whether package period is still valid (before expiry). Unlimited validity = always valid. */
    public function isPeriodValid(): bool
    {
        if (! $this->periodEnd) {
            return true;
        }

        return Carbon::now()->lt($this->periodEnd);
    }

    /** Whether job seeker can submit one more job application (package slot or wallet-purchased slot). */
    public function canApply(): bool
    {
        if ($this->jobApplyCreditsBalance > 0) {
            return true;
        }
        if (! $this->hasPackage() || ! $this->isPeriodValid()) {
            return false;
        }
        if ($this->jobApplyLimit === null) {
            return true;
        }

        return $this->jobApplicationsUsed < $this->jobApplyLimit;
    }

    /** Remaining job applications in current period (null = unlimited). */
    public function remainingApplications(): ?int
    {
        if ($this->jobApplyLimit === null) {
            return null;
        }

        return max(0, $this->jobApplyLimit - $this->jobApplicationsUsed);
    }

    public function hasFeaturedProfile(): bool
    {
        if ($this->hasPackage() && $this->isPeriodValid() && $this->package && $this->package->feature_featured_profile_js) {
            return true;
        }
        if ($this->accountId === null) {
            return false;
        }
        $account = Account::query()->find($this->accountId);

        return $account && CreditConsumption::hasEntitlement($account, CreditConsumption::FEATURE_FEATURED_CANDIDATE_PROFILE);
    }

    public function hasViewContactInfo(): bool
    {
        return $this->hasPackage() && $this->isPeriodValid() && $this->package && $this->package->feature_view_school_contact_info;
    }

    public function hasJobAlertsWhatsapp(): bool
    {
        if ($this->hasPackage() && $this->isPeriodValid() && $this->package && $this->package->feature_job_alerts_whatsapp) {
            return true;
        }
        if ($this->accountId === null) {
            return false;
        }
        $account = Account::query()->find($this->accountId);

        return $account && CreditConsumption::hasEntitlement($account, CreditConsumption::FEATURE_JOB_ALERT_WP_JOBSEEKER);
    }

    public function hasBasicCv(): bool
    {
        if ($this->hasPackage() && $this->isPeriodValid() && $this->package && $this->package->feature_basic_cv) {
            return true;
        }
        if ($this->accountId === null) {
            return false;
        }
        $account = Account::query()->find($this->accountId);

        return $account && CreditConsumption::hasEntitlement($account, CreditConsumption::FEATURE_BASIC_CV);
    }

    public function hasAdvanceCv(): bool
    {
        if ($this->hasPackage() && $this->isPeriodValid() && $this->package && $this->package->feature_advance_cv) {
            return true;
        }
        if ($this->accountId === null) {
            return false;
        }
        $account = Account::query()->find($this->accountId);

        return $account && CreditConsumption::hasEntitlement($account, CreditConsumption::FEATURE_ADVANCED_CV);
    }

    public function hasResumeBuilder(): bool
    {
        return $this->hasPackage() && $this->isPeriodValid() && $this->package && $this->package->feature_resume_builder;
    }

    /** Upgrade/packages page URL for job seeker (buy option). */
    public function packagesUrl(): string
    {
        return route('public.account.jobseeker.packages');
    }
}
