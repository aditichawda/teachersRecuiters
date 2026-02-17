<?php
    /** @var Botble\Table\Actions\Action $action */
?>

<li>
    <a
        <?php if(!$action->getAttribute('class')): ?> class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'dropdown-item',
            str_replace('btn-', 'text-', $action->getColor()),
        ]); ?>" <?php endif; ?>
        <?php echo $__env->make('core/table::actions.includes.action-attributes', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    >
        <?php echo $__env->make('core/table::actions.includes.action-icon', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <span class="ms-1"><?php echo e($action->getLabel()); ?></span>
    </a>
</li>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\core\table\/resources/views/actions/action-dropdown-item.blade.php ENDPATH**/ ?>