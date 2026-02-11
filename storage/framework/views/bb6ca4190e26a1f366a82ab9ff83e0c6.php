<?php
    $page = $category;
    $type = 'category';
?>

<?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.job-page'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/job-board/job-category.blade.php ENDPATH**/ ?>