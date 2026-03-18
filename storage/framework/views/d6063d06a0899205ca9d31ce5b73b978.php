<?php
    $title = Theme::get('pageTitle') ?: SeoHelper::getTitle();
    $titleLower = strtolower($title);
    $hideTitle = in_array($titleLower, ['contact', 'contact us']);
    $hideBreadcrumb = in_array($titleLower, ['contact', 'contact us', 'about us', 'about-us']);
    
    // Hide entire banner for About Us, How It Works, and Contact Us pages
    $hideEntireBanner = in_array($titleLower, ['about us', 'about-us', 'how it works', 'how-it-works', 'contact', 'contact us', 'jobs', 'companies','candidates']);
?>

<?php if (! ($hideEntireBanner)): ?>
<div
    class="wt-bnr-inr overlay-wraper bg-center"
    <?php if(Theme::get('pageCoverImage')): ?>
        style="background-image:url('<?php echo e(RvMedia::getImageUrl(Theme::get('pageCoverImage'))); ?>');"
    <?php endif; ?>
>
    <div class="overlay-main site-bg-white opacity-01"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <div class="banner-title-outer">
                <div class="banner-title-name">
                    <?php if (! ($hideTitle)): ?>
                        <h2 class="wt-title"><?php echo e($title); ?></h2>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (! ($hideBreadcrumb)): ?>
                <?php echo Theme::partial('breadcrumbs'); ?>

            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/page-header.blade.php ENDPATH**/ ?>