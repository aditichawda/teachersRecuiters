<?php echo Theme::partial('header'); ?>


<main class="main-content" id="main-content">
    <div class="page-content" id="app">
        <?php if(Theme::get('withPageHeader', true)): ?>
            <?php echo Theme::partial('page-header'); ?>

        <?php endif; ?>
        <?php echo Theme::content(); ?>

    </div>
</main>

<?php echo Theme::partial('footer'); ?>

<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobcy/layouts/default.blade.php ENDPATH**/ ?>