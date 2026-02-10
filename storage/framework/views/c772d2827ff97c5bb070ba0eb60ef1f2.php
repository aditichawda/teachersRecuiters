<section class="section-box mt-40 mb-0">
    <div class="container position-relative">
        <div class="banner-promotion" <?php if($config['image']): ?> style="background: url(<?php echo e(RvMedia::getImageUrl($config['image'])); ?>) no-repeat top center;" <?php endif; ?>>
            <div class="box-banner-promotion">
                <h3 class="text-head-ads mb-15"><?php echo BaseHelper::clean(Arr::get($config, 'title')); ?></h3>
                <p class="desc-ads"><?php echo BaseHelper::clean(nl2br(Arr::get($config, 'subtitle'))); ?></p>
            </div>
        </div>
        <?php if($config['link']): ?>
            <a href="<?php echo e($config['link']); ?>" class="stretched-link"></a>
        <?php endif; ?>
    </div>
</section>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/////widgets/banner/templates/frontend.blade.php ENDPATH**/ ?>