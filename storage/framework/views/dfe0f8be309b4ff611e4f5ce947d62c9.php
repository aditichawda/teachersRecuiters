<?php
    Theme::asset()->usePath()->add('leaflet-css', 'plugins/leaflet/leaflet.css');
    Theme::asset()->container('footer')->usePath()->add('leaflet-js', 'plugins/leaflet/leaflet.js');
    Theme::set('pageTitle', $job->name);
    $layout = $job->getMetadata('layout', true);
    if (! in_array($layout, ['v1', 'v2'])) {
        $layout = 'v1';
    }
    Theme::set('pageCoverImage', theme_option('background_breadcrumb_default'));
    Theme::set('withPageHeader', false);
?>

<?php echo $__env->make(Theme::getThemeNamespace('views.job-board.job-' . $layout), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/job.blade.php ENDPATH**/ ?>