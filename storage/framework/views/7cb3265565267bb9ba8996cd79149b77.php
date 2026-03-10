<?php echo Theme::partial('header'); ?>


<style>
/* Homepage Responsive Styles */
.homepage-container {
    width: 100%;
    max-width: 100%;
    overflow-x: hidden;
}

/* Responsive containers */
.container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

@media (max-width: 1199px) {
    .container {
        max-width: 960px;
        padding: 0 15px;
    }
}

@media (max-width: 991px) {
    .container {
        max-width: 720px;
        padding: 0 15px;
    }
}

@media (max-width: 767px) {
    .container {
        max-width: 540px;
        padding: 0 15px;
    }
}

@media (max-width: 575px) {
    .container {
        max-width: 100%;
        padding: 0 10px;
    }
}

/* Responsive rows and columns */
.row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}

/* [class*="col-"] {
    padding: 0 15px;
} */

@media (max-width: 767px) {
    [class*="col-"] {
        flex: 0 0 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }
}

/* Homepage sections responsive */
.section-full {
    padding: 60px 0;
}

@media (max-width: 991px) {
    .section-full {
        padding: 40px 0;
    }
}

@media (max-width: 767px) {
    .section-full {
        padding: 30px 0;
    }
}
</style>

<div class="homepage-container">
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


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Find testimonials section
    var testimonialsSection = document.querySelector('.twm-testimonial-1-area, .twm-testimonial-2-area, .twm-testimonial-page8-wrap');
    
    if (testimonialsSection) {
        // Find the container after header and ads
        var header = document.querySelector('header');
        var adsTop = document.querySelector('.home-ads-top');
        var insertAfter = adsTop ? adsTop : (header ? header : document.body);
        
        // Move testimonials section to top (after header/ads)
        if (insertAfter && insertAfter.nextSibling) {
            insertAfter.parentNode.insertBefore(testimonialsSection, insertAfter.nextSibling);
        } else if (insertAfter) {
            insertAfter.parentNode.appendChild(testimonialsSection);
        }
    }
});
</script>

<?php if(is_plugin_active('ads') && function_exists('render_page_ads')): ?>
    <?php $bottomAds = render_page_ads('home', 'bottom'); ?>
    <?php if(!empty($bottomAds)): ?>
        <div class="home-ads-bottom" style="margin: 20px auto; max-width: 1200px; padding: 0 15px;">
            <?php echo $bottomAds; ?>

        </div>
    <?php endif; ?>
<?php endif; ?>

</div>

<?php echo Theme::partial('footer'); ?>

<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/layouts/homepage.blade.php ENDPATH**/ ?>