<?php
    Theme::asset()->usePath()->add('leaflet-markercluster-css', 'plugins/leaflet.markercluster/MarkerCluster.css');
    Theme::asset()->usePath()->add('leaflet-css', 'plugins/leaflet/leaflet.css');
    Theme::asset()->container('footer')->usePath()->add('leaflet-js', 'plugins/leaflet/leaflet.js');
    Theme::asset()->container('footer')->usePath()->add('leaflet-markercluster-js', 'plugins/leaflet.markercluster/leaflet.markercluster.js');
    Theme::asset()->container('footer')->usePath()->add('jobs-js', 'js/jobs.js', ['leaflet-js', 'leaflet-markercluster-js'], [], get_cms_version());

    $layout = \Theme\Jobzilla\Supports\ThemeHelper::getCurrentLayout();
?>

<?php echo Theme::partial('jobs-card-styles'); ?>


<style>
.jobs-sc-heading {
    text-align: center;
    padding: 30px 0 10px;
}
.jobs-sc-heading h2 {
    font-size: 32px;
    font-weight: 800;
    color: #0c1e3c;
    margin-bottom: 8px;
    position: relative;
    display: inline-block;
}
.jobs-sc-heading h2::after {
    content: '';
    display: block;
    width: 50px;
    height: 4px;
    background: linear-gradient(135deg, #0073d1, #0073d1);
    border-radius: 4px;
    margin: 10px auto 0;
}
.jobs-sc-heading p {
    font-size: 15px;
    color: #64748b;
    margin-bottom: 0;
}
@media(max-width: 767px) {
    .jobs-sc-heading h2 { font-size: 24px; }
    .jobs-sc-heading p { font-size: 14px; }
}
</style>

<div class="section-full p-t120 p-b90 site-bg-white jobs-container">
    <div class="container">
        <div class="jobs-sc-heading">
            <h2><?php echo e(__('Jobs')); ?></h2>
            <p><?php echo e(__('Find the best teaching opportunities across India')); ?></p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="side-bar-filter">
                    <div class="backdrop"></div>
                    <div class="side-bar">
                        <div class="sidebar-elements search-bx">
                            <button class="d-md-none position-absolute btn btn-link btn-close-filter">
                                <i class="feather-x"></i>
                            </button>
                            <form action="<?php echo e(JobBoardHelper::getJobsPageURL()); ?>" method="get" id="jobs-filter-form" data-ajax-url="<?php echo e(route('public.ajax.jobs')); ?>">
                                <?php echo Theme::partial('jobs.filters.keyword'); ?>


                                <?php echo Theme::partial('jobs.filters.categories'); ?>


                                <?php echo Theme::partial('jobs.filters.city'); ?>


                                <?php echo Theme::partial('jobs.filters.types'); ?>


                                <?php echo Theme::partial('jobs.filters.date_posted'); ?>


                                <?php echo Theme::partial('jobs.filters.experiences'); ?>


                                <?php echo Theme::partial('jobs.filters.skills'); ?>

                            </form>
                        </div>
                    </div>
                </div>

                <?php echo dynamic_sidebar('job_board_sidebar'); ?>

            </div>

            <div class="col-lg-8 col-md-12 position-relative">
                <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
                    <div class="d-flex justify-content-between mb-3">
                        <button type="submit" class="d-block d-md-none btn btn-open-filter">
                            <i class="feather-filter"></i>
                        </button>
                        <span class="woocommerce-result-count-left">
                        <?php if($jobs->total()): ?>
                                <?php echo e(__('Showing :from – :to of :total results', [
                                    'from' => $jobs->firstItem(),
                                    'to'=> $jobs->lastItem(),
                                    'total' => $jobs->total(),
                                ])); ?>

                            <?php endif; ?>
                    </span>
                    </div>

                    <div class="woocommerce-ordering twm-filter-select gap-1">
                        <select class="wt-select-bar-2 selectpicker" name="sort_by">
                            <?php $__currentLoopData = JobBoardHelper::getSortByParams(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <select class="wt-select-bar-2 selectpicker" name="per_page">
                            <?php $__currentLoopData = JobBoardHelper::getPerPageParams(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item); ?>"><?php echo e(__('Show :number', ['number' => $item])); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <select class="wt-select-bar-2 selectpicker" name="layout">
                            <?php $__currentLoopData = \Theme\Jobzilla\Supports\ThemeHelper::getLayouts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php if(request()->query('layout') === $key): echo 'selected'; endif; ?>><?php echo e($value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="loading">
                    <div class="loading__inner">
                        <div class="loading__content">
                            <span class="spinner"></span>
                        </div>
                    </div>
                </div>

                <div class="twm-jobs-list-wrap jobs-listing">
                    <?php echo Theme::partial("jobs.$layout", ['jobs' => $jobs, 'style' => 2]); ?>

                </div>

                <div id="map" style="display: none" data-center="<?php echo e(json_encode(JobBoardHelper::getMapCenterLatLng())); ?>"></div>

                <div class=job-board-street-map-container">
                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div
                            class="job-board-street-map"
                            data-job="<?php echo e($job); ?>"
                            data-map-icon="<?php echo e(JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text); ?>"
                            data-company-logo="<?php echo e($job->company_logo_thumb); ?>"
                            data-full-address="<?php echo e($job->full_address); ?>"
                            data-url="<?php echo e($job->url); ?>"
                        >
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/shortcodes/jobs/index.blade.php ENDPATH**/ ?>