<?php
    $tabs = [];
    $quantity = min((int) $shortcode->quantity, 20);
    if ($quantity) {
        for ($i = 1; $i <= $quantity; $i++) {
            if ($title = $shortcode->{'title_' . $i}) {
                $tabs[] = [
                    'title' => $title,
                    'count' => $shortcode->{'count_' . $i},
                    'extra' => $shortcode->{'extra_' . $i},
                ];
            }
        }
    }

    $style = in_array($shortcode->style, ['style-1', 'style-2', 'style-3', 'style-7', 'style-8']) ? $shortcode->style : 'style-1';
?>

<?php echo Theme::partial('shortcodes.featured-companies.' . $style, compact('shortcode', 'companies', 'tabs')); ?>

<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/shortcodes/featured-companies/index.blade.php ENDPATH**/ ?>