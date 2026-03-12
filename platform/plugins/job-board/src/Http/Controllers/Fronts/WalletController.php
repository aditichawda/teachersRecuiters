<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\Company;
use Botble\JobBoard\Models\CreditConsumption;
use Botble\JobBoard\Models\Invoice;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\Package;
use Botble\JobBoard\Models\Transaction;
use Botble\JobBoard\Supports\PackageContext;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class WalletController extends BaseController
{
    public function index()
    {
        abort_unless(JobBoardHelper::isEnabledCreditsSystem(), 404);

        $account = auth('account')->user();
        $this->pageTitle(trans('plugins/job-board::dashboard.menu.wallet'));
        Theme::breadcrumb()->add(trans('plugins/job-board::dashboard.menu.wallet'));
        SeoHelper::setTitle(trans('plugins/job-board::dashboard.menu.wallet'));

        // Get all transaction IDs first (unique by ID only)
        $allTransactionIds = Transaction::query()
            ->where('account_id', $account->getKey())
            ->select('id')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->pluck('id')
            ->unique()
            ->values()
            ->toArray();
        
        // Manual pagination for unique IDs
        $perPage = 15;
        $currentPage = request()->get('page', 1);
        $total = count($allTransactionIds);
        $offset = ($currentPage - 1) * $perPage;
        $paginatedIds = array_slice($allTransactionIds, $offset, $perPage);
        
        // Load full transactions for paginated IDs with relationships
        $transactionItems = Transaction::query()
            ->whereIn('id', $paginatedIds)
            ->with(['payment', 'user'])
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->get()
            ->sortByDesc('created_at')
            ->sortByDesc('id')
            ->values();
        
        // Create paginator
        $transactions = new \Illuminate\Pagination\LengthAwarePaginator(
            $transactionItems,
            $total,
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $paymentIds = $transactions->pluck('payment_id')->filter()->unique()->values()->all();
        $invoiceByPaymentId = Invoice::query()
            ->whereIn('payment_id', $paymentIds)
            ->get()
            ->keyBy('payment_id');

        $invoices = Invoice::query()
            ->whereHas('payment', function (Builder $q) use ($account): void {
                $q->where('customer_id', $account->getKey());
            })
            ->with('payment')
            ->latest()
            ->paginate(10, ['*'], 'invoice_page');

        $bonusCredits = (int) Transaction::query()
            ->where('account_id', $account->getKey())
            ->where(function ($q): void {
                $q->whereNull('type')->orWhere('type', '!=', 'deduct');
            })
            ->whereNotNull('user_id')
            ->sum('credits');

        $purchasedCredits = (int) Transaction::query()
            ->where('account_id', $account->getKey())
            ->where(function ($q): void {
                $q->whereNull('type')->orWhere('type', '!=', 'deduct');
            })
            ->whereNotNull('payment_id')
            ->sum('credits');

        $account->load(['packages']);
        $packageType = $account->isEmployer() ? 'employer' : 'job-seeker';
        $packages = Package::query()
            ->wherePublished()
            ->where('package_type', $packageType)
            ->latest('order')
            ->withCount([
                'accounts' => function ($query) use ($account): void {
                    $query->where('account_id', $account->getKey());
                },
            ])
            ->take(4)
            ->get();

        $currentPackageIds = $account->packages->pluck('id')->toArray();
        $billingName = $account->full_name ?: $account->first_name ?: $account->name;
        $siteName = Theme::getSiteTitle();
        $creditConsumption = CreditConsumption::getForAccountType($packageType);

        $packageExpiryAt = null;
        $packageExpiryName = null;
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
        if ($lastPurchase && $lastPurchase->package && $lastPurchase->package->validity_days) {
            $packageExpiryAt = Carbon::parse($lastPurchase->created_at)->addDays($lastPurchase->package->validity_days);
            $packageExpiryName = $lastPurchase->package->name;
        }

        $packageContext = $account->isEmployer() ? PackageContext::forAccount($account) : null;
        $jobPostsUsed = $packageContext?->jobPostsUsed ?? 0;
        $jobPostsAllowed = $packageContext?->jobPostsAllowed ?? 0;
        $profileViewsUsed = $packageContext?->profileViewsUsed ?? 0;
        $profileViewsAllowed = $packageContext?->profileViewsAllowed ?? 0;
        $jobPostCreditsRequired = $account->isEmployer() ? CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_JOB_POSTING, 600) : 0;
        $jobPostCreditsBalance = 0;
        if (\Illuminate\Support\Facades\Schema::hasColumn('jb_accounts', 'job_post_credits_balance')) {
            $jobPostCreditsBalance = (int) ($account->getAttribute('job_post_credits_balance') ?? 0);
        }
        $profileViewCreditsRequired = $account->isEmployer() ? CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_CANDIDATE_PROFILE_VIEW, 25) : 0;
        $profileViewCreditsBalance = 0;
        if (\Illuminate\Support\Facades\Schema::hasColumn('jb_accounts', 'profile_view_credits_balance')) {
            $profileViewCreditsBalance = (int) ($account->getAttribute('profile_view_credits_balance') ?? 0);
        }

        $activePackageFeatureKeys = [];
        $featuresValidWithPackage = [
            CreditConsumption::FEATURE_FEATURED_JOB,
            CreditConsumption::FEATURE_FEATURED_PROFILE_EMPLOYER,
            CreditConsumption::FEATURE_ADMISSION_ENQUIRY,
            CreditConsumption::FEATURE_JOB_POSTING_ASSISTANCE,
        ];
        if ($account->isEmployer() && $packageExpiryAt && Carbon::now()->lte($packageExpiryAt) && \Illuminate\Support\Facades\Schema::hasColumn('jb_transactions', 'feature_key')) {
            foreach ($featuresValidWithPackage as $fk) {
                $hasDebit = Transaction::query()
                    ->where('account_id', $account->getKey())
                    ->where('type', Transaction::TYPE_DEBIT)
                    ->where('feature_key', $fk)
                    ->exists();
                if ($hasDebit) {
                    $activePackageFeatureKeys[] = $fk;
                }
            }
        }

        $viewData = compact(
            'account',
            'transactions',
            'invoices',
            'invoiceByPaymentId',
            'packages',
            'currentPackageIds',
            'bonusCredits',
            'purchasedCredits',
            'billingName',
            'siteName',
            'creditConsumption',
            'packageExpiryAt',
            'packageExpiryName',
            'jobPostsUsed',
            'jobPostsAllowed',
            'profileViewsUsed',
            'profileViewsAllowed',
            'jobPostCreditsRequired',
            'jobPostCreditsBalance',
            'profileViewCreditsRequired',
            'profileViewCreditsBalance',
            'activePackageFeatureKeys'
        );

        if ($account->isEmployer()) {
            return JobBoardHelper::view('dashboard.wallet', $viewData);
        }

        $viewData['is_wallet_page'] = true;
        return JobBoardHelper::scope('dashboard.wallet-jobseeker', $viewData);
    }

    /**
     * Purchase 1 job post slot with credits (popup OK). Deducts credits and adds +1 to job_post_credits_balance.
     */
    public function purchaseJobPostSlot(Request $request): JsonResponse
    {
        abort_unless(JobBoardHelper::isEnabledCreditsSystem(), 404);

        $account = auth('account')->user();
        if (! $account->isEmployer()) {
            return response()->json(['success' => false, 'message' => __('Unauthorized.')], 403);
        }

        $creditsRequired = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_JOB_POSTING, 600);
        if ($account->credits < $creditsRequired) {
            return response()->json([
                'success' => false,
                'message' => trans('plugins/job-board::messages.insufficient_credits'),
            ], 422);
        }

        $featureLabel = null;
        try {
            $consumption = CreditConsumption::getForAccountType('employer');
            $featureLabel = $consumption[CreditConsumption::FEATURE_JOB_POSTING]['label'] ?? null;
        } catch (\Throwable $e) {
            $featureLabel = null;
        }

        $ok = CreditConsumption::deductForFeature(
            $account,
            CreditConsumption::FEATURE_JOB_POSTING,
            $creditsRequired,
            trans('plugins/job-board::messages.credits_used_job_post_slot', ['credits' => $creditsRequired]),
            [
                'source' => 'wallet',
                'feature_label' => $featureLabel,
            ]
        );
        if (! $ok) {
            return response()->json(['success' => false, 'message' => trans('plugins/job-board::messages.insufficient_credits')], 422);
        }

        if (\Illuminate\Support\Facades\Schema::hasColumn('jb_accounts', 'job_post_credits_balance')) {
            $account->job_post_credits_balance = (int) ($account->getAttribute('job_post_credits_balance') ?? 0) + 1;
            $account->save();
        }

        return response()->json([
            'success' => true,
            'message' => trans('plugins/job-board::messages.job_post_slot_purchased'),
            'job_post_credits_balance' => (int) $account->job_post_credits_balance,
            'credits' => (int) $account->credits,
        ]);
    }

    /**
     * Purchase 1 profile view slot with credits. Deducts credits and adds +1 to profile_view_credits_balance.
     * When package profile views are exhausted, these slots allow viewing candidate profiles.
     */
    public function purchaseProfileViewSlot(Request $request): JsonResponse
    {
        abort_unless(JobBoardHelper::isEnabledCreditsSystem(), 404);

        $account = auth('account')->user();
        if (! $account->isEmployer()) {
            return response()->json(['success' => false, 'message' => __('Unauthorized.')], 403);
        }

        $creditsRequired = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_CANDIDATE_PROFILE_VIEW, 25);
        if ($account->credits < $creditsRequired) {
            return response()->json([
                'success' => false,
                'message' => trans('plugins/job-board::messages.insufficient_credits'),
            ], 422);
        }

        $featureLabel = null;
        try {
            $consumption = CreditConsumption::getForAccountType('employer');
            $featureLabel = $consumption[CreditConsumption::FEATURE_CANDIDATE_PROFILE_VIEW]['label'] ?? 'Candidate Database Access';
        } catch (\Throwable $e) {
            $featureLabel = 'Candidate Database Access';
        }

        $ok = CreditConsumption::deductForFeature(
            $account,
            CreditConsumption::FEATURE_CANDIDATE_PROFILE_VIEW,
            $creditsRequired,
            trans('plugins/job-board::messages.credits_used_profile_view_slot', ['credits' => $creditsRequired]),
            [
                'source' => 'wallet',
                'feature_label' => $featureLabel,
            ]
        );
        if (! $ok) {
            return response()->json(['success' => false, 'message' => trans('plugins/job-board::messages.insufficient_credits')], 422);
        }

        if (\Illuminate\Support\Facades\Schema::hasColumn('jb_accounts', 'profile_view_credits_balance')) {
            $account->profile_view_credits_balance = (int) ($account->getAttribute('profile_view_credits_balance') ?? 0) + 1;
            $account->save();
        }

        return response()->json([
            'success' => true,
            'message' => trans('plugins/job-board::messages.profile_view_slot_purchased'),
            'profile_view_credits_balance' => (int) $account->profile_view_credits_balance,
            'credits' => (int) $account->credits,
        ]);
    }

    /**
     * Purchase a feature usage with credits (explicit OK in wallet popup).
     * Creates a debit in jb_transactions with feature_key.
     */
    public function purchaseFeature(Request $request): JsonResponse
    {
        abort_unless(JobBoardHelper::isEnabledCreditsSystem(), 404);

        $account = auth('account')->user();
        if (! $account->isEmployer()) {
            return response()->json(['success' => false, 'message' => __('Unauthorized.')], 403);
        }

        $featureKey = (string) $request->input('feature_key', '');
        if ($featureKey === '' || $featureKey === CreditConsumption::FEATURE_JOB_POSTING) {
            return response()->json(['success' => false, 'message' => __('Invalid feature.')], 422);
        }

        $creditConsumption = CreditConsumption::getForAccountType('employer');
        $item = $creditConsumption[$featureKey] ?? null;
        $creditsRequired = (int) Arr::get($item, 'credits', 0);
        $label = (string) Arr::get($item, 'label', $featureKey);

        if ($creditsRequired <= 0) {
            return response()->json(['success' => false, 'message' => __('Invalid feature.')], 422);
        }

        if ($account->credits < $creditsRequired) {
            return response()->json([
                'success' => false,
                'message' => trans('plugins/job-board::messages.insufficient_credits'),
            ], 422);
        }

        $ok = CreditConsumption::deductForFeature(
            $account,
            $featureKey,
            $creditsRequired,
            trans('plugins/job-board::messages.credits_used', ['credits' => $creditsRequired]) . ' (' . $label . ')',
            [
                'source' => 'wallet',
                'feature_label' => $label,
            ]
        );

        if (! $ok) {
            return response()->json(['success' => false, 'message' => trans('plugins/job-board::messages.insufficient_credits')], 422);
        }

        // Apply feature effect (per your rules)
        if ($featureKey === CreditConsumption::FEATURE_FEATURED_JOB) {
            // Employer ke saare jobs ko featured karo (250 credits = all jobs featured)
            Job::query()
                ->where('author_id', $account->getKey())
                ->where('author_type', Account::class)
                ->update(['is_featured' => 1]);
        } elseif ($featureKey === CreditConsumption::FEATURE_FEATURED_PROFILE_EMPLOYER) {
            // Employer profile (company) ko featured karo (500 credits, time as per plan)
            $account->companies()->update(['is_featured' => 1]);
        }

        return response()->json([
            'success' => true,
            'message' => __('Credits used successfully.'),
            'credits' => (int) $account->credits,
        ]);
    }
}
