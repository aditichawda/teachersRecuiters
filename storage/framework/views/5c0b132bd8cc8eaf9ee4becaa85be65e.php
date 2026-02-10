<?php
    $page->loadMissing('metadata');
    Theme::set('header_css_class', $page->getMetaData('header_css_class', true) ?: '');
    Theme::set('pageCoverImage', $page->getMetaData('background_breadcrumb', true) ?: theme_option('background_breadcrumb_default'));
    
    $isAboutPage = $page->slug == 'about-us';
    $isHowItWorksPage = $page->slug == 'how-it-works';
    $isContactPage = $page->slug == 'contact' || $page->slug == 'contact-us';
    
    // Hide banner for About Us, How It Works, and Contact Us pages
    if ($isAboutPage) {
        Theme::set('withPageHeader', false);
        Theme::set('bodyClass', 'hide-page-banner about-us-page');
    } elseif ($isHowItWorksPage) {
        Theme::set('withPageHeader', false);
        Theme::set('bodyClass', 'hide-page-banner how-it-works-page');
    } elseif ($isContactPage) {
        Theme::set('withPageHeader', false);
        Theme::set('bodyClass', 'hide-page-banner contact-us-page');
    }
?>

<div class="page-content-wrapper <?php echo e($isHowItWorksPage ? 'how-it-works-page' : ''); ?> <?php echo e($isAboutPage ? 'about-page' : ''); ?>">
    <?php if($isAboutPage): ?>
        
        <?php echo Theme::partial('about-us-layout'); ?>

    <?php elseif($isHowItWorksPage): ?>
        
        <?php echo Theme::partial('how-it-works-layout'); ?>

    <?php else: ?>
        <?php echo apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, Html::tag('div', BaseHelper::clean($page->content), ['class' => 'ck-content'])->toHtml(), $page); ?>

    <?php endif; ?>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/page.blade.php ENDPATH**/ ?>