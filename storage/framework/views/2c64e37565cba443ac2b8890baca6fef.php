<?php if($testimonials->count()): ?>
    <?php switch($shortcode->style):
        case ('style-7'): ?>
            <?php echo Theme::partial('shortcodes.testimonials.' . $shortcode->style, compact('shortcode', 'testimonials')); ?>

            <?php break; ?>
        <?php case ('style-8'): ?>
            <?php echo Theme::partial('shortcodes.testimonials.' . $shortcode->style, compact('shortcode', 'testimonials')); ?>

            <?php break; ?>
        <?php case ('style-2'): ?>
            <?php echo Theme::partial('shortcodes.testimonials.' . $shortcode->style, compact('shortcode', 'testimonials')); ?>

            <?php break; ?>
        <?php case ('style-3'): ?>
            <?php echo Theme::partial('shortcodes.testimonials.' . $shortcode->style, compact('shortcode', 'testimonials')); ?>

            <?php break; ?>
        <?php default: ?>
            <?php echo Theme::partial('shortcodes.testimonials.style-1', compact('shortcode', 'testimonials')); ?>

    <?php endswitch; ?>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/shortcodes/testimonials/index.blade.php ENDPATH**/ ?>