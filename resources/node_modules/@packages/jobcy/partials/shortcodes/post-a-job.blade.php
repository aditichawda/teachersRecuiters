<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="text-center">
                    <h2 class="text-primary mb-4">{!! BaseHelper::clean(
                        str_replace(
                            $shortcode->highlight_text,
                            '<span class="text-warning fw-bold">' . $shortcode->highlight_text . '</span>',
                            $shortcode->title,
                        ),
                    ) !!}</h2>
                    <p class="text-muted">{!! BaseHelper::clean($shortcode->subtitle) !!}</p>
                    <div class="mt-4 pt-2">
                        <a
                            class="btn btn-primary btn-hover"
                            href="{{ auth('account')->check() ? route('public.account.jobs.create') : (JobBoardHelper::isRegisterEnabled() ? route('public.account.register') : route('public.account.login')) }}"
                        >{{ $shortcode->button_text ?: __('Started Now') }} <i
                                class="uil uil-rocket align-middle ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
