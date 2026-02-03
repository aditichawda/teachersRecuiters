<!-- FAQ START -->
<div class="section-full p-t120 p-b90 site-bg-white">
    <div class="container">
        <div class="section-content">
            <div class="twm-tabs-style-1 center">
                <ul class="nav nav-tabs" role="tablist">
                    @foreach($categories as $category)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if ($loop->first) active @endif" id="faq-tab-{{ $loop->iteration }}" data-bs-toggle="tab"
                                data-bs-target="#faq-content-{{ $loop->iteration }}" type="button" role="tab" aria-controls="faq-content-{{ $loop->iteration }}"
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $category->name }}</button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach($categories as $category)
                        <div class="tab-pane fade @if ($loop->first) show active @endif" id="faq-content-{{ $loop->iteration }}"
                            role="tabpanel" aria-labelledby="faq-tab-{{ $loop->iteration }}">
                            <div class="tw-faq-section">
                                <div class="accordion tw-faq" id="faq-parent-{{ $category->id . '-' . $loop->iteration }}">
                                    @foreach($category->faqs as $faq)
                                        <div class="accordion-item">
                                            <button class="accordion-button @if (! $loop->first) collapsed @endif" type="button" data-bs-toggle="collapse"
                                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}" data-bs-target="#faq-answer-content-{{ $category->id . '-' . $loop->iteration }}">
                                                {{ $faq->question }}
                                            </button>
        
                                            <div id="faq-answer-content-{{ $category->id . '-' . $loop->iteration }}" class="accordion-collapse collapse @if ($loop->first) show @endif"
                                                data-bs-parent="#faq-parent-{{ $category->id . '-' . $loop->iteration }}">
                                                <div class="accordion-body">
                                                    {!! BaseHelper::clean($faq->answer) !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FAQ END -->
