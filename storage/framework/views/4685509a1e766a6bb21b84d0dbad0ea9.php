<?php
    use Botble\JobBoard\Repositories\Interfaces\JobSkillInterface;
    use Botble\Base\Enums\BaseStatusEnum;

    $skills = app(JobSkillInterface::class)
        ->advancedGet([
            'condition' => [
                'status' => BaseStatusEnum::PUBLISHED,
            ],
        ]);
?>

<?php if($skills->count()): ?>
    <div class="twm-sidebar-ele-filter">
        <div class="widget tw-sidebar-tags-wrap">
            <h4 class="section-head-small mb-4"><?php echo e(__('Skills')); ?></h4>
            <div class="tagcloud">
                <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span>
                        <input type="checkbox" class="btn-check" name="job_skills[]" id="job-skills-<?php echo e($skill->id); ?>" autocomplete="off" value="<?php echo e($skill->id); ?>" <?php if(in_array($skill->id, (array) request()->input('job_skills', []))): echo 'checked'; endif; ?>>
                        <label class="tag-cloud btn" for="job-skills-<?php echo e($skill->id); ?>"><?php echo e($skill->name); ?></label>
                    </span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/jobs/filters/skills.blade.php ENDPATH**/ ?>