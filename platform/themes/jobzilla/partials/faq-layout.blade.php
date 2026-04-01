{{-- FAQ - Simple Clean Layout --}}
@php
    use Botble\Faq\Models\FaqCategory;
    $categories = FaqCategory::where('status', 'published')
        ->orderBy('order')
        ->with(['faqs' => function($q) { $q->where('status', 'published'); }])
        ->get();
@endphp

<style>
.faq-section {
    padding: 100px 0 80px;
    background: #fff;
}
.faq-header {
    text-align: center;
    margin-bottom: 45px;
}
.faq-header h1 {
    font-size: 32px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 10px;
}
.faq-header p {
    font-size: 15px;
    color: #94a3b8;
    max-width: 500px;
    margin: 0 auto;
}
/* Category Tabs */
.faq-tabs {
    display: flex;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 40px;
}
.faq-tab-btn {
    padding: 10px 24px;
    border: 1px solid #e2e8f0;
    background: #fff;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 500;
    color: #64748b;
    cursor: pointer;
    transition: all .25s ease;
}
.faq-tab-btn:hover {
    border-color: var(--primary-color, #1967d2);
    color: var(--primary-color, #1967d2);
}
.faq-tab-btn.active {
    background: var(--primary-color, #1967d2);
    border-color: var(--primary-color, #1967d2);
    color: #fff;
}
/* FAQ Items */
.faq-list {
    max-width: 800px;
    margin: 0 auto;
}
.faq-item {
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    margin-bottom: 12px;
    overflow: hidden;
    transition: all .25s;
}
.faq-item:hover {
    border-color: #cbd5e1;
}
.faq-question {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 22px;
    background: #fff;
    border: none;
    cursor: pointer;
    text-align: left;
    font-size: 15px;
    font-weight: 600;
    color: #1e293b;
    gap: 15px;
    transition: all .2s;
}
.faq-question:hover {
    background: #f8fafc;
}
.faq-question .faq-icon {
    flex-shrink: 0;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    color: #64748b;
    transition: all .3s;
}
.faq-question:not(.collapsed) .faq-icon {
    background: var(--primary-color, #1967d2);
    color: #fff;
    transform: rotate(45deg);
}
.faq-answer {
    padding: 0 22px 20px;
    font-size: 14px;
    color: #475569;
    line-height: 1.8;
}
/* Contact box */
.faq-contact {
    text-align: center;
    margin-top: 50px;
    padding: 30px;
    background: #f8fafc;
    border-radius: 12px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}
.faq-contact h3 {
    font-size: 18px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 8px;
}
.faq-contact p {
    font-size: 14px;
    color: #64748b;
    margin-bottom: 15px;
}
.faq-contact a {
    display: inline-block;
    padding: 10px 28px;
    background: var(--primary-color, #1967d2);
    color: #fff;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all .25s;
}
.faq-contact a:hover {
    opacity: .9;
    transform: translateY(-2px);
    color: #fff;
}
@media(max-width: 768px) {
    .faq-section { padding: 80px 15px 50px; }
    .faq-header { margin-bottom: 30px; }
    .faq-header h1 { font-size: 24px; }
    .faq-header p { font-size: 13px; }
    .faq-tabs { gap: 8px; margin-bottom: 25px; }
    .faq-tab-btn { padding: 8px 16px; font-size: 13px; }
    .faq-question { padding: 14px 16px; font-size: 14px; }
    .faq-answer { padding: 0 16px 16px; font-size: 13px; }
    .faq-contact { padding: 22px 15px; margin-top: 35px; }
    .faq-contact h3 { font-size: 16px; }
    .faq-contact p { font-size: 13px; }
}
@media(max-width: 480px) {
    .faq-section { padding: 70px 10px 40px; }
    .faq-header h1 { font-size: 22px; }
    .faq-tabs { gap: 6px; }
    .faq-tab-btn { padding: 7px 14px; font-size: 12px; }
    .faq-question { padding: 12px 14px; font-size: 13px; gap: 10px; }
    .faq-question .faq-icon { width: 24px; height: 24px; font-size: 12px; }
    .faq-answer { padding: 0 14px 14px; font-size: 12.5px; }
}
</style>

<section class="faq-section">
    <div class="container">
        <div class="faq-header">
            <h1>Frequently Asked Questions</h1>
            <p>Find answers to common questions about Teachers Recruiter</p>
        </div>

        @if($categories->count())
            {{-- Category Tabs --}}
            <div class="faq-tabs">
                @foreach($categories as $category)
                    <button class="faq-tab-btn {{ $loop->first ? 'active' : '' }}" 
                        data-target="faq-cat-{{ $category->id }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            {{-- FAQ Content --}}
            <div class="faq-list">
                @foreach($categories as $category)
                    <div class="faq-cat-content {{ $loop->first ? '' : 'd-none' }}" id="faq-cat-{{ $category->id }}">
                        <div class="accordion" id="faq-accordion-{{ $category->id }}">
                            @foreach($category->faqs as $faq)
                                <div class="faq-item">
                                    <button class="faq-question {{ $loop->first ? '' : 'collapsed' }}" 
                                        type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#faq-a-{{ $category->id }}-{{ $loop->iteration }}"
                                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                        <span>{{ $faq->question }}</span>
                                        <span class="faq-icon">+</span>
                                    </button>
                                    <div id="faq-a-{{ $category->id }}-{{ $loop->iteration }}" 
                                        class="collapse {{ $loop->first ? 'show' : '' }}"
                                        data-bs-parent="#faq-accordion-{{ $category->id }}">
                                        <div class="faq-answer">
                                            {!! BaseHelper::clean($faq->answer) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="faq-contact">
            <h3>Still have questions?</h3>
            <p>Can't find what you're looking for? Feel free to reach out to our support team.</p>
            <a href="/contact">Contact Us</a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.faq-tab-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            // Update active tab
            document.querySelectorAll('.faq-tab-btn').forEach(function(b) { b.classList.remove('active'); });
            this.classList.add('active');
            // Show/hide content
            document.querySelectorAll('.faq-cat-content').forEach(function(c) { c.classList.add('d-none'); });
            document.getElementById(this.getAttribute('data-target')).classList.remove('d-none');
        });
    });
});
</script>
