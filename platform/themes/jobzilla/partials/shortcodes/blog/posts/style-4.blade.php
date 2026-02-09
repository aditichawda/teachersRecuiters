<div class="section-full p-t120 p-b90 twm-blog-post-h-page6-wrap">
    <div class="container">

        <div class="wt-separator-two-part">
            <div class="row wt-separator-two-part-row">
                <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-left">
                    <div class="section-head left wt-small-separator-outer">
                        @if ($subtitle = $shortcode->subtitle)
                            <h2 class="wt-title">{!! BaseHelper::clean($subtitle) !!}</h2>
                        @endif
                        @if ($title = $shortcode->title)
                            <div class="wt-small-separator site-text-primary">
                                <div>{!! BaseHelper::clean($title) !!}</div>
                            </div>
                        @endif

                        
                    </div>
                </div>
                @if ($shortcode->button_action_label || $shortcode->button_action_url)
                    <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-right text-right">
                        <a href="{{ $shortcode->button_action_url ?: '#' }}" class="site-button">{!! BaseHelper::clean($shortcode->button_action_label ?: __('Explore All Blogs')) !!}</a>
                    </div>
                @endif
            </div>
        </div>

        <div class="section-content">
            <div class="twm-jobs-grid-wrap">
                <div class="row masonry-wrap">
                    @foreach ($posts as $post)
                        @if($loop->index == 1)
                            <div class="masonry-item col-lg-8 col-md-6 m-b30">
                                <div class="blog-post with-content twm-blog-post-h-page6">
                                    <div class="wt-post-info">
                                        <div class="wt-post-meta ">
                                            <ul>
                                                <li class="post-date">{{ Theme::formatDate($post->created_at) }}</li>
                                            </ul>
                                        </div>
                                        <div class="wt-post-title ">
                                            <h4 class="post-title">
                                                <a href="{{ $post->url }}">{{ $post->name }}</a>
                                            </h4>
                                        </div>
                                        <div class="wt-post-text">
                                            <p>{{ $post->description }}</p>
                                        </div>
                                        <div class="post-author">
                                            <div class="post-author-pic">
                                                <div class="p-a-pic"><img src="{{ $post->author->avatar_url }}" alt="{{ $post->author->name }}"></div>
                                                <div class="p-a-info">
                                                    <a href="{{ $post->author->url }}">{{ $post->author->name }}</a>
                                                    <p>{{ $post->author->type }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wt-post-media">
                                        <a href="{{ $post->url }}"><img src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $post->name }}"></a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="masonry-item col-lg-4 col-md-6 m-b30">
                                <div class="blog-post twm-blog-post-h-page6">
                                    <div class="wt-post-media">
                                        <a href="{{ $post->url }}"><img src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $post->name }}"></a>
                                    </div>
                                    <div class="wt-post-info">
                                        <div class="wt-post-meta ">
                                            <ul>
                                                <li class="post-date">{{ Theme::formatDate($post->created_at) }}</li>
                                            </ul>
                                        </div>
                                        <div class="wt-post-title ">
                                            <h4 class="post-title">
                                                <a href="{{ $post->url }}">{{ $post->name }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
