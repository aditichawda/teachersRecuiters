<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <h2 class="title">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                    <p class="text-muted">{!! BaseHelper::clean($shortcode->subtitle) !!}</p>
                </div>
            </div>
        </div>

        <div
            class="row featured-job-categories-container"
            data-ajax-url="{{ route('public.ajax.featured-job-categories') }}"
            data-show-jobs-count="{{ $shortcode->show_jobs_count ?? 'yes' }}"
            data-limit="{{ $shortcode->limit ?? 8 }}"
            data-loaded="false"
        >
            @if (! request()->ajax() && $shortcode->enable_lazy_loading != 'yes')
                <div class="skeleton-loading">
                    <div class="row">
                        @for($i = 0; $i < 8; $i++)
                            <div class="col-lg-3 col-md-6 mt-4 pt-2">
                                <div class="popu-category-box rounded text-center">
                                    <div class="popu-category-icon icons-md">
                                        <div class="skeleton skeleton-image mx-auto" style="width: 64px; height: 64px; border-radius: 8px;"></div>
                                    </div>
                                    <div class="popu-category-content mt-4">
                                        <div class="skeleton skeleton-text mx-auto mb-2" style="height: 20px; width: 60%;"></div>
                                        <div class="skeleton skeleton-text mx-auto" style="height: 16px; width: 40%;"></div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            @else
                {!! Theme::partial('shortcodes.includes.featured-job-categories-list', compact('categories')) !!}
            @endif
        </div>
    </div>
</section>
