<style>
    [v-cloak],
    [x-cloak] {
        display: none;
    }
</style>

<?php echo BaseHelper::googleFonts('https://fonts.googleapis.com/' . sprintf(
        'css2?family=%s:wght@300;400;500;600;700&display=swap',
        urlencode(theme_option('primary_font', 'Inter')),
)); ?>


<style>
    :root {
        --primary-font: "<?php echo e(theme_option('primary_font', 'Inter')); ?>";
        --primary-color: <?php echo e($primaryColor = theme_option('primary_color', '#206bc4')); ?>;
        --primary-color-rgb: <?php echo e(implode(', ', BaseHelper::hexToRgb($primaryColor))); ?>;
        --secondary-color: <?php echo e($secondaryColor = '#6c7a91'); ?>;
        --secondary-color-rgb: <?php echo e(implode(', ', BaseHelper::hexToRgb($secondaryColor))); ?>;
        --heading-color: inherit;
        --text-color: <?php echo e($textColor = '#182433'); ?>;
        --text-color-rgb: <?php echo e(implode(', ', BaseHelper::hexToRgb($textColor))); ?>;
        --link-color: <?php echo e($linkColor = '#206bc4'); ?>;
        --link-color-rgb: <?php echo e(implode(', ', BaseHelper::hexToRgb($linkColor))); ?>;
        --link-hover-color: <?php echo e($linkHoverColor = '#206bc4'); ?>;
        --link-hover-color-rgb: <?php echo e(implode(', ', BaseHelper::hexToRgb($linkHoverColor))); ?>;
    }
</style>

<?php echo Assets::renderHeader(['core']); ?>

<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/themes/dashboard/layouts/header-meta.blade.php ENDPATH**/ ?>