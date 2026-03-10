<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class CreditConsumption extends BaseModel
{
    /** Employer feature keys (must match rows in jb_credit_consumption) */
    public const FEATURE_JOB_POSTING = 'job_posting';
    public const FEATURE_FEATURED_JOB = 'featured_job';
    public const FEATURE_APPLICATION_ALERT_WP = 'application_alert_wp';
    public const FEATURE_APPLICATION_ALERT_EMAIL = 'application_alert_email';
    public const FEATURE_CANDIDATE_PROFILE_VIEW = 'candidate_profile_view';
    public const FEATURE_INVITE_CANDIDATE = 'invite_candidate';
    public const FEATURE_FEATURED_PROFILE_EMPLOYER = 'featured_profile_employer';
    public const FEATURE_MULTIPLE_LOGIN = 'multiple_login';
    public const FEATURE_ADMISSION_ENQUIRY = 'admission_enquiry';
    public const FEATURE_ADDITIONAL_EMPLOYER_PROFILE = 'additional_employer_profile';
    public const FEATURE_JOB_POSTING_ASSISTANCE = 'job_posting_assistance';
    public const FEATURE_WALKIN_DRIVE_AD = 'walkin_drive_ad';
    public const FEATURE_DEDICATED_RECRUITER = 'dedicated_recruiter';
    public const FEATURE_SOCIAL_PROMOTION = 'social_promotion';

    /** Job-seeker feature keys (for jb_credit_consumption, account_type = job-seeker) */
    public const FEATURE_JOB_APPLY = 'job_apply';
    public const FEATURE_FEATURED_CANDIDATE_PROFILE = 'featured_candidate_profile';
    public const FEATURE_ADVANCED_CV = 'advanced_cv';
    public const FEATURE_JOB_ALERT_WP_JOBSEEKER = 'job_alert_wp_jobseeker';

    protected $table = 'jb_credit_consumption';

    protected $fillable = [
        'account_type',
        'feature_key',
        'feature_label',
        'credits',
        'order',
        'status',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'credits' => 'integer',
    ];

    public static function getForAccountType(string $accountType): array
    {
        return static::query()
            ->where('account_type', $accountType)
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->orderBy('order')
            ->orderBy('id')
            ->get()
            ->mapWithKeys(fn ($row) => [$row->feature_key => [
                'label' => $row->feature_label,
                'credits' => (int) $row->credits,
            ]])
            ->all();
    }

    /**
     * Get credits required for a feature (from jb_credit_consumption). Fallback to $default if not found.
     */
    public static function getCreditsForFeature(string $accountType, string $featureKey, int $default = 0): int
    {
        $list = static::getForAccountType($accountType);
        $item = $list[$featureKey] ?? null;

        return $item ? (int) ($item['credits'] ?? $default) : $default;
    }

    /**
     * Deduct credits from account for a feature and create debit transaction.
     * Returns true if deducted, false if insufficient credits.
     */
    public static function deductForFeature(
        Account $account,
        string $featureKey,
        int $credits,
        string $description,
        array $meta = []
    ): bool
    {
        if ($credits <= 0 || $account->credits < $credits) {
            return false;
        }
        $account->credits -= $credits;
        $account->save();

        $data = [
            'account_id' => $account->getKey(),
            'credits' => $credits,
            'type' => Transaction::TYPE_DEBIT,
            'description' => $description,
        ];
        if (Schema::hasColumn('jb_transactions', 'feature_key')) {
            $data['feature_key'] = $featureKey;
        }
        if (Schema::hasColumn('jb_transactions', 'meta')) {
            $data['meta'] = array_filter($meta, fn ($v) => $v !== null) ?: null;
        }
        Transaction::query()->create($data);

        return true;
    }

    /**
     * Check if account has valid entitlement for a feature (debit exists + package valid or used within 365 days).
     * Used for one-time features like APPLICATION_ALERT_EMAIL, ADMISSION_ENQUIRY, etc.
     */
    public static function hasEntitlement(Account $account, string $featureKey): bool
    {
        try {
            if (! Schema::hasColumn('jb_transactions', 'feature_key')) {
                return false;
            }

            $debit = Transaction::query()
                ->where('account_id', $account->getKey())
                ->where('type', Transaction::TYPE_DEBIT)
                ->where('feature_key', $featureKey)
                ->latest()
                ->first();

            if (! $debit || ! $debit->created_at) {
                return false;
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

            if ($lastPurchase && $lastPurchase->package && $lastPurchase->package->validity_days && $lastPurchase->created_at) {
                $packageExpiryAt = Carbon::parse($lastPurchase->created_at)->addDays($lastPurchase->package->validity_days);
                if (Carbon::now()->lte($packageExpiryAt)) {
                    return true;
                }
            }

            $debitDate = $debit->created_at instanceof \DateTimeInterface
                ? Carbon::parse($debit->created_at)
                : Carbon::parse((string) $debit->created_at);

            return $debitDate->gte(Carbon::now()->subDays(365));
        } catch (\Throwable $e) {
            return false;
        }
    }
}
