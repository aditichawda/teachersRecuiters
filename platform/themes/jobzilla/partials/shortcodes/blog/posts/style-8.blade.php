<!-- OUR BLOG START -->
<div class="section-full p-t120 p-b90 site-bg-white">
    <div class="container">

        <!-- TITLE START-->
        <div class="section-head center wt-small-separator-outer mt-5">
        <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
            <div class="wt-small-separator site-text-primary">
                <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
            </div>
            <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>

        </div>
        <!-- TITLE END-->


        <div class="section-content">
            <div class="twm-blog-post-h5-wrap">
                <div class="row">
                    @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <!--Block one-->
                        <div class="blog-post twm-blog-post-h5-outer">
                            <div class="wt-post-media">
                                <a href="{{ $post->url }}">
                                    <img src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $post->name }}">
                                </a>
                            </div>
                            <div class="wt-post-info">
                                <div class="post-author">
                                    <div class="post-author-pic">
                                        @if ($post->author && $post->author->avatar)
                                        <div class="p-a-pic"><img src="{{ $post->author->avatar_url }}" alt=""></div>
                                        @endif
                                        <div class="p-a-info">
                                            @if ($post->author && $post->author->id)
                                            <a href="{{ $post->author->url }}">{{ $post->author->name }}</a>
                                            @endif
                                            <p>{{ $post->created_at->translatedFormat('d M') }}</p>
                                        </div>
                                    </div>
                                    <div class="post-categories">
                                        @foreach ($post->categories as $category)
                                        <a href="{{ $category->url }}">{{ $category->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="wt-post-title ">
                                    <h4 class="post-title">
                                        <a href="{{ $post->url }}">{{ $post->name }}</a>
                                    </h4>
                                </div>
                                <div class="wt-post-text ">
                                    <p>{{ Str::limit($post->description,160) }}</p>
                                </div>
                                <div class="wt-post-readmore ">
                                    <a href="{{ $post->url }}" class="site-button-link site-text-primary">{{ __('Read More') }}</a>
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
