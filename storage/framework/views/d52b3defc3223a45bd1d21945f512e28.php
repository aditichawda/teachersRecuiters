<div class="row">
    <div class="col-md-6">
        <div id="app-job-board">
            <employer-colleagues-component
                :data="<?php echo e(json_encode($model ? $model->employer_colleagues : [])); ?>"
                v-slot="{ items, addRow, deleteRow }"
            >
                <div class="mb-3">
                    <div class="mb-2" v-for="(item, index) in items">
                        <div class="row g-2">
                            <div class="col">
                                <input
                                    type="email"
                                    name="employer_colleagues[]"
                                    v-model="item.value"
                                    class="form-control"
                                    placeholder="<?php echo e(trans('plugins/job-board::general.email')); ?>"
                                />
                            </div>

                            <div class="col-auto">
                                <?php if (isset($component)) { $__componentOriginal922f7d3260a518f4cf606eecf9669dcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['@click' => 'deleteRow(index)','icon' => 'ti ti-trash','iconOnly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@click' => 'deleteRow(index)','icon' => 'ti ti-trash','icon-only' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal922f7d3260a518f4cf606eecf9669dcb)): ?>
<?php $attributes = $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb; ?>
<?php unset($__attributesOriginal922f7d3260a518f4cf606eecf9669dcb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal922f7d3260a518f4cf606eecf9669dcb)): ?>
<?php $component = $__componentOriginal922f7d3260a518f4cf606eecf9669dcb; ?>
<?php unset($__componentOriginal922f7d3260a518f4cf606eecf9669dcb); ?>
<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="javascript:void(0)" role="button" @click="addRow">
                    <?php echo e(trans('plugins/job-board::general.add_new')); ?>

                </a>
            </employer-colleagues-component>
        </div>
    </div>
</div>

<?php echo $__env->make('plugins/job-board::partials.add-company', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/plugins/job-board/resources/views/partials/colleagues.blade.php ENDPATH**/ ?>