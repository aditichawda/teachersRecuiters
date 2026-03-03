@extends(JobBoardHelper::viewPath('dashboard.layouts.master'))

@push('header')
<style>
/* Same card layout as job seeker: blue + yellow separate cards, equal width */
.wallet-em-page .wallet-js-card-blue { background: linear-gradient(135deg, #0d6efd, #0a58ca) !important; border: none !important; border-radius: 12px !important; color: #fff !important; padding: 1.25rem !important; height: 200px !important; max-height: 200px !important; display: flex !important; flex-direction: column !important; justify-content: space-between !important; overflow: hidden !important; box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important; }
.wallet-em-page .wallet-js-card-blue .card-body { padding: 0 !important; border: none !important; background: transparent !important; flex: 1 1 auto; min-height: 0; }
.wallet-em-page .wallet-js-card-blue .card-footer { border: none !important; padding: 0.75rem 0 0 !important; background: transparent !important; flex-shrink: 0; }
.wallet-em-page .wallet-js-card-blue .wallet-js-coins-title { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.95; margin-bottom: 0.35rem; }
.wallet-em-page .wallet-js-card-blue .wallet-js-coins-value { font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.35rem; }
.wallet-em-page .wallet-js-card-blue .wallet-js-coins-row { font-size: 0.8rem; opacity: 0.95; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.2rem; }
.wallet-em-page .wallet-js-card-blue .btn-warning { background: #f59e0b !important; color: #1a1a2e !important; border: none !important; border-radius: 8px !important; font-weight: 600 !important; }
.wallet-em-page .wallet-js-card-orange { background: linear-gradient(135deg, #f59e0b, #fbbf24) !important; border: none !important; border-radius: 12px !important; min-height: 200px !important; display: flex !important; align-items: center !important; justify-content: center !important; padding: 1.5rem !important; box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important; }
.wallet-em-page .wallet-js-card-orange .card-body { padding: 0 !important; border: none !important; background: transparent !important; display: flex !important; align-items: center !important; justify-content: center !important; }
.wallet-em-page .wallet-js-card-orange .wallet-js-graphic { font-size: 4rem; color: rgba(0,0,0,0.3); }
.wallet-em-page .wallet-js-two-cols { display: flex !important; flex-wrap: wrap !important; gap: 0.75rem !important; width: 100% !important; }
.wallet-em-page .wallet-js-two-cols .wallet-js-col-blue,
.wallet-em-page .wallet-js-two-cols .wallet-js-col-orange { flex: 1 1 calc(50% - 0.375rem) !important; min-width: 140px; max-width: none; }
.wallet-em-page .wallet-js-packages-row { display: flex !important; flex-wrap: wrap !important; align-items: stretch !important; }
.wallet-em-page .wallet-js-packages-row > .wallet-js-package-col { flex: 1 1 0 !important; min-width: 200px; display: flex !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-card { display: flex !important; flex-direction: column !important; flex: 1 1 100% !important; min-height: 200px !important; background: #fff !important; border-radius: 12px !important; box-shadow: 0 1px 4px rgba(0,0,0,0.08) !important; border: 1px solid rgba(0,0,0,0.06) !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-card .card-body { flex: 1 1 auto !important; display: flex !important; flex-direction: column !important; padding: 1rem 1.25rem !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-card .card-body .wallet-package-card-actions { margin-top: auto !important; padding-top: 0.75rem !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-card .card-body h6 { font-size: 0.75rem !important; font-weight: 500 !important; color: #212529 !important; margin-bottom: 0.35rem !important; text-transform: uppercase !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-card .card-body .wallet-em-credits-validity { font-size: 0.775rem !important; color: #495057 !important; margin-bottom: 0.5rem !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-price { font-size: 0.75rem !important; font-weight: 500 !important; color: #1a1a2e !important; margin-bottom: 0.5rem !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-main-desc { font-size: 0.77rem !important; color: #6c757d !important; line-height: 1.5 !important; margin-bottom: 0 !important; }
.wallet-em-page .wallet-js-packages-row .btn { border-radius: 8px !important; font-weight: 600 !important; }
@media (max-width: 991px) {
    .wallet-em-page .wallet-js-packages-row > .wallet-js-package-col { flex: 0 0 calc(50% - 1rem) !important; min-width: 180px; }
}
@media (max-width: 575px) {
    .wallet-em-page .wallet-js-package-col { flex: 0 0 100% !important; }
}
</style>
@endpush

@section('content')
    {{-- Employer wallet page (same card layout as job seeker) --}}
    <div class="wallet-em-page">
    <div class="row mb-4">
        <div class="col-lg-3 col-xl-3 mb-4 mb-lg-0">
            <div class="wallet-js-two-cols">
                <div class="wallet-js-col-blue">
                    <x-core::card class="border-0 wallet-js-card-blue">
                        <x-core::card.body class="p-0">
                            <h6 class="wallet-js-coins-title mb-0">{{ trans('plugins/job-board::dashboard.wallet_available_coins') }}</h6>
                            <div class="wallet-js-coins-value">
                                <x-core::icon name="ti ti-coin" class="d-block" style="font-size:1.25rem;" />
                                {{ format_credits_short($account->credits ?? 0) }}
                            </div>
                            <div class="wallet-js-coins-row">
                                <x-core::icon name="ti ti-coin" />
                                {{ trans('plugins/job-board::dashboard.wallet_bonus') }} {{ format_credits_short($bonusCredits ?? 0) }}
                            </div>
                            <div class="wallet-js-coins-row">
                                <x-core::icon name="ti ti-coin" />
                                {{ trans('plugins/job-board::dashboard.wallet_purchased') }} {{ format_credits_short($purchasedCredits ?? 0) }}
                            </div>
                        </x-core::card.body>
                        <x-core::card.footer class="py-2">
                            @if(isset($packageExpiryAt) && $packageExpiryAt)
                                <p class="small text-white mb-2 opacity-90">{{ trans('plugins/job-board::dashboard.wallet_package_expires') }}: <strong>{{ $packageExpiryAt->format('M d, Y') }}</strong></p>
                            @endif
                            @if(isset($jobPostsAllowed) && $jobPostsAllowed > 0)
                                <p class="small text-white mb-1 opacity-90">{{ trans('plugins/job-board::dashboard.wallet_job_posts_used_allowed', ['used' => $jobPostsUsed ?? 0, 'allowed' => $jobPostsAllowed]) }}</p>
                            @endif
                            @if(isset($profileViewsAllowed) && $profileViewsAllowed > 0)
                                <p class="small text-white mb-2 opacity-90">{{ trans('plugins/job-board::dashboard.wallet_profile_views_used_allowed', ['used' => $profileViewsUsed ?? 0, 'allowed' => $profileViewsAllowed]) }}</p>
                            @endif
                        </x-core::card.footer>
                    </x-core::card>
                </div>
               
            </div>
        </div>
        <div class="col-lg-9 col-xl-9">
            <div class="d-flex justify-content-between align-items-center mb-2" id="choose-plan">
                <h5 class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_choose_plan') }}</h5>
                <small class="text-muted">{{ trans('plugins/job-board::dashboard.wallet_all_prices_gst') }}</small>
            </div>
            <div class="row wallet-js-packages-row g-3">
                @foreach($packages ?? [] as $package)
                    @php $isCurrentPackage = in_array($package->id, $currentPackageIds ?? []); @endphp
                    <div class="col wallet-js-package-col">
                        <div @class(['card wallet-package-card', 'border-warning' => $package->is_default, 'wallet-package-card-current' => $isCurrentPackage])>
                            @if($isCurrentPackage)
                                <span class="wallet-current-badge">{{ __('Current') }}</span>
                            @endif
                            @if($package->percent_save)
                                <div class="card-header py-1 bg-success text-white small text-center">
                                    {{ $package->percent_save_text }}
                                </div>
                            @endif
                            <x-core::card.body class="pb-2">
                                <h6 class="text-uppercase">{{ $package->name }}</h6>
                                <p class="wallet-em-credits-validity">{{ format_credits_short($package->credits_included ?? $package->number_of_listings) }} {{ trans('plugins/job-board::dashboard.credits') }}@if($package->validity_days) · {{ trans('plugins/job-board::dashboard.package_validity_days', ['days' => $package->validity_days]) }}@endif</p>
                                <p class="wallet-package-price">{{ $package->price_text }}</p>
                                @if(trim((string) $package->description) !== '')
                                    <p class="wallet-package-main-desc">{{ $package->description }}</p>
                                @elseif($packageFeatures = $package->formatted_features)
                                    <p class="wallet-package-main-desc">{{ is_array($packageFeatures) ? implode(' ', $packageFeatures) : $packageFeatures }}</p>
                                @endif
                                <div class="wallet-package-card-actions">
                                <x-core::form :url="route('public.account.package.subscribe.put')" method="put">
                                    <input type="hidden" name="id" value="{{ $package->id }}">
                                    <x-core::button type="submit" class="w-100 btn-sm" color="{{ $package->is_default ? 'warning' : 'primary' }}" :disabled="$package->isPurchased()">
                                        {{ $package->isPurchased() ? trans('plugins/job-board::dashboard.purchased_label') : trans('plugins/job-board::dashboard.wallet_buy_now') }}
                                    </x-core::button>
                                </x-core::form>
                                </div>
                            </x-core::card.body>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Row 2: Billing Details (3 col) | Coin Consumption (9 col) --}}
    <div class="row mb-4">
        <div class="col-lg-12 col-md-12 mb-4 mb-lg-3 mb-3" > 
            <x-core::card class="h-100">
                <x-core::card.header>
                    <x-core::card.title class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_billing_details') }}</x-core::card.title>
                </x-core::card.header>
                <x-core::card.body>
                    <p class="mb-1">{{ trans('plugins/job-board::dashboard.wallet_billing_name') }}: <strong>{{ $billingName ?? $account->name }}</strong></p>
                    <a href="{{ route('public.account.employer.settings.edit') }}" class="small d-block mb-2">{{ trans('plugins/job-board::dashboard.wallet_add_billing_details') }}</a>
                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#wallet-em-remaining-details" aria-expanded="false">Remaining details</button>
                    <div class="collapse mt-2 small" id="wallet-em-remaining-details">
                        <div class="border rounded p-2 bg-light">
                            <p class="mb-1"><strong>Name:</strong> {{ $account->name ?? trim(($account->first_name ?? '') . ' ' . ($account->last_name ?? '')) ?: '—' }}</p>
                            <p class="mb-1"><strong>Address:</strong> {{ $account->address ?? '—' }}</p>
                            <p class="mb-1"><strong>Mobile:</strong> {{ $account->phone ? (($account->phone_country_code ?? '') . ' ' . $account->phone) : '—' }}</p>
                            <p class="mb-1"><strong>State:</strong> {{ $account->state_name ?? '—' }}</p>
                            <p class="mb-0"><strong>GST No:</strong> {{ $account->billing_gst_number ?? '—' }}</p>
                        </div>
                    </div>
                </x-core::card.body>
            </x-core::card>
        </div>
        <div class="col-lg-12 col-md-12">
            <x-core::card class="h-100">
                <x-core::card.header>
                    <x-core::card.title class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_coins_consumption') }}</x-core::card.title>
                </x-core::card.header>
                <x-core::card.body>
                    @php
                        $siteName = $siteName ?? \Botble\Theme\Facades\Theme::getSiteTitle();
                        if (!empty($creditConsumption)) {
                            $consumptionList = $creditConsumption;
                        } else {
                            $consumption = $account->isEmployer()
                                ? trans('plugins/job-board::dashboard.wallet_consumption_employer')
                                : trans('plugins/job-board::dashboard.wallet_consumption_jobseeker');
                            $consumptionList = is_array($consumption) ? $consumption : [];
                        }
                    @endphp
                    <ul class="list-unstyled mb-0">
                        @if(!empty($creditConsumption))
                            @foreach($consumptionList as $key => $item)
                                <li class="d-flex justify-content-between align-items-center py-1 border-bottom">
                                    <span>{{ is_array($item) ? ($item['label'] ?? $key) : $key }}</span>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="text-muted small">@if($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_ADMISSION_ENQUIRY) {{ __('Paid') }} @else{{ is_array($item) ? ($item['credits'] ?? 0) . ' ' . trans('plugins/job-board::credit-consumption.credits') : $item }} @endif</span>
                                        @if($account->isEmployer() && is_array($item) && !empty($item['credits']))
                                            @php $featureActiveWithPackage = in_array($key, $activePackageFeatureKeys ?? []); @endphp
                                            @if($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_JOB_POSTING && isset($jobPostCreditsRequired) && $jobPostCreditsRequired > 0)
                                                <button type="button" class="btn btn-xs btn-outline-warning" data-bs-toggle="modal" data-bs-target="#walletJobPostSlotModal" title="{{ trans('plugins/job-board::dashboard.wallet_use_credits_for_job_post') }}">
                                                    {{ __('Use credits') }}
                                                </button>
                                            @elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_CANDIDATE_PROFILE_VIEW && isset($profileViewCreditsRequired) && $profileViewCreditsRequired > 0)
                                                @if(isset($profileViewCreditsBalance))
                                                    <span class="text-muted small me-1">{{ trans('plugins/job-board::dashboard.wallet_profile_view_slot_balance', ['count' => $profileViewCreditsBalance]) }}</span>
                                                @endif
                                                <button type="button" class="btn btn-xs btn-outline-info" data-bs-toggle="modal" data-bs-target="#walletProfileViewSlotModal" title="{{ trans('plugins/job-board::dashboard.wallet_use_credits_for_profile_view') }}">
                                                    {{ trans('plugins/job-board::dashboard.wallet_use_credits_for_profile_view') }}
                                                </button>
                                            @elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_SOCIAL_PROMOTION)
                                                <button type="button" class="btn btn-xs btn-outline-primary" id="walletSocialPromotionBtn" title="{{ __('First credits will be deducted, then fill the form.') }}">
                                                    {{ __('Use credits') }}
                                                </button>
                                            @elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_DEDICATED_RECRUITER)
                                                @if(isset($dedicatedRecruiterValidTill) && $dedicatedRecruiterValidTill)
                                                    <span class="badge bg-success me-1">{{ __('Valid till') }} {{ $dedicatedRecruiterValidTill->format('M d, Y') }}</span>
                                                    <button type="button" class="btn btn-xs btn-outline-secondary" disabled title="{{ __('Active until :date', ['date' => $dedicatedRecruiterValidTill->format('M d, Y')]) }}">
                                                        {{ __('Use credits') }}
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-xs btn-outline-primary" id="walletDedicatedRecruiterBtn" title="{{ __('First credits deducted, then form. Valid 1 month.') }}">
                                                        {{ __('Use credits') }}
                                                    </button>
                                                @endif
                                            @elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_JOB_POSTING_ASSISTANCE)
                                                @if($featureActiveWithPackage && isset($packageExpiryAt) && $packageExpiryAt)
                                                    <span class="badge bg-success" title="{{ trans('plugins/job-board::dashboard.wallet_valid_till_package', ['date' => $packageExpiryAt->format('M d, Y')]) }}">{{ __('Valid till') }} {{ $packageExpiryAt->format('M d, Y') }}</span>
                                                    <button type="button" class="btn btn-xs btn-outline-secondary" disabled title="{{ __('Included in package until :date', ['date' => $packageExpiryAt->format('M d, Y')]) }}">
                                                        {{ __('Use credits') }}
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-xs btn-outline-primary" data-bs-toggle="modal" data-bs-target="#walletJobPostingAssistanceModal" title="{{ __('Request job posting assistance. 250 credits deducted. Admin will approve and can create job.') }}">
                                                        {{ __('Use credits') }}
                                                    </button>
                                                @endif
                                            @elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_WALKIN_DRIVE_AD)
                                                <button type="button" class="btn btn-xs btn-outline-primary" id="walletWalkinDriveAdBtn" title="{{ __('First credits deducted, then form (banner + placement).') }}">
                                                    {{ __('Use credits') }}
                                                </button>
                                            @elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_MULTIPLE_LOGIN)
                                                <button type="button" class="btn btn-xs btn-outline-primary" id="walletMultipleLoginBtn" title="{{ __('First 250 credits will be deducted, then fill form to add sub-account.') }}">
                                                    {{ __('Use credits') }}
                                                </button>
                                            @elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_ADMISSION_ENQUIRY)
                                                @if($featureActiveWithPackage && isset($packageExpiryAt) && $packageExpiryAt)
                                                    <span class="badge bg-success" title="{{ trans('plugins/job-board::dashboard.wallet_valid_till_package', ['date' => $packageExpiryAt->format('M d, Y')]) }}">{{ __('Unlocked') }}</span>
                                                    <span class="text-muted small">{{ __('Included in your package') }}</span>
                                                @else
                                                    <a href="{{ route('public.account.packages') }}#choose-plan" class="btn btn-xs btn-outline-success" title="{{ __('Unlock with payment (not coins)') }}">
                                                        {{ __('Unlock with payment') }}
                                                    </a>
                                                @endif
                                            @elseif($key !== \Botble\JobBoard\Models\CreditConsumption::FEATURE_JOB_POSTING)
                                                @if($featureActiveWithPackage && isset($packageExpiryAt) && $packageExpiryAt)
                                                    <span class="badge bg-success" title="{{ trans('plugins/job-board::dashboard.wallet_valid_till_package', ['date' => $packageExpiryAt->format('M d, Y')]) }}">{{ __('Valid till') }} {{ $packageExpiryAt->format('M d, Y') }}</span>
                                                    <button type="button" class="btn btn-xs btn-outline-secondary wallet-feature-use-credits-btn" disabled title="{{ __('Valid with package until expiry') }}">
                                                        {{ __('Use credits') }}
                                                    </button>
                                                @else
                                                    <button
                                                        type="button"
                                                        class="btn btn-xs btn-outline-primary wallet-feature-use-credits-btn"
                                                        data-feature-key="{{ $key }}"
                                                        data-feature-label="{{ $item['label'] ?? $key }}"
                                                        data-credits="{{ (int) ($item['credits'] ?? 0) }}"
                                                    >
                                                        {{ __('Use credits') }}
                                                    </button>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        @else
                            @foreach($consumptionList as $label => $rate)
                                <li class="d-flex justify-content-between align-items-center py-1 border-bottom">
                                    <span>{{ str_replace(':site', $siteName, $label) }}</span>
                                    <span class="text-muted small">{{ $rate }}</span>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    <!-- @if($account->isEmployer() && isset($jobPostCreditsRequired) && $jobPostCreditsRequired > 0)
                        <div class="mt-3 pt-3 border-top">
                            @if(isset($jobPostCreditsBalance))
                                <p class="small text-muted mb-2">{{ trans('plugins/job-board::dashboard.wallet_job_post_slot_balance', ['count' => $jobPostCreditsBalance]) }}</p>
                            @endif
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#walletJobPostSlotModal">
                                <x-core::icon name="ti ti-plus" class="me-1" />
                                {{ trans('plugins/job-board::dashboard.wallet_use_credits_for_job_post') }}
                            </button>
                        </div>
                    @endif -->
                </x-core::card.body>
            </x-core::card>
        </div>
    </div>

    {{-- Coins Consumption (employer) --}}
    <div class="row mb-4">
        <div class="col-lg-6">
            <x-core::card class="h-100">
                <x-core::card.header>
                    <x-core::card.title class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_coins_consumption') }}</x-core::card.title>
                </x-core::card.header>
                <x-core::card.body>
                    @php
                        $consumption = trans('plugins/job-board::dashboard.wallet_consumption_employer');
                        $consumption = is_array($consumption) ? $consumption : [];
                        $siteName = $siteName ?? \Botble\Theme\Facades\Theme::getSiteTitle();
                    @endphp
                    <ul class="list-unstyled mb-0">
                        @foreach($consumption as $label => $rate)
                            <li class="d-flex justify-content-between align-items-center py-1 border-bottom">
                                <span>{{ str_replace(':site', $siteName, $label) }}</span>
                                <span class="text-muted small">{{ $rate }}</span>
                            </li>
                        @endforeach
                    </ul>
                </x-core::card.body>
            </x-core::card>
        </div>
    </div>

    {{-- Consumption Report --}}
    <x-core::card class="mb-4">
        <x-core::card.header>
            <x-core::card.title>
                <x-core::icon name="ti ti-report-money" class="me-2" />
                {{ trans('plugins/job-board::dashboard.wallet_consumption_report') }}
            </x-core::card.title>
        </x-core::card.header>
        <x-core::card.body class="p-0">
            @if($showConsumptionTable)
                <div class="table-responsive">
                    <table class="table table-vcenter table-hover card-table mb-0">
                        <thead>
                            <tr>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_sl_no') }}</th>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_date_of_transaction') }}</th>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_type_of_transaction') }}</th>
                                <th class="text-end">{{ trans('plugins/job-board::dashboard.wallet_amount_coins') }}</th>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $runningBalance = $account->credits;
                                $sn = 0;
                                $packageValidFeatures = [\Botble\JobBoard\Models\CreditConsumption::FEATURE_FEATURED_JOB, \Botble\JobBoard\Models\CreditConsumption::FEATURE_FEATURED_PROFILE_EMPLOYER, \Botble\JobBoard\Models\CreditConsumption::FEATURE_ADMISSION_ENQUIRY, \Botble\JobBoard\Models\CreditConsumption::FEATURE_JOB_POSTING_ASSISTANCE];
                                $socialPromotionCredits = 3000;
                                $dedicatedRecruiterCredits = 2500;
                            @endphp
                            {{-- Social Promotion & Dedicated Recruiter: sab dikhao – Pending / Approved / Rejected --}}
                            @foreach($allSocialRequests as $req)
                                @php
                                    $sn++;
                                    $reqStatus = $req->status ?? 'pending';
                                    $statusBadge = $reqStatus === 'accepted' ? 'bg-success' : ($reqStatus === 'rejected' ? 'bg-danger' : 'bg-warning');
                                    $statusLabel = $reqStatus === 'accepted' ? __('Approved') : ($reqStatus === 'rejected' ? __('Rejected') : __('Pending'));
                                @endphp
                                <tr>
                                    <td>{{ $sn }}</td>
                                    <td class="text-nowrap">{{ $req->requested_at ? $req->requested_at->format('M d, Y') : '—' }}</td>
                                    <td class="wallet-txn-description">{{ __('Post/Promote on LinkedIn/Other Social Pages') }}@if($req->title) – {{ \Illuminate\Support\Str::limit($req->title, 30) }}@endif</td>
                                    <td>—</td>
                                    <td class="text-nowrap small">—</td>
                                    <td class="text-end"><span class="text-warning fw-medium">-{{ format_credits_short($socialPromotionCredits) }}</span></td>
                                    <td><span class="badge {{ $statusBadge }} text-white">{{ $statusLabel }}</span></td>
                                </tr>
                            @endforeach
                            @foreach($allDRRequests as $req)
                                @php
                                    $sn++;
                                    $reqStatus = $req->status ?? 'pending';
                                    $statusBadge = $reqStatus === 'accepted' ? 'bg-success' : ($reqStatus === 'rejected' ? 'bg-danger' : 'bg-warning');
                                    $statusLabel = $reqStatus === 'accepted' ? __('Approved') : ($reqStatus === 'rejected' ? __('Rejected') : __('Pending'));
                                @endphp
                                <tr>
                                    <td>{{ $sn }}</td>
                                    <td class="text-nowrap">{{ $req->requested_at ? $req->requested_at->format('M d, Y') : '—' }}</td>
                                    <td class="wallet-txn-description">{{ __('Dedicated Recruiter / Personal Account Manager') }} – {{ $req->duration_months }} {{ __('month(s)') }}</td>
                                    <td>—</td>
                                    <td class="text-nowrap small">—</td>
                                    <td class="text-end"><span class="text-warning fw-medium">-{{ format_credits_short($dedicatedRecruiterCredits) }}</span></td>
                                    <td><span class="badge {{ $statusBadge }} text-white">{{ $statusLabel }}</span></td>
                                </tr>
                            @endforeach
                            @foreach($transactions as $txn)
                                @php
                                    $skipTxn = !$txn->isCredit() && in_array($txn->feature_key ?? '', [\Botble\JobBoard\Models\CreditConsumption::FEATURE_SOCIAL_PROMOTION, \Botble\JobBoard\Models\CreditConsumption::FEATURE_DEDICATED_RECRUITER], true);
                                @endphp
                                @if($skipTxn)
                                    @continue
                                @endif
                                @php
                                    $sn++;
                                    $runningBalance += $txn->isCredit() ? $txn->credits : -$txn->credits;
                                    $showValidTill = !$txn->isCredit() && isset($packageExpiryAt) && $packageExpiryAt && in_array($txn->feature_key ?? '', $packageValidFeatures);
                                @endphp
                                <tr>
                                    <td>{{ $sn }}</td>
                                    <td>{{ $txn->created_at->format('M d, Y H:i') }}</td>
                                    <td>{!! BaseHelper::clean($txn->getDescription()) !!}</td>
                                    <td class="text-end">
                                        @if($txn->isCredit())
                                            <span class="text-success fw-medium">+{{ format_credits_short($txn->credits) }}</span>
                                        @else
                                            <span class="text-danger fw-medium">-{{ format_credits_short($txn->credits) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $txnStatus = $transactionStatusMap[$txn->id] ?? null;
                                        @endphp
                                        @if($txnStatus === 'approved')
                                            <span class="badge bg-success text-white">{{ __('Approved') }}</span>
                                        @elseif($txnStatus === 'rejected')
                                            <span class="badge bg-danger text-white">{{ __('Rejected') }}</span>
                                        @elseif($txnStatus === 'pending')
                                            <span class="badge bg-warning text-white">{{ __('Pending') }}</span>
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($transactions->hasPages())
                    <div class="card-footer d-flex align-items-center">
                        {{ $transactions->links() }}
                    </div>
                @endif
            @else
                <div class="empty p-5 text-center">
                    <x-core::icon name="ti ti-receipt-off" class="display-4 text-muted" />
                    <p class="empty-title mt-2">{{ trans('plugins/job-board::dashboard.wallet_no_consumption_yet') }}</p>
                    <x-core::button tag="a" :href="route('public.account.packages')" color="primary" size="sm">
                        {{ trans('plugins/job-board::dashboard.wallet_buy_credits') }}
                    </x-core::button>
                </div>
            @endif
        </x-core::card.body>
    </x-core::card>

    {{-- Invoice details (employer only) --}}
    <x-core::card>
        <x-core::card.header>
            <x-core::card.title>
                <x-core::icon name="ti ti-file-invoice" class="me-2" />
                {{ trans('plugins/job-board::dashboard.wallet_invoice_details') }}
            </x-core::card.title>
            <x-core::card.actions>
                <x-core::button tag="a" :href="route('public.account.invoices.index')" size="sm">
                    {{ trans('plugins/job-board::messages.view') }} {{ trans('plugins/job-board::messages.invoices') }}
                </x-core::button>
            </x-core::card.actions>
        </x-core::card.header>
        <x-core::card.body class="p-0">
            @if($invoices->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-vcenter table-hover card-table mb-0">
                        <thead>
                            <tr>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_invoice_code') }}</th>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_invoice_amount') }}</th>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_invoice_status') }}</th>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_invoice_date') }}</th>
                                <th class="text-end">{{ trans('plugins/job-board::dashboard.wallet_actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                                @php
                                    $invoice->loadMissing('payment');
                                    $payment = $invoice->payment;
                                    $currency = $payment ? \Botble\JobBoard\Models\Currency::query()->where('title', strtoupper($payment->currency))->first() : null;
                                @endphp
                                <tr>
                                    <td>
                                        <a href="{{ route('public.account.invoices.show', $invoice) }}" class="text-primary text-decoration-none fw-medium">#{{ $invoice->code }}</a>
                                    </td>
                                    <td>{{ format_price($invoice->amount, $currency) }}</td>
                                    <td>
                                        <x-core::badge :color="$invoice->status->getValue() === 'completed' ? 'success' : 'warning'">
                                            {{ $invoice->status->label() }}
                                        </x-core::badge>
                                    </td>
                                    <td>{{ $invoice->created_at->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        <x-core::button tag="a" :href="route('public.account.invoices.show', $invoice)" size="sm" color="default" icon="ti ti-eye">
                                            {{ trans('plugins/job-board::dashboard.wallet_view_invoice') }}
                                        </x-core::button>
                                        <x-core::button tag="a" :href="route('public.account.invoices.generate_invoice', ['invoice' => $invoice->id, 'type' => 'download'])" size="sm" color="primary" icon="ti ti-download" target="_blank" rel="noopener" download>
                                            {{ trans('plugins/job-board::dashboard.wallet_download_invoice') }}
                                        </x-core::button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($invoices->hasPages())
                    <div class="card-footer d-flex align-items-center">
                        {{ $invoices->withQueryString()->links() }}
                    </div>
                @endif
            @else
                <div class="empty p-5 text-center">
                    <x-core::icon name="ti ti-file-off" class="display-4 text-muted" />
                    <p class="empty-title mt-2">{{ trans('plugins/job-board::dashboard.wallet_no_invoices') }}</p>
                </div>
            @endif
        </x-core::card.body>
    </x-core::card>
    </div>{{-- .wallet-consumption-invoice-section --}}
    </div>{{-- .wallet-em-page --}}

    {{-- Billing Details Modal --}}
    <div class="modal fade" id="walletBillingModal" tabindex="-1" aria-labelledby="walletBillingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletBillingModalLabel">{{ __('Billing Details') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="walletBillingForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="billing_name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" id="billing_name" name="name" placeholder="{{ __('Name') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="billing_address">{{ __('Address') }}</label>
                            <textarea class="form-control" id="billing_address" name="address" rows="2" placeholder="{{ __('Address with City, State, Pin Code') }}"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="billing_mobile">{{ __('Mobile No') }}</label>
                            <input type="text" class="form-control" id="billing_mobile" name="mobile" placeholder="{{ __('Mobile No') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="billing_state">{{ __('State') }}</label>
                            <input type="text" class="form-control" id="billing_state" name="state" placeholder="{{ __('State') }}">
                        </div>
                        <div class="mb-0">
                            <label class="form-label" for="billing_gst">{{ __('GST No') }}</label>
                            <input type="text" class="form-control" id="billing_gst" name="gst_number" placeholder="{{ __('GST No (if available)') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="walletBillingSubmit">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Package expiring / expired popup --}}
    @if(isset($packageExpiryAt) && $packageExpiryAt && isset($packageExpiryName))
        @php
            $now = \Carbon\Carbon::now();
            $isExpired = $packageExpiryAt->isPast();
            $daysUntilExpiry = (int) $now->diffInDays($packageExpiryAt, true);
            $expiringSoon = !$isExpired && $daysUntilExpiry <= 7;
        @endphp
        @if($isExpired || $expiringSoon)
            <div class="modal fade" id="walletPackageExpiryModal" tabindex="-1" aria-labelledby="walletPackageExpiryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header {{ $isExpired ? 'bg-danger text-white' : 'bg-warning' }}">
                            <h5 class="modal-title" id="walletPackageExpiryModalLabel">{{ $isExpired ? __('Package Expired') : __('Package Expiring Soon') }}</h5>
                            <button type="button" class="btn-close {{ $isExpired ? 'btn-close-white' : '' }}" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if($isExpired)
                                <p class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_package_expired', ['name' => $packageExpiryName]) }}</p>
                            @else
                                <p class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_package_expiring_soon', ['name' => $packageExpiryName, 'date' => $packageExpiryAt->format('M d, Y')]) }}</p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <a href="#choose-plan" class="btn btn-primary" data-bs-dismiss="modal">{{ trans('plugins/job-board::dashboard.wallet_buy_credits') }}</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endsection

@push('footer')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var expiryModal = document.getElementById('walletPackageExpiryModal');
    if (expiryModal && typeof bootstrap !== 'undefined') {
        var m = new bootstrap.Modal(expiryModal);
        m.show();
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('walletBillingModal');
    var form = document.getElementById('walletBillingForm');
    var submitBtn = document.getElementById('walletBillingSubmit');
    if (!modal || !form) return;
    var billingDetailsUrl = '{{ route("public.account.billing-details") }}';
    var billingUpdateUrl = '{{ route("public.account.billing-details.update") }}';

    modal.addEventListener('show.bs.modal', function() {
        fetch(billingDetailsUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.data) {
                    document.getElementById('billing_name').value = data.data.name || '';
                    document.getElementById('billing_address').value = data.data.address || '';
                    document.getElementById('billing_mobile').value = data.data.mobile || '';
                    document.getElementById('billing_state').value = data.data.state || '';
                    document.getElementById('billing_gst').value = data.data.gst_number || '';
                }
            })
            .catch(function() {});
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        submitBtn.disabled = true;
        var fd = new FormData(form);
        fetch(billingUpdateUrl, {
            method: 'POST',
            body: fd,
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || fd.get('_token') }
        })
        .then(function(r) { return r.json(); })
        .then(function(res) {
            if (res.error === false) {
                window.location.reload();
            } else {
                submitBtn.disabled = false;
                alert(res.message || 'Something went wrong.');
            }
        })
        .catch(function() { submitBtn.disabled = false; });
    });
});
</script>
@endpush
