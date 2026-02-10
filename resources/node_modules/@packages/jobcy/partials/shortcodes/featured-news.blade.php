<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center mb-5">
                    <h2 class="title mb-3">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                    <p class="text-muted">{!! BaseHelper::clean($shortcode->subtitle) !!}</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-lg-4 col-md-6">
                    <div class="blog-box card p-2 mt-3">
                        <div class="blog-img position-relative overflow-hidden">
                            <a href="{{ $post->url }}">
                                <img
                                    class="img-fluid"
                                    src="{{ RvMedia::getImageUrl($post->image, 'small', false, RvMedia::getDefaultImage()) }}"
                                    alt="{{ $post->name }}"
                                />
                            </a>
                            <div class="bg-overlay"></div>
                            <div class="author">
                                <p class="mb-0"><i class="mdi mdi-account text-light"></i> <span
                                        class="text-light user"
                                    >{{ $post->author->name }}</span></p>
                                <p class="text-light mb-0 date"><i class="mdi mdi-calendar-check"></i>
                                    {{ Theme::formatDate($post->created_at) }}</p>
                            </div>
                            <div class="likes">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><span class="text-white"><i
                                                class="mdi mdi-eye-circle me-1"
                                            ></i> {{ number_format($post->views) }}</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <a
                                class="primary-link"
                                href="{{ $post->url }}"
                            >
                                <h3 class="fs-17">{{ $post->name }}</h3>
                            </a>
                            <p class="text-muted">{{ $post->description }}</p>
                            <a
                                class="form-text text-primary"
                                href="{{ $post->url }}"
                                aria-label="{{ __('Read more about :title', ['title' => $post->name]) }}"
                            >{{ __('Read more') }} <i class="mdi mdi-chevron-right align-middle"></i></a>
                        </div>
                    </div><!--end blog-box-->
                </div>
            @endforeach
        </div>
    </div>
</section>
