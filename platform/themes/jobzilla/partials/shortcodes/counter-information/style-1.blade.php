<div class="section-full p-t0 p-b0 site-bg-white twm-counter-page-5-wrap">
    <div class="container">
        <div class="twm-company-approch5-outer">
            <div class="twm-company-approch5" style="@if($bgImage = $shortcode->bg_image) background-image: url('{{ RvMedia::getImageUrl($bgImage) }}') @else background-color: var(--primary-color) @endif">
                <div class="row">
                    @foreach($tabs as $tab)
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="counter-outer-two">
                                <div class="icon-content">
                                    <div class="tw-count-number site-text-white">
                                        <span class="counter">{{ Arr::get($tab, 'count') }}</span>{{ Arr::get($tab, 'extra') }}</div>
                                    <p class="icon-content-info">{!! BaseHelper::clean(Arr::get($tab, 'title')) !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
