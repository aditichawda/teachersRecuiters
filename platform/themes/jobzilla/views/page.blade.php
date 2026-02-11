@php
    $page->loadMissing('metadata');
    Theme::set('header_css_class', $page->getMetaData('header_css_class', true) ?: '');
    Theme::set('pageCoverImage', $page->getMetaData('background_breadcrumb', true) ?: theme_option('background_breadcrumb_default'));
    
    $isAboutPage = $page->slug == 'about-us';
    $isHowItWorksPage = $page->slug == 'how-it-works';
    $isContactPage = $page->slug == 'contact' || $page->slug == 'contact-us';
    $isTermsPage = $page->slug == 'terms' || $page->slug == 'terms-and-conditions' || $page->slug == 'terms-conditions';
    $isPrivacyPage = $page->slug == 'privacy-policy' || $page->slug == 'privacy';
    $isFraudPage = $page->slug == 'fraud-alert' || $page->slug == 'fraud';
    $isFaqPage = $page->slug == 'faq';
    
    // Hide banner for special pages
    if ($isAboutPage) {
        Theme::set('withPageHeader', false);
        Theme::set('bodyClass', 'hide-page-banner about-us-page');
    } elseif ($isHowItWorksPage) {
        Theme::set('withPageHeader', false);
        Theme::set('bodyClass', 'hide-page-banner how-it-works-page');
    } elseif ($isContactPage) {
        Theme::set('withPageHeader', false);
        Theme::set('bodyClass', 'hide-page-banner contact-us-page');
    } elseif ($isTermsPage) {
        Theme::set('withPageHeader', false);
        Theme::set('bodyClass', 'hide-page-banner terms-page');
    } elseif ($isPrivacyPage) {
        Theme::set('withPageHeader', false);
        Theme::set('bodyClass', 'hide-page-banner privacy-page');
    } elseif ($isFraudPage) {
        Theme::set('withPageHeader', false);
        Theme::set('bodyClass', 'hide-page-banner fraud-page');
    } elseif ($isFaqPage) {
        Theme::set('withPageHeader', false);
        Theme::set('bodyClass', 'hide-page-banner faq-page');
    }
@endphp

<div class="page-content-wrapper {{ $isHowItWorksPage ? 'how-it-works-page' : '' }} {{ $isAboutPage ? 'about-page' : '' }} {{ $isTermsPage ? 'terms-page' : '' }} {{ $isPrivacyPage ? 'privacy-page' : '' }} {{ $isFraudPage ? 'fraud-page' : '' }}">
    @if ($isAboutPage)
        {{-- About Us Layout (CSS in partial, content from admin) --}}
        {!! Theme::partial('about-us-layout', ['page' => $page]) !!}
    @elseif ($isHowItWorksPage)
        {{-- How It Works Layout (CSS in partial, content from admin) --}}
        {!! Theme::partial('how-it-works-layout', ['page' => $page]) !!}
    @elseif ($isTermsPage)
        {{-- Terms & Conditions Layout (CSS in partial, content from admin) --}}
        {!! Theme::partial('terms-layout', ['page' => $page]) !!}
    @elseif ($isPrivacyPage)
        {{-- Privacy Policy Layout (CSS in partial, content from admin) --}}
        {!! Theme::partial('privacy-layout', ['page' => $page]) !!}
    @elseif ($isFraudPage)
        {{-- Fraud Alert Layout --}}
        {!! Theme::partial('fraud-alert-layout', ['page' => $page]) !!}
    @elseif ($isFaqPage)
        {{-- FAQ Layout (CSS in partial, FAQs from DB) --}}
        {!! Theme::partial('faq-layout', ['page' => $page]) !!}
    @else
        {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, Html::tag('div', BaseHelper::clean($page->content), ['class' => 'ck-content'])->toHtml(), $page) !!}
    @endif
</div>