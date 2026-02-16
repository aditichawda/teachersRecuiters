<?php
    $updateTreeRoute ??= null;
    $totalCategoryCount = $categories->count();
?>

<div
    class="dd"
    data-depth="0"
    data-empty-text="<?php echo e(trans('core/base::tree-category.empty_text')); ?>"
>
    <?php echo $__env->make('core/base::forms.partials.tree-category', compact('updateTreeRoute', 'totalCategoryCount'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\core\base\/resources/views/forms/partials/tree-categories.blade.php ENDPATH**/ ?>