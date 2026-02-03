<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <ul
                    class="faq-menu nav nav-fill nav-pills justify-content-center"
                    id="pills-tab"
                    role="tablist"
                >
                    @foreach ($categories as $category)
                        <li
                            class="nav-item"
                            role="presentation"
                        >
                            <button
                                class="nav-link @if ($loop->first) active @endif"
                                id="faq-tab-{{ $loop->iteration }}"
                                data-bs-toggle="pill"
                                data-bs-target="#faq-content-{{ $loop->iteration }}"
                                type="button"
                                role="tab"
                                aria-controls="faq-content-{{ $loop->iteration }}"
                                aria-selected="true"
                            >{{ $category->name }}</button>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>

        <div class="row align-items-center mt-5">
            <div class="col-lg-12">
                <div
                    class="tab-content"
                    id="pills-tabContent"
                >
                    @foreach ($categories as $k1 => $category)
                        <div
                            class="tab-pane fade @if ($loop->first) show active @endif"
                            id="faq-content-{{ $loop->iteration }}"
                            role="tabpanel"
                            aria-labelledby="faq-tab-{{ $loop->iteration }}"
                        >
                            <div class="row">
                                @foreach ($category->faqs->chunk(ceil($category->faqs->count() / 2)) as $k2 => $faqs)
                                    <div class="col-lg-6">
                                        <div
                                            class="accordion accordion-flush faq-box"
                                            id="faq-parent-{{ $k1 }}-{{ $k2 }}-{{ $loop->parent->iteration }}"
                                        >
                                            @foreach ($faqs as $faq)
                                                <div class="accordion-item mt-4 border-0">
                                                    <h2
                                                        class="accordion-header"
                                                        id="faq-answer-{{ $k1 }}-{{ $k2 }}-{{ $loop->iteration }}"
                                                    >
                                                        <button
                                                            class="accordion-button @if (!$loop->first) collapsed @endif"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#faq-answer-content-{{ $k1 }}-{{ $k2 }}-{{ $loop->iteration }}"
                                                            type="button"
                                                            aria-controls="faq-answer-content-{{ $k1 }}-{{ $k2 }}-{{ $loop->iteration }}"
                                                            @if ($loop->first) aria-expanded="true" @else aria-expanded="false" @endif
                                                        >
                                                            {{ $faq->question }}
                                                        </button>
                                                    </h2>
                                                    <div
                                                        class="accordion-collapse collapse @if ($loop->first) show @endif"
                                                        id="faq-answer-content-{{ $k1 }}-{{ $k2 }}-{{ $loop->iteration }}"
                                                        data-bs-parent="#faq-parent-{{ $k1 }}-{{ $k2 }}-{{ $loop->parent->parent->iteration }}"
                                                        aria-labelledby="faq-answer-{{ $k1 }}-{{ $k2 }}-{{ $loop->iteration }}"
                                                    >
                                                        <div class="accordion-body">
                                                            {!! BaseHelper::clean($faq->answer) !!}
                                                        </div>
                                                    </div>
                                                </div><!--end accordion-item-->
                                            @endforeach
                                        </div><!--end accordion-->
                                    </div>
                                @endforeach
                            </div>
                        </div><!--end general-tab-->
                    @endforeach
                </div>
            </div>
            <div class="col-lg-12">
                <div class="text-center mt-5">
                    @if ($shortcode->show_hotline !== 'no' && ($hotline = theme_option('hotline')))
                        <a
                            class="btn btn-primary btn-hover mt-2 faq-hotline-button"
                            href="tel:{{ $hotline }}"
                        >
                            <i class="uil uil-phone"></i>
                            <span>{{ __('Contact Us') }}</span>
                        </a>
                    @endif
                    @if ($shortcode->show_email !== 'no' && ($email = theme_option('email')))
                        <a
                            class="btn btn-warning btn-hover mt-2 ms-md-2 faq-email-button"
                            href="mailto:{{ $email }}"
                        >
                            <i class="uil uil-envelope"></i>
                            <span>{{ __('Email Now') }}</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
