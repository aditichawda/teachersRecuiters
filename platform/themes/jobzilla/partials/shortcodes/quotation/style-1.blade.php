<!-- PRICING TABLE SECTION START -->
<div class="section-full p-t120 p-b90 site-bg-white tw-pricing-area">
    <div class="container">
        <!-- TITLE START-->
        <div class="section-head left wt-small-separator-outer">
            <div class="wt-small-separator site-text-primary">
                <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
            </div>
            <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
        </div>
        <!-- TITLE END-->
        @php
            $list = ['monthly' => __('Monthly'), 'annual' => __('Annual')];
            $random = '-' . Str::random(9);
        @endphp
        <div class="section-content">
            <div class="twm-tabs-style-1">
                <ul class="nav nav-tabs" id="quotation-{{ $random }}" role="tablist">
                    @foreach ($list as $k => $value)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if ($loop->first) active @endif" data-bs-toggle="tab" data-bs-target="#{{ $k . $random }}"
                                type="button" role="tab" aria-controls="{{ $k }}">{{ $value }}</button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="quotation-{{ $random }}-content">
                    @foreach ($list as $k => $value)
                        <div class="tab-pane fade @if ($loop->first) show active @endif" id="{{ $k . $random }}" role="tabpanel" aria-labelledby="{{ $value }}">
                            <div class="pricing-block-outer">
                                <div class="row justify-content-center">
                                    @foreach ($tabs as $tab)
                                        <div class="col-lg-4 col-md-6 m-b30 @if ($shortcode->recommended == $loop->iteration) p-table-highlight @endif">
                                            <div class="pricing-table-1 circle-yellow">
                                                @if ($shortcode->recommended == $loop->iteration)
                                                    <div class="p-table-recommended">{{ __('Recommended') }}</div>
                                                @endif
                                                <div class="p-table-title">
                                                    <h4 class="wt-title">{{ Arr::get($tab, 'title') }}</h4>
                                                </div>
                                                <div class="p-table-inner">

                                                    <div class="p-table-price">
                                                        <span>{{ $k == 'monthly' ? Arr::get($tab, 'monthly_price') : Arr::get($tab, 'annual_price') }}/</span>
                                                        <p>{{ $value }}</p>
                                                    </div>
                                                    <div class="p-table-list">
                                                        <ul>
                                                            @foreach (Arr::get($tab, 'checked', []) as $item)
                                                                <li><i class="feather-check"></i>{{ $item }}</li>
                                                            @endforeach
                                                            @foreach (Arr::get($tab, 'uncheck', []) as $item)
                                                                <li class="disable"><i class="feather-x"></i>{{ $item }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    @if (Arr::get($tab, 'link'))
                                                        <div class="p-table-btn">
                                                            <a href="{{ Arr::get($tab, 'link') }}" class="site-button">{{ Arr::get($tab, 'title_link') }}</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PRICING TABLE SECTION END -->
