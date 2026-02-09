<!-- OUR BLOG START -->
<div class="section-full p-t120 p-b90 site-bg-light-white">
    <div class="container">
        <div class="section-head center wt-small-separator-outer mt-5">
        <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
            <div class="wt-small-separator site-text-primary">
                <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
            </div>
            
        </div>
        <div class="section-content">
            <div class="twm-blog-post-3-outer-wrap">
                <div class="row d-flex justify-content-center">
                    @foreach ($posts as $post)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="blog-post twm-blog-post-3-outer">
                                <div class="wt-post-media">
                                    <a href="{{ $post->url }}">
                                        <img src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $post->name }}">
                                    </a>
                                </div>
                                <div class="wt-post-info">
                                    <div class="wt-post-meta">
                                        <ul>
                                            <li class="post-date">{{ Theme::formatDate($post->created_at) }}</li>
                                            @if ($post->author && $post->author->id)
                                                <li class="post-author">
                                                    <span>{{ __('By') }}</span>
                                                    <span class="text-primary">{{ $post->author->name }}</span>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="wt-post-title">
                                        <h4 class="post-title">
                                            <a href="{{ $post->url }}">{{ $post->name }}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- OUR BLOG END -->
