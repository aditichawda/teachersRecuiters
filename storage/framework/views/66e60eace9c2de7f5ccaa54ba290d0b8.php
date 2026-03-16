<?php
    Theme::asset()->usePath()->add('css-bar-rating', 'plugins/css/css-stars.css');
    Theme::asset()->container('footer')->usePath()->add('jquery-bar-rating-js', 'plugins/jquery-bar-rating/jquery.barrating.min.js');
    $reviewsCount = $company->reviews->count();
?>

<div class="mt-4 pt-5 position-relative review-listing">
    <h4 class="fs-17 fw-semibold mb-3"><?php echo e(__(":company's :review", ['company' => $company->name, 'review' => $reviewsCount > 1 ? __('Reviews') : __('Review')])); ?></h4>
    <div class="spinner-overflow"></div>
    <div class="half-circle-spinner" style="display: none;position: absolute;top: 70%;left: 50%;">
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>
    </div>

    <?php if($reviewsCount > 0): ?>
        <div class="review-list">
            <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.review-load'), ['reviews' => $company->reviews], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('public.reviews.create')); ?>" method="post" class="company-review-form mt-4 pt-3">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="company_id" value="<?php echo e($company->id); ?>">
        <h5 class="fs-17 fw-semibold mb-2"><?php echo e(__('Reviews for :company', ['company' => $company->name])); ?></h5>
        <?php if(auth()->guard('account')->guest()): ?>
            <p class="text-danger my-3">
                <?php echo BaseHelper::clean(__('Please <a href=":route">login</a> to write review!', ['route' => route('public.account.login')])); ?>

            </p>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-3">
                    <select name="star" class="rating" data-read-only="false">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5" selected>5</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb-3">
                    <label for="review" class="form-label"><?php echo e(__('Review')); ?></label>
                    <textarea class="form-control" id="review" name="review" style="height: auto" <?php if(! $canReviewCompany): echo 'disabled'; endif; ?> rows="5" placeholder="<?php echo e(__('Add your review')); ?>"></textarea>
                </div>
            </div>
        </div>
        <div class="text-end">
            <button type="submit" class="site-button" <?php if(! $canReviewCompany): echo 'disabled'; endif; ?>>
                <?php echo e(__('Submit Review')); ?>

            </button>
        </div>
    </form>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/companies/reviews.blade.php ENDPATH**/ ?>