@php
    $styleBox = ['', 'circle-yellow', 'circle-pink']
@endphp

<div class="section-full p-t120 p-b90 site-bg-white tw-pricing-area">
    <div class="container">
        <div class="section-head left wt-small-separator-outer">
            @if ($title = $shortcode->title)
                <div class="wt-small-separator site-text-primary">
                    <div>{!! BaseHelper::clean($title) !!}</div>
                </div>
            @endif

            @if ($subtitle = $shortcode->subtitle)
                <h2 class="wt-title">{!! BaseHelper::clean($subtitle) !!}</h2>
            @endif
        </div>

        @if ($packages->count() > 0)
            <div class="section-content">
                <div class="twm-tabs-style-1">
                    <div class="pricing-block-outer">
                        <div class="row justify-content-center">
                            @foreach($packages as $package)
                                <div class="col-lg-4 col-md-6 m-b30">
                                    <div @class(['pricing-table-1', $styleBox[array_rand($styleBox)]])>
                                        @if ($package->is_default)
                                            <div class="p-table-recommended">{{ __('Recommended') }}</div>
                                        @endif
                                        <div class="p-table-title">
                                            <h4 class="wt-title">
                                                {{ $package->name }}
                                            </h4>
                                        </div>
                                        <div class="p-table-inner">
                                            <div class="p-table-price">
                                                <span>{{ format_price($package->price) }}</span>
                                            </div>
                                            <div class="p-table-list">
                                                <ul>
                                                    @if ($numberListing = $package->number_of_listings)
                                                        <li><i class="feather-check"></i>{{ __(':number :listing', ['number' => $numberListing, 'listing' => $numberListing > 1 ? __('Listings') : __('Listing')]) }}</li>
                                                    @endif

                                                    @if ($package->account_limit === 1)
                                                        <li class="disable"><i class="feather-x"></i>{{ __('Unlimited purchase by account') }}</li>
                                                    @elseif ($package->account_limit === null)
                                                        <li><i class="feather-check"></i>{{ __('Unlimited purchase by account') }}</li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="p-table-btn">
                                                <a href="{{ auth('account')->check() ? route('public.account.packages') : route('public.account.login') }}" class="site-button">{{ __('Purchase Now') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
