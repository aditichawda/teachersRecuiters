<div class="info-pagination" style="display: none">
    <?php echo e(__('Showing :from – :to of :total results', [
                'from' => $companies->firstItem(),
                'to' => $companies->lastItem(),
                'total' => $companies->total(),
        ])); ?>

</div>

<?php if(request()->query('layout') === 'grid'): ?>
    <?php echo Theme::partial('companies.company-grid', compact('companies')); ?>

<?php else: ?>
    <?php echo Theme::partial('companies.company-list', compact('companies')); ?>

<?php endif; ?>
<?php echo e($companies->links(Theme::getThemeNamespace('partials.pagination'))); ?>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/job-board/partials/companies.blade.php ENDPATH**/ ?>