<?php
    use Illuminate\Support\Arr;
?>

<?php if(isset($options['choices']) &&
        (is_array($options['choices']) || $options['choices'] instanceof \Illuminate\Support\Collection)): ?>
    <?php if(count($options['choices']) < Arr::get($options, 'switch_to_dropdown_threshold', 50)): ?>
        <div class="mb-3">
            <div class="input-icon">
                <input
                    type="text"
                    id="search-category-input-<?php echo e($inputSearchId = mt_rand()); ?>"
                    class="form-control"
                    placeholder="<?php echo e(trans('core/base::forms.search_input_placeholder')); ?>"
                    onkeyup="filter_categories_<?php echo e($inputSearchId); ?>(<?php echo e($inputSearchId); ?>)"
                    formnovalidate
                />
                <span class="input-icon-addon">
                    <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-search'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $attributes = $__attributesOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__attributesOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $component = $__componentOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__componentOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
                </span>
            </div>
        </div>

        <div
            data-bb-toggle="tree-checkboxes"
            class="tree-categories-list-<?php echo e($inputSearchId); ?>"
        >
            <?php echo $__env->make('core/base::forms.partials.tree-categories-checkbox-options', [
                'categories' => $options['choices'],
                'selected' => $options['selected'],
                'currentId' => null,
                'name' => $name,
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <script>
            function filter_categories_<?php echo e($inputSearchId); ?>(inputSearchId) {
                const searchInput = document.getElementById('search-category-input-' + inputSearchId).value.toLowerCase();
                const categories = document.querySelectorAll('.tree-categories-list-' + inputSearchId + ' label');

                categories.forEach(category => {
                    const text = category.textContent.toLowerCase();
                    category.style.display = text.includes(searchInput) ? '' : 'none';
                });
            }
        </script>
    <?php else: ?>
        <?php if (isset($component)) { $__componentOriginald8f3cab0e02bd6920e9589a31228d9ca = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8f3cab0e02bd6920e9589a31228d9ca = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.select','data' => ['multiple' => true,'name' => $name,'dataBbToggle' => 'tree-categories-select','dataPlaceholder' => trans('core/base::forms.select_placeholder')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['multiple' => true,'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($name),'data-bb-toggle' => 'tree-categories-select','data-placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('core/base::forms.select_placeholder'))]); ?>
            <?php echo $__env->make('core/base::forms.partials.tree-categories-select-options', [
                'categories' => $options['choices'],
                'selected' => $options['selected'],
                'currentId' => null,
                'name' => $name,
                'indent' => null,
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8f3cab0e02bd6920e9589a31228d9ca)): ?>
<?php $attributes = $__attributesOriginald8f3cab0e02bd6920e9589a31228d9ca; ?>
<?php unset($__attributesOriginald8f3cab0e02bd6920e9589a31228d9ca); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8f3cab0e02bd6920e9589a31228d9ca)): ?>
<?php $component = $__componentOriginald8f3cab0e02bd6920e9589a31228d9ca; ?>
<?php unset($__componentOriginald8f3cab0e02bd6920e9589a31228d9ca); ?>
<?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/core/base/resources/views/forms/fields/tree-categories.blade.php ENDPATH**/ ?>