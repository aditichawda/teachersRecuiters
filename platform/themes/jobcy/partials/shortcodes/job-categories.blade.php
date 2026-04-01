<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="text-center mb-5">
                    @if ($shortcode->badge)
                        <p class="badge bg-warning fs-14 mb-2">{!! BaseHelper::clean($shortcode->badge) !!}</p>
                    @endif
                    <h2 class="h4">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                    <p class="text-muted">{!! BaseHelper::clean($shortcode->subtitle) !!}</p>
                </div>
            </div>
        </div>
        <div
            class="row job-categories-container"
            data-ajax-url="{{ route('public.ajax.job-categories-list') }}"
            data-show-jobs-count="{{ $shortcode->show_jobs_count ?? 'yes' }}"
            data-loaded="false"
        >
            @if (! request()->ajax() && $shortcode->enable_lazy_loading != 'yes')
                <div class="skeleton-loading">
                    <div class="row">
                        @for($i = 0; $i < 3; $i++)
                            <div class="col-lg-4">
                                <div class="card job-Categories-box bg-light border-0">
                                    <div class="card-body p-4">
                                        <ul class="list-unstyled job-Categories-list mb-0">
                                            @for($j = 0; $j < 8; $j++)
                                                <li class="mb-3">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="skeleton skeleton-text" style="height: 16px; width: 70%;"></div>
                                                        <div class="skeleton skeleton-badge" style="height: 20px; width: 40px; border-radius: 12px;"></div>
                                                    </div>
                                                </li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            @else
                {!! Theme::partial('shortcodes.includes.job-categories-list', compact('categories')) !!}
            @endif
        </div>
    </div>
</section>
