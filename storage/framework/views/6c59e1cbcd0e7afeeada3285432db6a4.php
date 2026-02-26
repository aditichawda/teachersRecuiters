<?php if(isset($expiringAdsCount) && $expiringAdsCount > 0): ?>
    <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert" style="border-left: 4px solid #ffc107;">
        <div class="d-flex align-items-center">
            <i class="ti ti-alert-triangle me-2" style="font-size: 1.5rem;"></i>
            <div>
                <strong><?php echo e(trans('plugins/ads::ads.expiring_ads_alert_title', ['count' => $expiringAdsCount])); ?></strong>
                <p class="mb-0 mt-1"><?php echo e(trans('plugins/ads::ads.expiring_ads_alert_message')); ?></p>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/plugins/ads/resources/views/expiring-ads-alert.blade.php ENDPATH**/ ?>