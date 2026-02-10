<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="section-title me-5">
                    <h2 class="title">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                    <p class="text-muted">{!! BaseHelper::clean($shortcode->subtitle) !!}</p>
                    <div
                        class="process-menu nav flex-column nav-pills"
                        id="v-pills-{{ ($tabId = strtolower(Str::random(20))) }}-tab"
                        role="tablist"
                        aria-orientation="vertical"
                    >
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($shortcode->{'step_' . $i . '_title'} && $shortcode->{'step_' . $i . '_description'})
                                <a
                                    class="nav-link @if ($i == 1) active @endif"
                                    id="v-pills-{{ $tabId }}-home-tab-{{ $i }}"
                                    data-bs-toggle="pill"
                                    href="#v-pills-{{ $tabId }}-home-{{ $i }}"
                                    role="tab"
                                    aria-controls="v-pills-{{ $tabId }}-home-{{ $i }}"
                                    aria-selected="true"
                                >
                                    <div class="d-flex">
                                        <div class="number flex-shrink-0">
                                            {{ $i }}
                                        </div>
                                        <div class="flex-grow-1 text-start ms-3">
                                            <h3 class="fs-18">{!! BaseHelper::clean($shortcode->{'step_' . $i . '_title'}) !!}</h3>
                                            <p class="text-muted mb-0">{!! BaseHelper::clean($shortcode->{'step_' . $i . '_description'}) !!}</p>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div
                    class="tab-content"
                    id="v-pills-{{ $tabId }}-tabContent"
                >
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($shortcode->{'step_' . $i . '_image'})
                            <div
                                class="tab-pane fade @if ($i == 1) show active @endif"
                                id="v-pills-{{ $tabId }}-home-{{ $i }}"
                                role="tabpanel"
                                aria-labelledby="v-pills-{{ $tabId }}-home-tab-{{ $i }}"
                            >
                                <img
                                    class="img-fluid"
                                    src="{{ RvMedia::getImageUrl($shortcode->{'step_' . $i . '_image'}) }}"
                                    alt="image"
                                >
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>
