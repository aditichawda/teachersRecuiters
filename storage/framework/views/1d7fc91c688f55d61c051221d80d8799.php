<?php if(is_plugin_active('location')): ?>
    <?php
        $cityId = (int) request()->query('city_id');
        $cityName = null;
        if ($cityId) {
            $city = \Botble\Location\Models\City::find($cityId);
            $cityName = $city ? $city->name : null;
        }
    ?>
    <div class="form-group mb-4">
        <h4 class="section-head-small mb-4"><?php echo e(__('Location')); ?></h4>
        <div class="job-city-search-wrapper" style="position: relative;">
            <input type="text" name="city_search" id="job_city_search" class="wt-select-bar-large job-city-search-input" placeholder="<?php echo e(__('Select Your Location')); ?>" autocomplete="off" value="<?php echo e(request('city_search', $cityName)); ?>" />
            <input type="hidden" name="city_id" id="job_city_id" value="<?php echo e($cityId); ?>" />
            <div class="job-city-suggestions" id="job-city-suggestions" style="display: none;"></div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/jobs/filters/city.blade.php ENDPATH**/ ?>