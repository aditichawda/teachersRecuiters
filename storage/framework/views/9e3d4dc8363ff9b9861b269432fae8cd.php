<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4"><?php echo e(__('Expected Salary')); ?></h4>
    <div style="display: flex; gap: 12px;">
        <div style="flex: 1;">
            <label class="form-label"><?php echo e(__('From')); ?></label>
            <input type="number" name="expected_salary_from" value="<?php echo e(BaseHelper::stringify(request()->query('expected_salary_from'))); ?>" class="form-control" placeholder="<?php echo e(__('Min')); ?>" min="0" step="1000" style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 8px 14px; height: 40px; font-size: 14px;">
        </div>
        <div style="flex: 1;">
            <label class="form-label"><?php echo e(__('To')); ?></label>
            <input type="number" name="expected_salary_to" value="<?php echo e(BaseHelper::stringify(request()->query('expected_salary_to'))); ?>" class="form-control" placeholder="<?php echo e(__('Max')); ?>" min="0" step="1000" style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 8px 14px; height: 40px; font-size: 14px;">
        </div>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/candidates/filters/salary.blade.php ENDPATH**/ ?>