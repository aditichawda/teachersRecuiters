@php
    Theme::asset()->container('footer')->usePath()->add('swiper-js', 'libraries/js/swiper.bundle.min');
    Theme::asset()->usePath()->add('swiper-css', 'libraries/css/swiper.bundle.min.css');
@endphp

<div class="section-full p-t120 p-b90 site-bg-white job-categories-home-5-wrap twm-bdr-bottom-1">
    <div class="container">

        <div class="section-head center wt-small-separator-outer">
            @if ($title = $shortcode->title)
                <div class="wt-small-separator site-text-primary">
                    <div>{!! BaseHelper::clean($title) !!}</div>
                </div>
            @endif
            @if ($subtitle = $shortcode->subtitle)
                <h2 class="wt-title">{!! BaseHelper::clean($subtitle) !!}</h2>
            @endif
        </div>

    </div>

    <div class="section-content twm-jobs-grid-h5-section-outer">
        <div class="twm-jobs-grid-h5-section overlay-wraper"
        @if ($bgImage = $shortcode->bg_image)
            style="background-image: url({{ RvMedia::getImageUrl($bgImage) }});"
        @endif
        >
            <div class="overlay-main site-bg-primary opacity-09"></div>

            <div class="swiper-container category-5-slider">
                <div class="swiper-wrapper">
                    @foreach ($categories as $category)
                        <div class="swiper-slide">
                        <div class="job-categories-home-5">
                            <div class="twm-media cat-bg-clr-1">
                                @if ($iconImage = $category->getMetaData('icon_image', true))
                                    <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="{{ $category->name }}" width="64" height="64">
                                @elseif ($icon = $category->getMetaData('icon', true))
                                    {!! BaseHelper::renderIcon($icon) !!}
                                @endif
                            </div>
                            <div class="twm-content">
                                <a href="{{ $category->url }}">{{ $category->name }}</a>
                                <div class="twm-jobs-available">
                                    @if($category->active_jobs_count > 1)
                                        {!! BaseHelper::clean(__('<span> :number </span> Jobs Available', ['number' => $category->active_jobs_count ])) !!}
                                    @elseif($category->active_jobs_count === 1)
                                        {!! BaseHelper::clean(__('<span> :number </span> Job Available', ['number' => $category->active_jobs_count ])) !!}
                                    @else
                                        {!! BaseHelper::clean(__('No Job Available')) !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

        </div>
    </div>
</div>
