@php
    Theme::set('pageCoverImage', theme_option('background_breadcrumb_default'))
@endphp

{!! Theme::partial('page-header') !!}

<div class="section-full  p-t120 p-b90 bg-white">
    <div class="container">
        <div class="section-content">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-post-single-outer">
                        <div class="blog-post-single bg-white">
                            <div class="wt-post-info">
                                @if ($post->image && theme_option('blog_post_detail_show_featured_image', false))
                                    <div class="wt-post-media m-b30">
                                        <img src="{{ RvMedia::getImageUrl($post->image, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $post->name }}">
                                    </div>
                                @endif

                                <div class="wt-post-title ">
                                    <div class="wt-post-meta-list">
                                        <div class="wt-list-content post-date">{{ Theme::formatDate($post->created_at) }}</div>
                                        <div class="wt-list-content post-author">{{ __('By :author', ['author' => $post->author->name]) }}</div>
                                    </div>
                                    <h3 class="post-title">{!! BaseHelper::clean($post->name) !!}</h3>

                                </div>

                                <div class="wt-post-discription">
                                    <div class="wt-post-discription">
                                        <p>
                                            <strong>{!! BaseHelper::clean($post->description) !!}</strong>
                                        </p>
                                    </div>
                                    <div class="ck-content">
                                        {!! BaseHelper::clean($post->content) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="post-area-tags-wrap">
                            <div class="post-social-icons-wrap">
                                <h4 class="mb-4">{{ __('Share') }}</h4>
                                {!! Theme::renderSocialSharing($post->url, SeoHelper::getDescription(), $post->image) !!}
                            </div>
                        </div>

                        <div class="mt-4">
                            {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $post) !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="side-bar">
                        {!! dynamic_sidebar('blog_sidebar') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
