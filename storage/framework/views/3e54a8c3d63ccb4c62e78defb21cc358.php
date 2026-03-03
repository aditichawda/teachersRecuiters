<div class="col-lg-4">
    <div class="footer-item mt-4 mt-lg-0 me-lg-5">
        <span class="text-white mb-4 h4 d-inline-block"><?php echo BaseHelper::clean($config['name']); ?></span>
        <p class="text-white-50"><?php echo BaseHelper::clean($config['about']); ?></p>
        <?php if(Arr::get($config, 'show_social_links', true) && ($socialLinks = Theme::getSocialLinks())): ?>
            <p class="text-white mt-3"><?php echo BaseHelper::clean($config['follow_us_heading']); ?></p>
            <ul class="footer-social-menu list-inline mb-0">
                <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(! $socialLink->getUrl() || ! $socialLink->getIconHtml()) continue; ?>

                    <li class="list-inline-item">
                        <a <?php echo $socialLink->getAttributes(['title' => $socialLink->getName()]); ?>>
                            <?php echo $socialLink->getIconHtml(); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobcy/////widgets/site-info/templates/frontend.blade.php ENDPATH**/ ?>