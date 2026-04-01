<div class="blog-post twm-blog-post-1-outer twm-blog-list-style">
    <div class="wt-post-media">
        <a href="{{ $post->url }}"><img src="{{ RvMedia::getImageUrl($post->image, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $post->name }}"></a>
    </div>
    <div class="wt-post-info">
        <div class="wt-post-meta ">
            <ul>
                <li class="post-date">{{ Theme::formatDate($post->created_at) }}</li>
                <li class="post-author">{{ __('By') }} <a href="{{ $post->author->url }}">{!! BaseHelper::clean($post->author->name) !!}</a></li>
            </ul>
        </div>
        <div class="wt-post-title ">
            <h4 class="post-title">
                <a href="{{ $post->url }}">{!! BaseHelper::clean($post->name) !!}</a>
            </h4>
        </div>
        <div class="wt-post-text ">
            <p>
                {!! BaseHelper::clean($post->description) !!}
            </p>
        </div>
        <div class="wt-post-readmore ">
            <a href="{{ $post->url }}" class="site-button-link site-text-primary">{{ __('Read More') }}</a>
        </div>
    </div>
</div>
