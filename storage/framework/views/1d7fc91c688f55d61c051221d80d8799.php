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
        <select name="city_id" class="wt-select-bar-large selectpicker-location">
            <option value=""><?php echo e(__('Select City')); ?></option>
            <?php if($cityId && $cityName): ?>
                <option value="<?php echo e($cityId); ?>" selected><?php echo e($cityName); ?></option>
            <?php endif; ?>
        </select>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/jobs/filters/city.blade.php ENDPATH**/ ?>