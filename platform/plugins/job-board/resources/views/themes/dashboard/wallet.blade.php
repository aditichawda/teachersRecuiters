@extends(JobBoardHelper::viewPath('dashboard.layouts.master'))

@push('header')
<style>
/* Employer wallet – 2nd image: simple card UI */
.wallet-em-page .wallet-js-card-blue { background: linear-gradient(135deg, #0d6efd, #0a58ca) !important; border: none !important; border-radius: 12px !important; color: #fff !important; padding: 0.60rem 1.25rem !important; min-height: 220px !important; display: flex !important; flex-direction: column !important; justify-content: space-between !important; box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important; }
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
    .wallet-em-page .wallet-js-packages-row > .wallet-js-package-col { flex: 0 0 100% !important; min-width: 0; }
    .wallet-em-page .wallet-js-packages-row .wallet-package-card { min-height: 180px !important; }
}
.wallet-em-page .wallet-package-card-current { border: 2px solid #198754 !important; box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.2); position: relative; }
.wallet-em-page .wallet-package-card-current .wallet-current-badge { position: absolute; top: 0.5rem; right: 0.5rem; font-size: 0.65rem; font-weight: 600; text-transform: uppercase; background: #198754; color: #fff; padding: 0.2rem 0.5rem; border-radius: 6px; }
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
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#walletBillingModal">{{ __('Add Remaining Details') }}</button>
                    <div class="mt-2 small" id="wallet-em-remaining-details">
                        <div class="border rounded p-2 bg-light mt-2">
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
                                        <span class="text-muted small">{{ is_array($item) ? ($item['credits'] ?? 0) . ' ' . trans('plugins/job-board::credit-consumption.credits') : $item }}</span>
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
                                                <button type="button" class="btn btn-xs btn-outline-primary" data-bs-toggle="modal" data-bs-target="#walletSocialPromotionModal" title="{{ __('Submit request. Credits deducted when admin approves.') }}">
                                                    {{ __('Use credits') }}
                                                </button>
                                            @elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_DEDICATED_RECRUITER)
                                                <button type="button" class="btn btn-xs btn-outline-primary" data-bs-toggle="modal" data-bs-target="#walletDedicatedRecruiterModal" title="{{ __('Submit request. Credits deducted when admin approves.') }}">
                                                    {{ __('Use credits') }}
                                                </button>
                                            @elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_MULTIPLE_LOGIN)
                                                <button type="button" class="btn btn-xs btn-outline-primary" data-bs-toggle="modal" data-bs-target="#walletMultipleLoginModal" title="{{ __('Add sub-account. 250 credits per login.') }}">
                                                    {{ __('Use credits') }}
                                                </button>
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

    {{-- Modal: Use credits for a feature (generic) --}}
    @if($account->isEmployer())
        <div class="modal fade" id="walletFeaturePurchaseModal" tabindex="-1" aria-labelledby="walletFeaturePurchaseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="walletFeaturePurchaseModalLabel">{{ __('Use credits') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0" id="walletFeaturePurchaseModalMsg"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="button" class="btn btn-primary" id="walletFeaturePurchaseConfirmBtn">{{ __('OK') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Modal: Use credits for 1 Job Post --}}
    @if($account->isEmployer() && isset($jobPostCreditsRequired) && $jobPostCreditsRequired > 0)
    <div class="modal fade" id="walletJobPostSlotModal" tabindex="-1" aria-labelledby="walletJobPostSlotModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletJobPostSlotModalLabel">{{ trans('plugins/job-board::dashboard.wallet_use_credits_for_job_post') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_job_post_confirm_message', ['credits' => $jobPostCreditsRequired]) }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-primary" id="walletJobPostSlotConfirmBtn">{{ __('OK') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($account->isEmployer() && isset($profileViewCreditsRequired) && $profileViewCreditsRequired > 0)
    <div class="modal fade" id="walletProfileViewSlotModal" tabindex="-1" aria-labelledby="walletProfileViewSlotModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletProfileViewSlotModalLabel">{{ trans('plugins/job-board::dashboard.wallet_use_credits_for_profile_view') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_profile_view_confirm_message', ['credits' => $profileViewCreditsRequired]) }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-primary" id="walletProfileViewSlotConfirmBtn">{{ __('OK') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal: Social Promotion request form (credits deducted when admin approves) --}}
    @if($account->isEmployer())
    <div class="modal fade" id="walletSocialPromotionModal" tabindex="-1" aria-labelledby="walletSocialPromotionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletSocialPromotionModalLabel">{{ __('Post/Promote on LinkedIn/Other Social Pages') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="walletSocialPromotionForm">
                    @csrf
                    <div class="modal-body">
                        <p class="small text-muted mb-3">{{ __('3000 credits will be deducted when admin approves your request.') }}</p>
                        <div class="mb-2">
                            <label for="social_promotion_company_id" class="form-label">{{ __('Institution') }}</label>
                            <select name="company_id" id="social_promotion_company_id" class="form-select form-select-sm">
                                <option value="">{{ __('— Select —') }}</option>
                                @foreach($companies ?? [] as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label for="social_promotion_title" class="form-label">{{ __('Title') }}</label>
                                <input type="text" name="title" id="social_promotion_title" class="form-control form-control-sm" maxlength="255" placeholder="{{ __('Title') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="social_promotion_tag" class="form-label">{{ __('Tag') }}</label>
                                <input type="text" name="tag" id="social_promotion_tag" class="form-control form-control-sm" maxlength="255" placeholder="{{ __('Tag') }}">
                            </div>
                        </div>
                        <div class="mb-2 mt-2">
                            <label for="social_promotion_platform" class="form-label">{{ __('Platform') }} <span class="text-danger">*</span></label>
                            <select name="platform" id="social_promotion_platform" class="form-select form-select-sm" required>
                                <option value="">{{ __('— Select —') }}</option>
                                <option value="LinkedIn">LinkedIn</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Twitter">Twitter</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="social_promotion_message" class="form-label">{{ __('Message') }}</label>
                            <textarea name="message" id="social_promotion_message" class="form-control form-control-sm" rows="3" maxlength="2000" placeholder="{{ __('Message / Description') }}"></textarea>
                        </div>
                        <div class="mb-2">
                            <label for="social_promotion_image" class="form-label">{{ __('Image') }}</label>
                            <input type="file" name="image" id="social_promotion_image" class="form-control form-control-sm" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp">
                            <small class="text-muted">{{ __('Optional. JPG, PNG, GIF, WebP. Max 5MB.') }}</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="walletSocialPromotionSubmitBtn">{{ __('Submit request') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal: Dedicated Recruiter request form (5000 credits deducted when admin approves) --}}
    <div class="modal fade" id="walletDedicatedRecruiterModal" tabindex="-1" aria-labelledby="walletDedicatedRecruiterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletDedicatedRecruiterModalLabel">{{ __('Dedicated Recruiter / Personal Account Manager') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="walletDedicatedRecruiterForm">
                    @csrf
                    <div class="modal-body">
                        <p class="small text-muted mb-3">{{ __('5000 credits will be deducted when admin approves your request.') }}</p>
                        <div class="mb-2">
                            <label for="dr_duration_months" class="form-label">{{ __('Duration (months)') }} <span class="text-danger">*</span></label>
                            <select name="duration_months" id="dr_duration_months" class="form-select form-select-sm" required>
                                @for($i = 1; $i <= 24; $i++)
                                    <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? __('month') : __('months') }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="dr_company_id" class="form-label">{{ __('Institution') }}</label>
                            <select name="company_id" id="dr_company_id" class="form-select form-select-sm">
                                <option value="">{{ __('— Select —') }}</option>
                                @foreach($companies ?? [] as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <label for="dr_start_date" class="form-label">{{ __('Start date') }}</label>
                                <input type="date" name="start_date" id="dr_start_date" class="form-control form-control-sm">
                            </div>
                            <div class="col-6">
                                <label for="dr_end_date" class="form-label">{{ __('End date') }}</label>
                                <input type="date" name="end_date" id="dr_end_date" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="mb-2 mt-2">
                            <label for="dr_note" class="form-label">{{ __('Note') }}</label>
                            <textarea name="note" id="dr_note" class="form-control form-control-sm" rows="2" maxlength="1000" placeholder="{{ __('e.g. Need assistance for bulk teacher hiring') }}"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="walletDedicatedRecruiterSubmitBtn">{{ __('Submit request') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal: Multiple Login / Add Sub-Account (250 credits, immediate deduct) --}}
    <div class="modal fade" id="walletMultipleLoginModal" tabindex="-1" aria-labelledby="walletMultipleLoginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletMultipleLoginModalLabel">{{ __('Multiple Login / Add Sub-Account') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="walletMultipleLoginForm">
                    @csrf
                    <div class="modal-body">
                        <p class="small text-muted mb-3">{{ __('250 credits will be deducted. Sub-account can log in and manage recruitment.') }}</p>
                        <div class="mb-2">
                            <label for="ml_email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="ml_email" class="form-control form-control-sm" required placeholder="hr@school.com">
                        </div>
                        <div class="mb-2">
                            <label for="ml_name" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="ml_name" class="form-control form-control-sm" required maxlength="255" placeholder="{{ __('e.g. HR Manager') }}">
                        </div>
                        <div class="mb-2">
                            <label for="ml_role" class="form-label">{{ __('Role') }}</label>
                            <input type="text" name="role" id="ml_role" class="form-control form-control-sm" maxlength="60" placeholder="{{ __('e.g. Recruiter') }}">
                        </div>
                        <div class="mb-2">
                            <label for="ml_password" class="form-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="ml_password" class="form-control form-control-sm" required minlength="6" placeholder="••••••">
                        </div>
                        <div class="mb-2">
                            <label for="ml_password_confirmation" class="form-label">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" id="ml_password_confirmation" class="form-control form-control-sm" required minlength="6" placeholder="••••••">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="walletMultipleLoginSubmitBtn">{{ __('Add Sub-Account') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    @push('footer')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Generic feature purchase modal
        var featureModalEl = document.getElementById('walletFeaturePurchaseModal');
        var featureConfirmBtn = document.getElementById('walletFeaturePurchaseConfirmBtn');
        var featureMsg = document.getElementById('walletFeaturePurchaseModalMsg');
        var activeFeatureKey = null;
        var activeCredits = 0;
        var activeLabel = '';

        document.querySelectorAll('.wallet-feature-use-credits-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                activeFeatureKey = btn.getAttribute('data-feature-key') || '';
                activeLabel = btn.getAttribute('data-feature-label') || activeFeatureKey;
                activeCredits = parseInt(btn.getAttribute('data-credits') || '0', 10) || 0;
                if (featureMsg) {
                    featureMsg.textContent = 'Use ' + activeCredits + ' credits for "' + activeLabel + '"?';
                }
                if (featureModalEl && window.bootstrap) {
                    (new bootstrap.Modal(featureModalEl)).show();
                }
            });
        });

        if (featureConfirmBtn) {
            featureConfirmBtn.addEventListener('click', function() {
                if (!activeFeatureKey) return;
                featureConfirmBtn.disabled = true;
                fetch('{{ route('public.account.wallet.purchase_feature') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ feature_key: activeFeatureKey })
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (data.success) {
                        if (featureModalEl && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(featureModalEl);
                            if (m) m.hide();
                        }
                        window.location.reload();
                    } else {
                        alert(data.message || '{{ trans('plugins/job-board::messages.insufficient_credits') }}');
                    }
                })
                .catch(function() {
                    alert('{{ __('Something went wrong.') }}');
                })
                .finally(function() { featureConfirmBtn.disabled = false; });
            });
        }

        var btn = document.getElementById('walletJobPostSlotConfirmBtn');
        if (!btn) return;
        btn.addEventListener('click', function() {
            btn.disabled = true;
            fetch('{{ route('public.account.wallet.purchase_job_post_slot') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({})
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.success) {
                    var modal = document.getElementById('walletJobPostSlotModal');
                    if (modal && window.bootstrap) {
                        var m = bootstrap.Modal.getInstance(modal);
                        if (m) m.hide();
                    }
                    if (typeof window.location !== 'undefined') window.location.reload();
                } else {
                    alert(data.message || '{{ trans('plugins/job-board::messages.insufficient_credits') }}');
                }
            })
            .catch(function() {
                alert('{{ __('Something went wrong.') }}');
            })
            .finally(function() { btn.disabled = false; });
        });

        var profileViewBtn = document.getElementById('walletProfileViewSlotConfirmBtn');
        if (profileViewBtn) {
            profileViewBtn.addEventListener('click', function() {
                profileViewBtn.disabled = true;
                fetch('{{ route('public.account.wallet.purchase_profile_view_slot') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (data.success) {
                        var modal = document.getElementById('walletProfileViewSlotModal');
                        if (modal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(modal);
                            if (m) m.hide();
                        }
                        if (typeof window.location !== 'undefined') window.location.reload();
                    } else {
                        alert(data.message || '{{ trans('plugins/job-board::messages.insufficient_credits') }}');
                    }
                })
                .catch(function() {
                    alert('{{ __('Something went wrong.') }}');
                })
                .finally(function() { profileViewBtn.disabled = false; });
            });
        }

        var socialPromotionForm = document.getElementById('walletSocialPromotionForm');
        if (socialPromotionForm) {
            socialPromotionForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var submitBtn = document.getElementById('walletSocialPromotionSubmitBtn');
                if (submitBtn) submitBtn.disabled = true;
                var formData = new FormData(socialPromotionForm);
                fetch('{{ route('public.account.social-promotion-request.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var modal = document.getElementById('walletSocialPromotionModal');
                        if (modal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(modal);
                            if (m) m.hide();
                        }
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request submitted.') }}');
                        if (typeof window.location !== 'undefined') window.location.reload();
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() {
                    alert('{{ __('Something went wrong.') }}');
                })
                .finally(function() { if (submitBtn) submitBtn.disabled = false; });
            });
        }

        var dedicatedRecruiterForm = document.getElementById('walletDedicatedRecruiterForm');
        if (dedicatedRecruiterForm) {
            dedicatedRecruiterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var submitBtn = document.getElementById('walletDedicatedRecruiterSubmitBtn');
                if (submitBtn) submitBtn.disabled = true;
                var formData = new FormData(dedicatedRecruiterForm);
                fetch('{{ route('public.account.dedicated-recruiter-request.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var modal = document.getElementById('walletDedicatedRecruiterModal');
                        if (modal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(modal);
                            if (m) m.hide();
                        }
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request submitted.') }}');
                        if (typeof window.location !== 'undefined') window.location.reload();
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() {
                    alert('{{ __('Something went wrong.') }}');
                })
                .finally(function() { if (submitBtn) submitBtn.disabled = false; });
            });
        }

        var multipleLoginForm = document.getElementById('walletMultipleLoginForm');
        if (multipleLoginForm) {
            multipleLoginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var submitBtn = document.getElementById('walletMultipleLoginSubmitBtn');
                if (submitBtn) submitBtn.disabled = true;
                var formData = new FormData(multipleLoginForm);
                var body = {};
                formData.forEach(function(v, k) { body[k] = v; });
                fetch('{{ route('public.account.team-members.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(body)
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var modal = document.getElementById('walletMultipleLoginModal');
                        if (modal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(modal);
                            if (m) m.hide();
                        }
                        alert(data.message || (data.data && data.data.message) || '{{ __('Sub-account created.') }}');
                        if (typeof window.location !== 'undefined') window.location.reload();
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() {
                    alert('{{ __('Something went wrong.') }}');
                })
                .finally(function() { if (submitBtn) submitBtn.disabled = false; });
            });
        }
    });
    </script>
    @endpush

    {{-- Pending credit requests (Social Promotion + Dedicated Recruiter: credits deducted when admin approves) --}}
    @php
        $hasPendingSocial = $account->isEmployer() && isset($socialPromotionRequests) && $socialPromotionRequests->where('status', 'pending')->isNotEmpty();
        $hasPendingDR = $account->isEmployer() && isset($dedicatedRecruiterRequests) && $dedicatedRecruiterRequests->where('status', 'pending')->isNotEmpty();
        $hasAnyPending = $hasPendingSocial || $hasPendingDR;
    @endphp
    @if($hasAnyPending)
    <x-core::card class="mb-4">
        <x-core::card.header>
            <x-core::card.title>
                <x-core::icon name="ti ti-clock" class="me-2" />
                {{ __('Pending requests') }}
            </x-core::card.title>
        </x-core::card.header>
        <x-core::card.body class="p-0">
            <p class="small text-muted px-3 pt-2 mb-0">{{ __('Credits will be deducted when admin approves.') }}</p>
            <ul class="list-group list-group-flush">
                @foreach(($socialPromotionRequests ?? collect())->where('status', 'pending') as $req)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            {{ __('Social Promotion') }} – {{ $req->platform ?: __('Social') }}
                            @if($req->title)<span class="text-muted">({{ \Illuminate\Support\Str::limit($req->title, 40) }})</span>@endif
                            <br><small class="text-muted">{{ __('Requested') }}: {{ $req->requested_at ? $req->requested_at->format('M d, Y H:i') : '—' }}</small>
                        </span>
                        <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
                    </li>
                @endforeach
                @foreach(($dedicatedRecruiterRequests ?? collect())->where('status', 'pending') as $req)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            {{ __('Dedicated Recruiter / Personal Account Manager') }} – {{ $req->duration_months }} {{ __('month(s)') }}
                            <br><small class="text-muted">{{ __('Requested') }}: {{ $req->requested_at ? $req->requested_at->format('M d, Y H:i') : '—' }}</small>
                        </span>
                        <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
                    </li>
                @endforeach
            </ul>
        </x-core::card.body>
    </x-core::card>
    @endif

    <div class="wallet-consumption-invoice-section">
    {{-- Consumption Report (includes pending requests) --}}
    @php
        $pendingSocial = ($account->isEmployer() && isset($socialPromotionRequests) && $socialPromotionRequests) ? $socialPromotionRequests->where('status', 'pending') : collect();
        $pendingDR = ($account->isEmployer() && isset($dedicatedRecruiterRequests) && $dedicatedRecruiterRequests) ? $dedicatedRecruiterRequests->where('status', 'pending') : collect();
        $hasPending = $pendingSocial->isNotEmpty() || $pendingDR->isNotEmpty();
        $hasTransactions = $transactions->isNotEmpty();
        $showConsumptionTable = $hasTransactions || $hasPending;
    @endphp
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
                    <table class="table table-vcenter table-hover card-table mb-0 wallet-consumption-table" style="table-layout: fixed; width: 100%;">
                        <thead>
                            <tr>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_sl_no') }}</th>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_date_of_transaction') }}</th>
                                <th class="wallet-th-type">{{ trans('plugins/job-board::dashboard.wallet_type_of_transaction') }}</th>
                                <th>{{ __('Package') }}</th>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_valid_till') }}</th>
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
                                $dedicatedRecruiterCredits = 5000;
                            @endphp
                            {{-- Pending requests first (credits to be deducted when admin approves) --}}
                            @foreach($pendingSocial as $req)
                                @php $sn++; @endphp
                                <tr>
                                    <td>{{ $sn }}</td>
                                    <td class="text-nowrap">{{ $req->requested_at ? $req->requested_at->format('M d, Y H:i') : '—' }}</td>
                                    <td class="wallet-txn-description">{{ __('Post/Promote on LinkedIn/Other Social Pages') }}@if($req->title) – {{ \Illuminate\Support\Str::limit($req->title, 30) }}@endif</td>
                                    <td>—</td>
                                    <td class="text-nowrap small">—</td>
                                    <td class="text-end"><span class="text-warning fw-medium">-{{ format_credits_short($socialPromotionCredits) }}</span></td>
                                    <td><span class="badge bg-warning text-dark">{{ __('Pending') }}</span></td>
                                </tr>
                            @endforeach
                            @foreach($pendingDR as $req)
                                @php $sn++; @endphp
                                <tr>
                                    <td>{{ $sn }}</td>
                                    <td class="text-nowrap">{{ $req->requested_at ? $req->requested_at->format('M d, Y H:i') : '—' }}</td>
                                    <td class="wallet-txn-description">{{ __('Dedicated Recruiter / Personal Account Manager') }} – {{ $req->duration_months }} {{ __('month(s)') }}</td>
                                    <td>—</td>
                                    <td class="text-nowrap small">—</td>
                                    <td class="text-end"><span class="text-warning fw-medium">-{{ format_credits_short($dedicatedRecruiterCredits) }}</span></td>
                                    <td><span class="badge bg-warning text-dark">{{ __('Pending') }}</span></td>
                                </tr>
                            @endforeach
                            @foreach($transactions as $txn)
                                @php
                                    $sn++;
                                    $runningBalance += $txn->isCredit() ? $txn->credits : -$txn->credits;
                                    $showValidTill = !$txn->isCredit() && isset($packageExpiryAt) && $packageExpiryAt && in_array($txn->feature_key ?? '', $packageValidFeatures);
                                @endphp
                                <tr>
                                    <td>{{ $sn }}</td>
                                    <td class="text-nowrap">{{ $txn->created_at->format('M d, Y H:i') }}</td>
                                    <td class="wallet-txn-description">{!! BaseHelper::clean($txn->getDescription()) !!}</td>
                                    <td>{{ $txn->package_name ?? '—' }}</td>
                                    <td class="text-nowrap small">
                                        @if($showValidTill)
                                            <span class="text-success">{{ $packageExpiryAt->format('M d, Y') }}</span>
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if($txn->isCredit())
                                            <span class="text-success fw-medium">+{{ format_credits_short($txn->credits) }}</span>
                                        @else
                                            <span class="text-danger fw-medium">-{{ format_credits_short($txn->credits) }}</span>
                                        @endif
                                    </td>
                                    <td>—</td>
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
