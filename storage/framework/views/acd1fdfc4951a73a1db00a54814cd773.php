<?php
    $supportedLocales = Language::getSupportedLocales();
    if (! isset($options) || empty($options)) {
        $options = [
            'before' => '',
            'lang_flag' => true,
            'lang_name' => true,
            'class' => '',
            'after' => '',
        ];
    }
?>

<?php if($supportedLocales && count($supportedLocales) > 1): ?>
    <?php
        $languageDisplay = setting('language_display', 'all');
        $showRelated = setting('language_show_default_item_if_current_version_not_existed', true);
    ?>
    <?php if(setting('language_switcher_display', 'dropdown') == 'dropdown'): ?>
        <div class="dropdown nav-item language-switcher-dropdown">
            <?php echo Arr::get($options, 'before'); ?>

            <a type="button" class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownLanguage" aria-expanded="false">
                <span class="text-language">
                    <?php if(Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag')): ?>
                        <?php echo language_flag(Language::getCurrentLocaleFlag(), Language::getCurrentLocaleName()); ?>

                    <?php endif; ?>
                    <?php if(Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name')): ?>
                        <?php echo e(Language::getCurrentLocaleName()); ?>

                    <?php endif; ?>
                    <span class="caret"></span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownLanguage">
                <?php $__currentLoopData = $supportedLocales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($localeCode != Language::getCurrentLocale()): ?>
                        <a href="<?php echo e($showRelated ? Language::getLocalizedURL($localeCode) : url($localeCode)); ?>" class="dropdown-item notify-item language">
                            <?php if(Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag')): ?><?php echo language_flag($properties['lang_flag'], $properties['lang_name']); ?><?php endif; ?>
                            <?php if(Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name')): ?><span class="ms-1"><?php echo e($properties['lang_name']); ?></span><?php endif; ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php echo Arr::get($options, 'after'); ?>

        </div>
    <?php else: ?>
        <?php $__currentLoopData = $supportedLocales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($localeCode != Language::getCurrentLocale()): ?>
                <span class="language-switcher-list">
                    <a class="text-white" href="<?php echo e($showRelated ? Language::getLocalizedURL($localeCode) : url($localeCode)); ?>">
                        <?php if(Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag')): ?><?php echo language_flag($properties['lang_flag'], $properties['lang_name']); ?><?php endif; ?>
                        <?php if(Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name')): ?><span class="ms-1"><?php echo e($properties['lang_name']); ?></span><?php endif; ?>
                    </a>
                </span>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/language-switcher.blade.php ENDPATH**/ ?>