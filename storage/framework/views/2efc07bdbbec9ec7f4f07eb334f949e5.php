<?php if($jobApplication): ?>
    <?php if (isset($component)) { $__componentOriginalc0cc3528153402540de7319c5c012ee8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc0cc3528153402540de7319c5c012ee8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::datagrid.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::datagrid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <?php if (isset($component)) { $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::datagrid.item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::datagrid.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
             <?php $__env->slot('title', null, []); ?> 
                <?php echo e(trans('plugins/job-board::job-application.tables.time')); ?>

             <?php $__env->endSlot(); ?>

            <?php echo e($jobApplication->created_at); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $attributes = $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $component = $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::datagrid.item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::datagrid.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
             <?php $__env->slot('title', null, []); ?> 
                <?php echo e(trans('plugins/job-board::job-application.tables.position')); ?>

             <?php $__env->endSlot(); ?>

            <a href="<?php echo e($jobApplication->job->url); ?>" target="_blank">
                <?php echo e($jobApplication->job->name); ?>

                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-external-link'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
            </a>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $attributes = $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $component = $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>

        <?php if(!$jobApplication->is_external_apply): ?>
            <?php if (isset($component)) { $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::datagrid.item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::datagrid.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                 <?php $__env->slot('title', null, []); ?> 
                    <?php echo e(trans('plugins/job-board::job-application.tables.name')); ?>

                 <?php $__env->endSlot(); ?>

                <?php if($jobApplication->account->id && $jobApplication->account->is_public_profile): ?>
                    <a href="<?php echo e($jobApplication->account->url); ?>" target="_blank">
                        <?php echo e($jobApplication->account->name); ?>

                        <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-external-link'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                    </a>
                <?php else: ?>
                    <?php echo e($jobApplication->full_name); ?>

                <?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $attributes = $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $component = $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
        <?php endif; ?>

        <?php if($jobApplication->phone): ?>
            <?php if (isset($component)) { $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::datagrid.item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::datagrid.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                 <?php $__env->slot('title', null, []); ?> 
                    <?php echo e(trans('plugins/job-board::job-application.tables.phone')); ?>

                 <?php $__env->endSlot(); ?>

                <a href="tel:<?php echo e($jobApplication->phone); ?>"><?php echo e($jobApplication->phone); ?></a>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $attributes = $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $component = $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
        <?php endif; ?>

        <?php if (isset($component)) { $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::datagrid.item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::datagrid.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
             <?php $__env->slot('title', null, []); ?> 
                <?php echo e(trans('plugins/job-board::job-application.tables.email')); ?>

             <?php $__env->endSlot(); ?>

            <a href="mailto:<?php echo e($jobApplication->email); ?>"><?php echo e($jobApplication->email); ?></a>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $attributes = $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $component = $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>

        <?php if(!$jobApplication->is_external_apply): ?>
            <?php if($jobApplication->resume || ($jobApplication->account->id && $jobApplication->account->resume)): ?>
                <?php if (isset($component)) { $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::datagrid.item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::datagrid.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                     <?php $__env->slot('title', null, []); ?> 
                        <?php echo e(trans('plugins/job-board::job-application.tables.resume')); ?>

                     <?php $__env->endSlot(); ?>

                    <a
                        href="<?php echo e(route(auth()->check() && is_in_admin(true) ? 'job-applications.download-cv' : 'public.account.applicants.download-cv', $jobApplication->id)); ?>"
                        target="_blank"
                        class="d-flex align-items-center gap-1"
                    >
                        <?php echo e(trans('plugins/job-board::job-application.tables.download_resume')); ?>

                        <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-external-link'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                    </a>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $attributes = $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $component = $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
            <?php endif; ?>

            <?php if($jobApplication->cover_letter): ?>
                    <?php if (isset($component)) { $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::datagrid.item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::datagrid.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                         <?php $__env->slot('title', null, []); ?> 
                            <?php echo e(trans('plugins/job-board::job-application.tables.cover_letter')); ?>

                         <?php $__env->endSlot(); ?>

                        <a href="<?php echo e(RvMedia::url($jobApplication->cover_letter)); ?>" target="_blank" class="d-flex align-items-center gap-1">
                            <?php echo e(RvMedia::url($jobApplication->cover_letter)); ?>

                            <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-external-link'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                        </a>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $attributes = $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $component = $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc0cc3528153402540de7319c5c012ee8)): ?>
<?php $attributes = $__attributesOriginalc0cc3528153402540de7319c5c012ee8; ?>
<?php unset($__attributesOriginalc0cc3528153402540de7319c5c012ee8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc0cc3528153402540de7319c5c012ee8)): ?>
<?php $component = $__componentOriginalc0cc3528153402540de7319c5c012ee8; ?>
<?php unset($__componentOriginalc0cc3528153402540de7319c5c012ee8); ?>
<?php endif; ?>

    <?php if($jobApplication->message): ?>
        <?php if (isset($component)) { $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::datagrid.item','data' => ['class' => 'mt-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::datagrid.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-4']); ?>
             <?php $__env->slot('title', null, []); ?> 
                <?php echo e(trans('plugins/job-board::job-application.tables.message')); ?>

             <?php $__env->endSlot(); ?>

            <?php echo e($jobApplication->message); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $attributes = $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $component = $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
    <?php endif; ?>

    <?php
        $screeningAnswers = $jobApplication->screening_answers ?? [];
        $screeningQuestions = $jobApplication->job->screeningQuestions ?? collect();
    ?>
    <?php if(!$jobApplication->is_external_apply && $screeningQuestions->isNotEmpty()): ?>
        <div class="mt-4 pt-3 border-top">
            <h6 class="mb-3 fw-semibold"><?php echo e(trans('plugins/job-board::job-application.screening_questions_answers')); ?></h6>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th style="width:40%"><?php echo e(trans('plugins/job-board::job-application.screening_question')); ?></th>
                            <th style="width:45%"><?php echo e(trans('plugins/job-board::job-application.applicant_answer')); ?></th>
                            <th class="text-center" style="width:15%"><?php echo e(trans('plugins/job-board::job-application.correct_answer')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $screeningQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $answer = $screeningAnswers[$sq->id] ?? null;
                                if (is_string($answer) && str_starts_with(trim($answer), '[')) {
                                    $decoded = json_decode($answer, true);
                                    $answerDisplay = is_array($decoded) ? implode(', ', array_map('trim', $decoded)) : $answer;
                                } else {
                                    $answerDisplay = $answer !== null && $answer !== '' ? (string) $answer : '—';
                                }
                                $correctAnswer = $sq->pivot->correct_answer ?? $sq->correct_answer ?? null;
                                $hasCorrect = (bool) $correctAnswer;
                                $isCorrect = false;
                                if ($hasCorrect && $answer !== null && $answer !== '') {
                                    if (is_string($answer) && str_starts_with(trim($answer), '[')) {
                                        $arr = json_decode($answer, true);
                                        $isCorrect = is_array($arr) && in_array(trim($correctAnswer), array_map('trim', $arr));
                                    } else {
                                        $isCorrect = trim((string) $answer) === trim($correctAnswer);
                                    }
                                }
                            ?>
                            <tr>
                                <td><?php echo e($sq->pivot->question_override ?: $sq->question); ?></td>
                                <td><?php echo e($answerDisplay); ?></td>
                                <td class="text-center">
                                    <?php if($hasCorrect): ?>
                                        <?php if($isCorrect): ?>
                                            <span class="text-success" title="<?php echo e(trans('plugins/job-board::job-application.answer_correct')); ?>"><?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-circle-check'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
<?php endif; ?></span>
                                        <?php else: ?>
                                            <span class="text-danger" title="<?php echo e(trans('plugins/job-board::job-application.answer_incorrect')); ?>"><?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-circle-x'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
<?php endif; ?></span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/info.blade.php ENDPATH**/ ?>