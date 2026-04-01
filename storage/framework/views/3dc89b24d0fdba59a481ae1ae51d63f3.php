<div class="offcanvas offcanvas-end" tabindex="-1" id="sidebar-offcanvas" aria-labelledby="sidebar-offcanvasLabel">
    <div class="offcanvas-header border-bottom border-primary">
        <div>
            <a href="<?php echo e(BaseHelper::getHomepageUrl()); ?>">
                <?php echo e(Theme::getLogoImage(['style' => 'max-height: 44px'])); ?>

            </a>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php if($address = theme_option('address')): ?>
            <div class="contact-list">
                <h4><?php echo e(__('Address')); ?></h4>
                <p><?php echo e($address); ?></p>
            </div>
        <?php endif; ?>

        <?php if($hotline = theme_option('hotline')): ?>
            <div class="contact-list">
                <h4><?php echo e(__('Hotline')); ?></h4>
                <p><a href="tel:<?php echo e($hotline); ?>"><?php echo e($hotline); ?></a></p>
            </div>
        <?php endif; ?>

        <?php if($email = theme_option('email')): ?>
            <div class="contact-list">
                <h4><?php echo e(__('Email')); ?></h4>
                <p><a href="mailto:<?php echo e($email); ?>"><?php echo e($email); ?></a></p>
            </div>
        <?php endif; ?>

        <?php echo Theme::partial('language-switcher'); ?>


        <?php echo Theme::partial('currency-switcher'); ?>


        <?php if($socialLinks = Theme::getSocialLinks()): ?>
            <ul class="sidebar-social-icons">
                <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(! $socialLink->getUrl() || ! $socialLink->getIconHtml()) continue; ?>

                    <a <?php echo $socialLink->getAttributes(['class' => '']); ?>><?php echo e($socialLink->getIconHtml()); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/header-top.blade.php ENDPATH**/ ?>