<?php
    SeoHelper::setTitle(__('404 - Not found'));
    Theme::fireEventGlobalAssets();
?>

<?php echo Theme::partial('header'); ?>


<div class="section-full p-t120  p-b90 site-bg-white">
    <div class="container">
        <div class="twm-error-wrap">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="twm-error-image">
                        <img src="<?php echo e(theme_option('404_page_image') ? RvMedia::getImageUrl(theme_option('404_page_image')) :Theme::asset()->url('images/error-404.png')); ?>"
                            alt="<?php echo e(theme_option('site_title')); ?>">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="twm-error-content">
                        <h2 class="twm-error-title"><?php echo e(__('404')); ?></h2>
                        <h4 class="twm-error-title2 site-text-primary"><?php echo e(__('We Are Sorry, Page Not Found')); ?></h4>
                        <p><?php echo e(__('The page you are looking for might have been removed had its name changed or is temporarily unavailable.')); ?></p>
                        <a href="<?php echo e(BaseHelper::getHomepageUrl()); ?>" class="site-button"><?php echo e(__('Go To Home')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo Theme::partial('footer'); ?>

<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/404.blade.php ENDPATH**/ ?>