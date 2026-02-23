<?php echo Theme::partial('header'); ?>


<?php if(is_plugin_active('ads')): ?>
    <?php
        // Display ads at top of home page
        try {
            if (function_exists('display_ads_by_page')) {
                $topAds = display_ads_by_page('home', 'top');
            } else {
                $topAds = '';
            }
        } catch (\Exception $e) {
            $topAds = '';
        }
        
        if (empty($topAds)) {
            // Fallback to location-based system
            $topAds = \Botble\Ads\Facades\AdsManager::display('home-top', [], false);
        }
    ?>
    <?php if(!empty($topAds)): ?>
        <div class="home-ads-top" style="margin: 20px auto; max-width: 1200px; padding: 0 15px;">
            <?php echo $topAds; ?>

        </div>
    <?php endif; ?>
<?php endif; ?>

<?php echo Theme::content(); ?>


<?php if(is_plugin_active('ads') && function_exists('render_page_ads')): ?>
    <?php $bottomAds = render_page_ads('home', 'bottom'); ?>
    <?php if(!empty($bottomAds)): ?>
        <div class="home-ads-bottom" style="margin: 20px auto; max-width: 1200px; padding: 0 15px;">
            <?php echo $bottomAds; ?>

        </div>
    <?php endif; ?>
<?php endif; ?>

<?php echo Theme::partial('footer'); ?>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/layouts/homepage.blade.php ENDPATH**/ ?>