<!-- OUR BLOG START -->
<div class="section-full p-t120 p-b90 site-bg-gray">
    <div class="container">
        <!-- TITLE START-->
        <div class="section-head center wt-small-separator-outer mt-2">
        <h2 class="wt-title" style="
    text-align: center;
    justify-content: center;
    display: flex;
">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
            <div class="wt-small-separator site-text-primary" style="
    text-align: center;
    justify-content: center;
    display: flex;
">
                <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
            </div>
           
        </div>
        <!-- TITLE END-->
        <div class="section-content">
            <div class="twm-blog-post-1-outer-wrap">
                <div class="owl-carousel twm-la-home-blog owl-btn-bottom-center">
                    @foreach ($posts as $post)
                        <div class="item">
                            <!--Block one-->
                            <div class="blog-post twm-blog-post-1-outer">
                                <div class="wt-post-media">
                                    <a href="{{ $post->url }}">
                                        <img src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $post->name }}">
                                    </a>
                                </div>
                                <div class="wt-post-info">
                                    <div class="wt-post-meta ">
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
                                    <div class="wt-post-text ">
                                        <p>{{ Str::limit($post->description) }}</p>
                                    </div>
                                    <div class="wt-post-readmore ">
                                        <a href="{{ $post->url }}"
                                            class="site-button-link site-text-primary">{{ __('Read More') }}</a>
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
