<!-- START BLOG-GRID -->
<section class="section">
    <div class="container">
        {!! apply_filters('ads_render', null, 'blog_list_before') !!}

        <div class="row">
            <div class="col-lg-8 col-md-7">
                <div class="blog-post">
                    <div class="row">
                        @foreach ($posts as $post)
                            <div class="col-lg-6 mb-4">
                                <div class="card blog-grid-box p-2">
                                    <a href="{{ $post->url }}">
                                        <img src="{{ RvMedia::getImageUrl($post->image, 'small', false, RvMedia::getDefaultImage()) }}"
                                             alt="{{ $post->name }}" class="img-fluid">
                                    </a>
                                    <div class="card-body">
                                        <ul class="list-inline d-flex justify-content-between mb-3">
                                            <li class="list-inline-item">
                                                <p class="text-muted mb-0">
                                                    @if ($post->author && $post->author->id)
                                                        <span class="text-muted fw-medium">{{ $post->author->name }}</span>
                                                        <span>- </span>
                                                    @endif
                                                    <span>{{ Theme::formatDate($post->created_at) }}</span>
                                                </p>
                                            </li>
                                            <li class="list-inline-item">
                                                <p class="text-muted mb-0">
                                                    <i class="mdi mdi-eye"></i>
                                                    <span>{{ number_format($post->views) }}</span>
                                                </p>
                                            </li>
                                        </ul>
                                        <a href="{{ $post->url }}" class="primary-link">
                                            <h6 class="fs-17">{{ $post->name }}</h6>
                                        </a>
                                        <p class="text-muted">{{ Str::limit($post->description, 150) }}</p>
                                        <div>
                                            <a href="{{ $post->url }}" class="form-text text-primary">
                                                <span>{{ __('Read More') }}</span>
                                                <i class="uil uil-angle-right-b"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div><!--end blog-grid-box-->
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mt-5">
                            {!! $posts->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
                        </div>
                    </div>

                </div><!--end blog-post-->
            </div>

            <div class="col-lg-4 col-md-5">
                <div class="sidebar ms-lg-4 ps-lg-4 mt-5 mt-lg-0">
                    {!! apply_filters('ads_render', null, 'blog_sidebar_before') !!}

                    {!! dynamic_sidebar('primary_sidebar') !!}

                    {!! apply_filters('ads_render', null, 'blog_sidebar_after') !!}
                </div>
                <!--end sidebar-->
            </div>
        </div>

        {!! apply_filters('ads_render', null, 'blog_list_after') !!}
    </div>
</section>
<!-- END BLOG-GRID -->
