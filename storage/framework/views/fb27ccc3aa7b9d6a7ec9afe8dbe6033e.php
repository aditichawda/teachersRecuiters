<?php
    SeoHelper::setTitle(__('404 - Not found'));
    Theme::fireEventGlobalAssets();
    AdminBar::setIsDisplay(false);
?>

<?php echo Theme::partial('header', ['withoutNavbar' => true]); ?>


<!-- START ERROR -->
<section class="bg-error bg-auth text-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="text-center">
                    <?php if(theme_option('404_page_image')): ?>
                        <img src="<?php echo e(RvMedia::getImageUrl(theme_option('404_page_image'))); ?>" alt="404" class="img-fluid">
                    <?php else: ?>
                        <img src="<?php echo e(Theme::asset()->url('images/404.png')); ?>" alt="404" class="img-fluid">
                    <?php endif; ?>
                    <div class="mt-5">
                        <h4 class="text-uppercase mt-3"><?php echo e(__('Sorry, page not found')); ?></h4>
                        <p class="text-muted"><?php echo e(__('It will be as simple as Occidental in fact, it will be Occidental')); ?></p>
                        <div class="mt-4">
                            <a class="btn btn-primary waves-effect waves-light" href="<?php echo e(BaseHelper::getHomepageUrl()); ?>">
                                <i class="mdi mdi-home"></i>
                                <span><?php echo e(__('Back to Home')); ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END ERROR -->
<?php echo Theme::partial('footer', ['withoutNavbar' => true]); ?>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobcy/views/404.blade.php ENDPATH**/ ?>