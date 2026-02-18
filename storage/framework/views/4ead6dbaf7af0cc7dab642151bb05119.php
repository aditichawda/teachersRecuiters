<!DOCTYPE html>
<html
    lang="<?php echo e(app()->getLocale()); ?>"
    class="h-100"
>

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <meta
        name="csrf-token"
        content="<?php echo e(csrf_token()); ?>"
    >
    <title><?php echo e(trans('packages/page::pages.visual_builder', ['name' => $page->name])); ?></title>

    <?php
        $faviconUrl = AdminHelper::getAdminFaviconUrl();
        $faviconType = setting('admin_favicon_type', 'image/x-icon');
    ?>
    <link
        href="<?php echo e($faviconUrl); ?>"
        rel="icon shortcut"
        type="<?php echo e($faviconType); ?>"
    >

    <style>
        [v-cloak],
        [x-cloak] {
            display: none;
        }
    </style>

    <?php echo BaseHelper::googleFonts(
        'https://fonts.googleapis.com/' .
            sprintf(
                'css2?family=%s:wght@300;400;500;600;700&display=swap',
                urlencode(setting('admin_primary_font', 'Inter')),
            ),
    ); ?>


    <style>
        :root {
            --primary-font: "<?php echo e(setting('admin_primary_font', 'Inter')); ?>";
            --primary-color: <?php echo e($primaryColor = setting('admin_primary_color', '#206bc4')); ?>;
            --primary-color-rgb: <?php echo e(implode(', ', BaseHelper::hexToRgb($primaryColor))); ?>;
            --secondary-color: <?php echo e($secondaryColor = setting('admin_secondary_color', '#6c7a91')); ?>;
            --secondary-color-rgb: <?php echo e(implode(', ', BaseHelper::hexToRgb($secondaryColor))); ?>;
            --heading-color: <?php echo e(setting('admin_heading_color', 'inherit')); ?>;
            --text-color: <?php echo e($textColor = setting('admin_text_color', '#182433')); ?>;
            --text-color-rgb: <?php echo e(implode(', ', BaseHelper::hexToRgb($textColor))); ?>;
            --link-color: <?php echo e($linkColor = setting('admin_link_color', '#206bc4')); ?>;
            --link-color-rgb: <?php echo e(implode(', ', BaseHelper::hexToRgb($linkColor))); ?>;
            --link-hover-color: <?php echo e($linkHoverColor = setting('admin_link_hover_color', '#206bc4')); ?>;
            --link-hover-color-rgb: <?php echo e(implode(', ', BaseHelper::hexToRgb($linkHoverColor))); ?>;
        }
    </style>

    <?php echo Assets::renderHeader(['core']); ?>


    
    <?php echo RvMedia::renderHeader(); ?>


    <?php echo $__env->make('core/base::elements.common', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>

<body
    class="d-flex flex-column h-100 vb-body"
    <?php if(AdminHelper::themeMode() === 'dark'): ?> data-bs-theme="dark" <?php endif; ?>
>
    <div id="visual-builder-app">
        <?php echo $__env->make('packages/page::visual-builder.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="vb-container d-flex flex-fill overflow-hidden">
            <!-- Sidebar -->
            <aside
                class="vb-sidebar border-end bg-body-tertiary d-flex flex-column"
                id="vb-sidebar"
            >
                <div class="flex-fill overflow-auto p-3">
                    <!-- Shortcode List View -->
                    <div
                        class="vb-list-view"
                        id="vb-list-view"
                    >
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h3 class="fw-bold mb-0"><?php echo e(trans('packages/page::pages.visual_builder_shortcodes')); ?></h3>
                            <?php if (isset($component)) { $__componentOriginal922f7d3260a518f4cf606eecf9669dcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['type' => 'button','id' => 'vb-add-shortcode-btn','size' => 'sm','color' => 'primary','icon' => 'ti ti-plus']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','id' => 'vb-add-shortcode-btn','size' => 'sm','color' => 'primary','icon' => 'ti ti-plus']); ?>
                                <?php echo e(trans('packages/page::pages.add')); ?>

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

                        <div
                            class="vb-shortcode-list"
                            id="vb-shortcode-list"
                        >
                            <!-- Shortcodes will be rendered here by JavaScript -->
                        </div>
                    </div>

                    <!-- Edit Panel View (hidden by default) -->
                    <div
                        class="vb-edit-panel d-none"
                        id="vb-edit-panel"
                    >
                        <div class="d-flex align-items-center gap-2 mb-3 pb-3 border-bottom">
                            <?php if (isset($component)) { $__componentOriginal922f7d3260a518f4cf606eecf9669dcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['type' => 'button','id' => 'vb-back-btn','size' => 'sm','color' => 'ghost-secondary','icon' => 'ti ti-arrow-left',':tooltip' => 'trans(\'packages/page::pages.back\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','id' => 'vb-back-btn','size' => 'sm','color' => 'ghost-secondary','icon' => 'ti ti-arrow-left',':tooltip' => 'trans(\'packages/page::pages.back\')']); ?>
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
                            <h3
                                class="mb-0 fw-bold flex-fill"
                                id="vb-panel-title"
                            ><?php echo e(trans('packages/page::pages.visual_builder_edit_shortcode')); ?></h3>
                            <?php if (isset($component)) { $__componentOriginal922f7d3260a518f4cf606eecf9669dcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['type' => 'button','id' => 'vb-close-panel-btn','size' => 'sm','color' => 'ghost-secondary','icon' => 'ti ti-x',':tooltip' => 'trans(\'packages/page::pages.close\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','id' => 'vb-close-panel-btn','size' => 'sm','color' => 'ghost-secondary','icon' => 'ti ti-x',':tooltip' => 'trans(\'packages/page::pages.close\')']); ?>
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

                        <div
                            class="vb-panel-content"
                            id="vb-panel-content"
                        >
                            <!-- Edit form will be rendered here by JavaScript -->
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Preview Iframe -->
            <main
                class="vb-preview flex-fill d-flex flex-column align-items-center justify-content-center bg-body position-relative"
                id="vb-preview"
            >
                <div
                    class="vb-preview-loading text-center"
                    id="vb-preview-loading"
                >
                    <div
                        class="spinner-border text-primary mb-3"
                        role="status"
                    >
                        <span class="visually-hidden"><?php echo e(trans('packages/page::pages.loading')); ?></span>
                    </div>
                    <p class="text-muted"><?php echo e(trans('packages/page::pages.loading_preview')); ?></p>
                </div>

                <div
                    class="vb-preview-error text-center p-4 d-none"
                    id="vb-preview-error"
                >
                    <?php if (isset($component)) { $__componentOriginalecda78b9fe8916cbd83b85e55a8b7a1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalecda78b9fe8916cbd83b85e55a8b7a1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::alert','data' => ['type' => 'danger','class' => 'd-inline-flex flex-column align-items-center gap-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'danger','class' => 'd-inline-flex flex-column align-items-center gap-3']); ?>
                        <div class="d-flex align-items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-alert-circle'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                            <span id="vb-error-message"><?php echo e(trans('packages/page::pages.visual_builder_unable_to_load_preview')); ?></span>
                        </div>
                        <?php if (isset($component)) { $__componentOriginal922f7d3260a518f4cf606eecf9669dcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['type' => 'button','id' => 'vb-reload-preview-btn','size' => 'sm','color' => 'primary','icon' => 'ti ti-refresh']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','id' => 'vb-reload-preview-btn','size' => 'sm','color' => 'primary','icon' => 'ti ti-refresh']); ?>
                            <?php echo e(trans('packages/page::pages.visual_builder_reload_preview')); ?>

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
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalecda78b9fe8916cbd83b85e55a8b7a1c)): ?>
<?php $attributes = $__attributesOriginalecda78b9fe8916cbd83b85e55a8b7a1c; ?>
<?php unset($__attributesOriginalecda78b9fe8916cbd83b85e55a8b7a1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalecda78b9fe8916cbd83b85e55a8b7a1c)): ?>
<?php $component = $__componentOriginalecda78b9fe8916cbd83b85e55a8b7a1c; ?>
<?php unset($__componentOriginalecda78b9fe8916cbd83b85e55a8b7a1c); ?>
<?php endif; ?>
                </div>

                <div
                    class="vb-preview-frame-container d-none"
                    id="vb-preview-frame-container"
                >
                    <iframe
                        id="vb-preview-iframe"
                        name="vb-preview-iframe"
                        src="<?php echo e(route('pages.preview', $page)); ?>?visual_builder=1"
                        frameborder="0"
                        sandbox="allow-same-origin allow-scripts allow-forms allow-popups"
                        class="border-0"
                    ></iframe>
                </div>
            </main>
        </div>

        <!-- Add Shortcode List Modal -->
        <?php if (isset($component)) { $__componentOriginaldc8ac54b6bf7eb0d0560fdd5aa630687 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldc8ac54b6bf7eb0d0560fdd5aa630687 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::modal','data' => ['title' => trans('packages/shortcode::shortcode.ui-blocks'),'id' => 'vb-shortcode-list-modal','class' => 'shortcode-list-modal','size' => 'full','scrollable' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('packages/shortcode::shortcode.ui-blocks')),'id' => 'vb-shortcode-list-modal','class' => 'shortcode-list-modal','size' => 'full','scrollable' => true]); ?>
            <div id="vb-shortcode-list-content">
                <?php echo $__env->make('packages/page::visual-builder.partials.shortcode-list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

             <?php $__env->slot('footer', null, []); ?> 
                <div class="btn-list">
                    <?php if (isset($component)) { $__componentOriginal922f7d3260a518f4cf606eecf9669dcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['dataBsDismiss' => 'modal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data-bs-dismiss' => 'modal']); ?>
                        <?php echo e(trans('core/base::base.close')); ?>

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

                    <?php if (isset($component)) { $__componentOriginal922f7d3260a518f4cf606eecf9669dcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['color' => 'primary','dataBbToggle' => 'vb-shortcode-use','disabled' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'primary','data-bb-toggle' => 'vb-shortcode-use','disabled' => true]); ?>
                        <?php echo e(trans('packages/shortcode::shortcode.use')); ?>

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
             <?php $__env->endSlot(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldc8ac54b6bf7eb0d0560fdd5aa630687)): ?>
<?php $attributes = $__attributesOriginaldc8ac54b6bf7eb0d0560fdd5aa630687; ?>
<?php unset($__attributesOriginaldc8ac54b6bf7eb0d0560fdd5aa630687); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldc8ac54b6bf7eb0d0560fdd5aa630687)): ?>
<?php $component = $__componentOriginaldc8ac54b6bf7eb0d0560fdd5aa630687; ?>
<?php unset($__componentOriginaldc8ac54b6bf7eb0d0560fdd5aa630687); ?>
<?php endif; ?>

        <!-- Shortcode Config Modal -->
        <?php if (isset($component)) { $__componentOriginaldc8ac54b6bf7eb0d0560fdd5aa630687 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldc8ac54b6bf7eb0d0560fdd5aa630687 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::modal','data' => ['title' => trans('core/base::forms.add_short_code'),'id' => 'vb-shortcode-modal','class' => 'shortcode-modal','scrollable' => true,'dataBsBackdrop' => 'static']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('core/base::forms.add_short_code')),'id' => 'vb-shortcode-modal','class' => 'shortcode-modal','scrollable' => true,'data-bs-backdrop' => 'static']); ?>
            <form class="shortcode-data-form">
                <input
                    type="hidden"
                    class="shortcode-input-key"
                >
                <div class="shortcode-admin-config short-code-admin-config"></div>
            </form>

             <?php $__env->slot('footer', null, []); ?> 
                <?php if (isset($component)) { $__componentOriginal922f7d3260a518f4cf606eecf9669dcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['dataBsDismiss' => 'modal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data-bs-dismiss' => 'modal']); ?>
                    <?php echo e(trans('core/base::tables.cancel')); ?>

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
                <?php if (isset($component)) { $__componentOriginal922f7d3260a518f4cf606eecf9669dcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['color' => 'primary','dataBbToggle' => 'vb-shortcode-add-single','dataAddText' => trans('core/base::forms.add'),'dataUpdateText' => trans('core/base::forms.update')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'primary','data-bb-toggle' => 'vb-shortcode-add-single','data-add-text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('core/base::forms.add')),'data-update-text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('core/base::forms.update'))]); ?>
                    <?php echo e(trans('core/base::forms.add')); ?>

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
             <?php $__env->endSlot(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldc8ac54b6bf7eb0d0560fdd5aa630687)): ?>
<?php $attributes = $__attributesOriginaldc8ac54b6bf7eb0d0560fdd5aa630687; ?>
<?php unset($__attributesOriginaldc8ac54b6bf7eb0d0560fdd5aa630687); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldc8ac54b6bf7eb0d0560fdd5aa630687)): ?>
<?php $component = $__componentOriginaldc8ac54b6bf7eb0d0560fdd5aa630687; ?>
<?php unset($__componentOriginaldc8ac54b6bf7eb0d0560fdd5aa630687); ?>
<?php endif; ?>
    </div>

    <!-- Pass data to JavaScript -->
    <script>
        window.visualBuilderData = {
            pageId: <?php echo json_encode($page->id, 15, 512) ?>,
            pageName: <?php echo json_encode($page->name, 15, 512) ?>,
            shortcodes: <?php echo json_encode($shortcodes, 15, 512) ?>,
            availableShortcodes: <?php echo json_encode($availableShortcodes, 15, 512) ?>,
            previewUrl: <?php echo json_encode(route('pages.preview', $page), 512) ?>,
            saveUrl: <?php echo json_encode(route('pages.visual-builder.save', $page), 512) ?>,
            editUrl: <?php echo json_encode(route('pages.edit', $page), 512) ?>,
            renderItemsUrl: <?php echo json_encode(route('pages.visual-builder.render-items'), 15, 512) ?>,
            renderTypesUrl: <?php echo json_encode(route('pages.visual-builder.render-types'), 15, 512) ?>,
            csrfToken: <?php echo json_encode(csrf_token(), 15, 512) ?>,
            translations: {
                loading: <?php echo json_encode(trans('packages/page::pages.loading'), 15, 512) ?>,
                saving: <?php echo json_encode(trans('packages/page::pages.visual_builder_saving'), 15, 512) ?>,
                saved: <?php echo json_encode(trans('packages/page::pages.visual_builder_saved'), 15, 512) ?>,
                error: <?php echo json_encode(trans('packages/page::pages.visual_builder_error'), 15, 512) ?>,
                confirmDelete: <?php echo json_encode(trans('packages/page::pages.visual_builder_confirm_delete_shortcode'), 15, 512) ?>,
                unsavedChanges: <?php echo json_encode(trans('packages/page::pages.visual_builder_confirm_leave'), 15, 512) ?>,
            }
        };
    </script>

    <?php echo Assets::renderFooter(); ?>

    <?php echo RvMedia::renderFooter(); ?>

    <?php echo $__env->make('core/media::partials.media', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>

</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/packages/page/resources/views/visual-builder/index.blade.php ENDPATH**/ ?>