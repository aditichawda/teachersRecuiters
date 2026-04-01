<div class="masonry-item col-lg-{{ 12 / $numberOfPostInRow }} col-md-12 m-b30">
    <div class="blog-post twm-blog-post-2-outer">
        <div class="wt-post-media">
            <a href="{{ $post->url }}"><img src="{{ RvMedia::getImageUrl($post->image, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $post->name }}"></a>
        </div>
        <div class="wt-post-info">
            <div class="wt-post-meta ">
                <ul>
                    <li class="post-date">{{ Theme::formatDate($post->created_at) }}</li>
                </ul>
            </div>

            <div class="wt-post-title ">
                <h4 class="post-title">
                    <a href="{{ $post->url }}">
                        {!! BaseHelper::clean($post->name) !!}
                    </a>
                </h4>
            </div>

            <div class="wt-post-readmore ">
                <a href="{{ $post->url }}" class="site-button-link site-text-secondry">{{ __('Read More') }}</a>
            </div>
        </div>
    </div>
</div>
