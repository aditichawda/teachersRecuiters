<?php echo Html::link(route('coupons.edit', $coupon), $coupon->code); ?>

<p class="text-muted mt-1 mb-0"><?php echo BaseHelper::clean(trans('plugins/job-board::coupon.value_off', ['value' => "<strong>$value</strong>"])); ?></p>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/coupons/partials/detail.blade.php ENDPATH**/ ?>