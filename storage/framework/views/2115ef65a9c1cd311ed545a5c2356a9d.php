<div class="form-group mb-4">
    <h4 class="section-head-small mb-4"><?php echo e(__('Keyword')); ?></h4>
    <div class="input-group">
        <input type="text" name="keyword" value="<?php echo e(BaseHelper::stringify(request()->query('keyword'))); ?>" class="form-control" placeholder="<?php echo e(__('Job Title or Keyword')); ?>">
        <button class="btn" type="submit">
            <i class="feather-search"></i>
        </button>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/jobs/filters/keyword.blade.php ENDPATH**/ ?>