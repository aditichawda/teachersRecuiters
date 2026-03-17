<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<?php echo Theme::header(); ?>


<style>
    :root {
        --primary-color: <?php echo e(theme_option('primary_color', '#1967d2')); ?>;
        --primary-color-dark: <?php echo e(theme_option('primary_color_dark', '#f51b18')); ?>;
        --top-header-background-color: <?php echo e(theme_option('top_header_background_color', '#f8f9fc')); ?>;
        --top-header-text-color: <?php echo e(theme_option('top_header_text_color', '#495057')); ?>;
        --main-header-background-color: <?php echo e(theme_option('main_header_background_color', 'transparent')); ?>;
        --main-header-text-color: <?php echo e(theme_option('main_header_text_color', '#2f2f2f')); ?>;
        --main-header-border-color: <?php echo e(theme_option('main_header_border_color', 'transparent')); ?>;
    }
</style>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/header-meta.blade.php ENDPATH**/ ?>