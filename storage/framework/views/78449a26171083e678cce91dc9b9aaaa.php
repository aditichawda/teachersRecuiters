<div class="d-sm-flex align-items-top review-item">
    <div class="flex-shrink-0">
        <img class="rounded-circle avatar-md img-thumbnail" src="<?php echo e($review->account->avatar_url); ?>" alt="<?php echo e($review->account->name); ?>">
    </div>
    <div class="flex-grow-1 ms-sm-3">
        <div>
            <p class="text-muted float-end fs-14 mb-2"><?php echo e($review->created_at?->diffForHumans()); ?></p>
            <h5 class="mt-sm-0 mt-3 mb-1"><?php echo e($review->account->name); ?></h5>
            <div class="review-rating mb-2">
                <?php for($i = 0; $i < $review->star; $i++): ?>
                    <i class="fa fa-star text-warning"></i>
                <?php endfor; ?>

                <?php for($i = 0; $i < (5 - $review->star); $i++): ?>
                    <i class="fa fa-star text-muted"></i>
                <?php endfor; ?>
            </div>
            <p class="text-muted fst-italic"><?php echo e($review->review); ?></p>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/partials/review-item.blade.php ENDPATH**/ ?>