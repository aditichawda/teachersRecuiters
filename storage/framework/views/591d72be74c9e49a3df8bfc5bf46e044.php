<?php
    use Botble\JobBoard\Repositories\Interfaces\JobExperienceInterface;
    use Botble\Base\Enums\BaseStatusEnum;

    $experiences = app(JobExperienceInterface::class)
        ->advancedGet([
            'condition' => [
                'status' => BaseStatusEnum::PUBLISHED,
            ],
        ]);
?>
<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4"><?php echo e(__('Work experience')); ?></h4>
    <ul>
        <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="candidate_experiences[]" id="candidate-experiences-<?php echo e($experience->id); ?>" value="<?php echo e($experience->id); ?>" <?php if(in_array($experience->id, (array) request()->input('candidate_experiences', []))): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="candidate-experiences-<?php echo e($experience->id); ?>"><?php echo e($experience->name); ?></label>
                </div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/candidates/filters/experiences.blade.php ENDPATH**/ ?>