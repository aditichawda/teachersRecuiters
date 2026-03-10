<?php
    use Botble\JobBoard\Models\Company;
    use Botble\Base\Enums\BaseStatusEnum;
    use Botble\JobBoard\Facades\JobBoardHelper;

    // Get companies that have active jobs (currently hiring)
    $currentlyHiring = request()->query('currently_hiring', false);
?>

<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4"><?php echo e(__('Currently Hiring')); ?></h4>
    <ul>
        <li>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="currently_hiring" id="currently-hiring" value="1" <?php if($currentlyHiring): echo 'checked'; endif; ?>>
                <label class="form-check-label" for="currently-hiring"><?php echo e(__('Show only institutions with active jobs')); ?></label>
            </div>
        </li>
    </ul>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/companies/filters/currently-hiring.blade.php ENDPATH**/ ?>