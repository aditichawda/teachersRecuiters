<?php echo Theme::partial('header'); ?>


<?php if(Theme::get('withPageHeader', true)): ?>
    <?php echo Theme::partial('page-header'); ?>

<?php endif; ?>

<?php echo Theme::content(); ?>


<?php echo Theme::partial('footer'); ?>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/layouts/static.blade.php ENDPATH**/ ?>