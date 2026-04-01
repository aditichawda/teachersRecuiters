<div class="section-full p-t120 p-b90 site-bg-gray bg-cover overlay-wraper"
    style="background-image: url('{{ Theme::asset()->url('images/bg-2.jpg') }}')">
    <div class="overlay-main site-bg-primary opacity-01"></div>
    <div class="container">
        <!-- TITLE START-->
        <div class="section-head center wt-small-separator-outer">
            <div class="wt-small-separator site-text-primary" >
                <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
            </div>
            <h2 class="wt-title site-text-white">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>

        </div>
        <!-- TITLE END-->
        <div class="section-content">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-5 col-md-12 m-b30">
                    @if ($post = $posts->first())
                        <div class="blog-post twm-blog-post-2-outer">
                            <div class="wt-post-media">
                                <a href="{{ $post->url }}">
                                    <img src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $post->name }}">
                                </a>
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
                                <div class="wt-post-readmore ">
                                    <a href="{{ $post->url }}" class="site-button-link site-text-secondry">{{ __('Read More') }}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-7 col-md-12">
                    <div class="twm-blog-post-wrap-right">
                        @foreach ($posts->skip(1) as $post)
                            <div class="blog-post twm-blog-post-1-outer shadow-none  m-b30">
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
                                    <div class="wt-post-title ">
                                        <h4 class="post-title">
                                            <a href="{{ $post->url }}">{{ $post->name }}</a>
                                        </h4>
                                    </div>
                                    <div class="wt-post-text ">
                                        <p>{{ $post->description }}</p>
                                    </div>
                                    <div class="wt-post-readmore ">
                                        <a href="{{ $post->url }}" class="site-button-link site-text-primary">{{ __('Read More') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- OUR BLOG END -->
