<?php
    $style = in_array($shortcode->style, ['style-1', 'style-2', 'style-3', 'style-4', 'style-5','style-6']) ? $shortcode->style : 'style-1';
?>

<?php echo Theme::partial('shortcodes.featured-categories.' . $style, compact('shortcode', 'categories')); ?>

<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/shortcodes/featured-categories/index.blade.php ENDPATH**/ ?>