<?php
    $tabs = [];
    $quantity = min((int) $shortcode->quantity, 20);
    if ($quantity) {
        for ($i = 1; $i <= $quantity; $i++) {
            $tabs[] = [
                'title' => $shortcode->{'title_' . $i},
                'count' => $shortcode->{'count_' . $i},
                'image' => $shortcode->{'image_' . $i},
                'extra' => $shortcode->{'extra_' . $i},
                'color' => Arr::random(['green', 'sky', 'pink']),
            ];
        }
    }
    $style = in_array($shortcode->style, ['style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6', 'style-7', 'style-8']) ? $shortcode->style : 'style-1';
?>

<?php echo Theme::partial('shortcodes.hero-banner.' . $style, compact('shortcode', 'tabs', 'jobCategories')); ?>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/shortcodes/hero-banner/index.blade.php ENDPATH**/ ?>