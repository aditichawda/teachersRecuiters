<?php
    $helpBlock = \Illuminate\Support\Arr::get($options, 'help_block', []);
    $isChild = \Illuminate\Support\Arr::get($options, 'is_child', false);
?>
<?php if(\Illuminate\Support\Arr::get($helpBlock, 'text') && !$isChild): ?>
    <<?php echo e(\Illuminate\Support\Arr::get($helpBlock, 'tag', 'p')); ?> <?php echo \Illuminate\Support\Arr::get($helpBlock, 'helpBlockAttrs', ''); ?>>
        <?php echo $helpBlock['text']; ?>

    </<?php echo e(\Illuminate\Support\Arr::get($helpBlock, 'tag', 'p')); ?>>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/core/base/resources/views/forms/partials/help-block.blade.php ENDPATH**/ ?>