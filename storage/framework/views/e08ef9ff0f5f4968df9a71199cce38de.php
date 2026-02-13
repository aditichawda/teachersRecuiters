<div class="login-options">
    <div class="login-options-title">
        <p><?php echo e(trans('plugins/social-login::social-login.login_with_social_networks')); ?></p>
    </div>

    <?php if(setting('social_login_style', 'default') === 'basic'): ?>
        <ul class="social-login-basic">
            <?php $__currentLoopData = SocialService::getProviderKeys(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!SocialService::getProviderEnabled($item)) continue; ?>

                <?php if($item === 'google' && setting('social_login_google_use_google_button', false) && false): ?>
                    <?php echo $__env->make('plugins/social-login::google-sign-in-button', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php continue; ?>
                <?php endif; ?>

                <li>
                    <a
                        href="<?php echo e(route('auth.social', array_merge([$item], $params))); ?>"
                        class="social-login <?php echo e($item); ?>-login"
                    >
                        <?php
                            $iconName = $item === 'linkedin-openid' ? 'linkedin' : $item;
                        ?>

                        <img
                            src="<?php echo e(asset('vendor/core/plugins/social-login/images/icons/logo-' . $iconName . '.svg')); ?>"
                            alt="<?php echo e(Str::ucfirst($item)); ?>"
                        />
                        <span><?php echo e(trans('plugins/social-login::social-login.sign_in_with', ['provider' => trans('plugins/social-login::social-login.socials.' . $item)])); ?></span>
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php else: ?>
        <ul class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'social-icons',
            'social-login-lg' => setting('social_login_style', 'default') === 'default',
        ]); ?>">
            <?php $__currentLoopData = SocialService::getProviderKeys(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!SocialService::getProviderEnabled($item)) continue; ?>

                <?php if($item === 'google' && setting('social_login_google_use_google_button', false) && false): ?>
                    <?php echo $__env->make('plugins/social-login::google-sign-in-button', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php continue; ?>
                <?php endif; ?>

                <?php echo apply_filters(
                    'social_login_' . $item . '_render',
                    view('plugins/social-login::social-login-item', [
                        'social' => $item,
                        'url' => route('auth.social', isset($params) ? array_merge([$item], $params) : $item),
                    ])->render(),
                    $item,
                ); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\social-login\/resources/views/login-options.blade.php ENDPATH**/ ?>