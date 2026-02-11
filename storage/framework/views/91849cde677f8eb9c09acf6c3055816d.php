<div class="form-group">
    <label><?php echo e(trans('core/base::forms.name')); ?></label>
    <input type="text" class="form-control" name="name" value="<?php echo e($config['name']); ?>">
</div>

<div class="form-group">
    <label><?php echo e(__('Title')); ?></label>
    <input type="text" class="form-control" name="title" value="<?php echo e($config['title']); ?>">
</div>

<div class="form-group">
    <label><?php echo e(__('Subtitle')); ?></label>
    <textarea name="subtitle"  rows="3" class="form-control"><?php echo e($config['subtitle']); ?></textarea>
</div>

<div class="form-group">
    <label><?php echo e(__('Link')); ?></label>
    <input type="text" class="form-control" name="link" value="<?php echo e($config['link']); ?>">
</div>

<div class="form-group">
    <label><?php echo e(__('Image')); ?></label>
    <?php echo Form::mediaImage('image', $config['image']); ?>

</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/////widgets/banner/templates/backend.blade.php ENDPATH**/ ?>