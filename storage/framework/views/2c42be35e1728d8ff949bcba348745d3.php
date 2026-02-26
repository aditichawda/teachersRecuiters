<ul class="list-group list_payment_method">
    <?php echo apply_filters(PAYMENT_FILTER_ADDITIONAL_PAYMENT_METHODS, null, [
        'name' => $name,
        'amount' => $amount,
        'currency' => $currency,
        'selected' => PaymentMethods::getSelectedMethod(),
        'default' => PaymentMethods::getDefaultMethod(),
        'selecting' => PaymentMethods::getSelectingMethod(),
    ]); ?>


    <?php echo PaymentMethods::render(); ?>

</ul>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\payment\/resources/views/partials/payment-methods.blade.php ENDPATH**/ ?>