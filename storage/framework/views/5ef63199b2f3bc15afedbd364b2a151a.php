<div class="twm-home3-banner-section site-bg-white bg-cover"
    <?php if($shortcode->bg_image_1): ?> style="background-image: url(<?php echo e(RvMedia::getImageUrl($shortcode->bg_image_1)); ?>)" <?php endif; ?>>
    <div class="twm-home3-inner-section">
        <div class="twm-bnr-mid-section">
            <div class="twm-bnr-title-large"><?php echo BaseHelper::clean($shortcode->title); ?></div>
            <div class="twm-bnr-title-light"><?php echo BaseHelper::clean($shortcode->subtitle); ?></div>
            <div class="twm-bnr-discription"><?php echo BaseHelper::clean($shortcode->description); ?></div>

            <?php if(is_plugin_active('job-board')): ?>
                <?php echo Theme::partial('shortcodes.search-bar.form'); ?>

                <?php echo Theme::partial('shortcodes.search-bar.popular-search', ['popular_searches' => $shortcode->popular_searches]); ?>

            <?php endif; ?>

            <?php if($shortcode->button_url): ?>
                    <?php
                        $buttonUrl = $shortcode->button_url;
                        if (auth('account')->check()) {
                            $account = auth('account')->user();
                            if ($account->isEmployer()) {
                                $buttonUrl = route('public.account.dashboard');
                            } else {
                                $buttonUrl = route('public.account.jobseeker.dashboard');
                            }
                        } else {
                            $buttonUrl = route('public.account.register');
                        }
                    ?>
                    <a href="<?php echo e($buttonUrl); ?>" class="site-button"><?php echo e($shortcode->button_name ?: __('Get Started')); ?></a>
                <?php endif; ?>
        </div>
        <!-- <div class="twm-bnr-bottom-section">
            <?php if($shortcode->gradient_text): ?>
                <div class="twm-browse-jobs"><?php echo e($shortcode->gradient_text); ?></div>
            <?php endif; ?>
            <div class="twm-bnr-blocks-wrap">
                <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="twm-bnr-blocks twm-bnr-blocks-position-<?php echo e($loop->iteration); ?>">
                        <?php if($img = Arr::get($tab, 'image')): ?>
                            <div class="twm-icon">
                                <img src="<?php echo e(RvMedia::getImageUrl($img)); ?>" alt="<?php echo e(Arr::get($tab, 'title')); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="twm-content">
                            <div class="tw-count-number text-clr-<?php echo e(Arr::random(['pink', 'yellow', 'green'])); ?>">
                                <span class="counter"><?php echo e(Arr::get($tab, 'count')); ?></span><?php echo e(Arr::get($tab, 'extra')); ?>

                            </div>
                            <p class="icon-content-info"><?php echo e(Arr::get($tab, 'title')); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div> -->
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/shortcodes/hero-banner/style-3.blade.php ENDPATH**/ ?>