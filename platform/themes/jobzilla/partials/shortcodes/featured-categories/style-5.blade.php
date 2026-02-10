<div class="section-full p-t120 p-b90 site-bg-white twm-job-categories-hpage-6-area">
    <div class="section-head center wt-small-separator-outer">
        @if ($subtitle = $shortcode->subtitle)
            <div class="wt-small-separator site-text-primary">
                <div>{!! BaseHelper::clean($subtitle) !!}</div>
            </div>
        @endif

        @if ($title = $shortcode->title)
            <h2 class="wt-title">{!! BaseHelper::clean($title) !!}</h2>
        @endif
    </div>

    <div class="container">

        <div class="twm-job-cat-hpage-6-wrap">

            <div class="job-cat-block-hpage-6-section m-b30">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col">
                        <div class="job-cat-block-hpage-6 m-b30">
                            <div class="twm-media">
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
                                        {!! BaseHelper::clean(__('<span> :number </span> Posted new jobs', ['number' => $category->active_jobs_count ])) !!}
                                    @elseif($category->active_jobs_count === 1)
                                        {!! BaseHelper::clean(__('<span> :number </span> Posted new job', ['number' => $category->active_jobs_count ])) !!}
                                    @else
                                        {!! BaseHelper::clean(__('No Job Available')) !!}
                                    @endif
                                </div>
                                <div class="circle-line-wrap">
                                    <a class="circle-line-btn" href="{{ $category->url }}" ><i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            @if ($shortcode->button_action_label || $shortcode->button_action_url)
                <div class="text-center job-categories-btn">
                    <a href="{{ $shortcode->button_action_url ?: '#' }}" class="site-button">{!! BaseHelper::clean($shortcode->button_action_label ?: __('View All')) !!}</a>
                </div>
            @endif

        </div>

    </div>

</div>
