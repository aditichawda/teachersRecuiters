<?php
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
?>

<div class="page-content-wrapper <?php echo e($isHowItWorksPage ? 'how-it-works-page' : ''); ?> <?php echo e($isAboutPage ? 'about-page' : ''); ?> <?php echo e($isTermsPage ? 'terms-page' : ''); ?> <?php echo e($isPrivacyPage ? 'privacy-page' : ''); ?> <?php echo e($isFraudPage ? 'fraud-page' : ''); ?>">
    <?php if($isAboutPage): ?>
        
        <?php echo Theme::partial('about-us-layout', ['page' => $page]); ?>

    <?php elseif($isHowItWorksPage): ?>
        
        <?php echo Theme::partial('how-it-works-layout', ['page' => $page]); ?>

    <?php elseif($isTermsPage): ?>
        
        <?php echo Theme::partial('terms-layout', ['page' => $page]); ?>

    <?php elseif($isPrivacyPage): ?>
        
        <?php echo Theme::partial('privacy-layout', ['page' => $page]); ?>

    <?php elseif($isFraudPage): ?>
        
        <?php echo Theme::partial('fraud-alert-layout', ['page' => $page]); ?>

    <?php elseif($isFaqPage): ?>
        
        <?php echo Theme::partial('faq-layout', ['page' => $page]); ?>

    <?php else: ?>
        <?php echo apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, Html::tag('div', BaseHelper::clean($page->content), ['class' => 'ck-content'])->toHtml(), $page); ?>

    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/page.blade.php ENDPATH**/ ?>