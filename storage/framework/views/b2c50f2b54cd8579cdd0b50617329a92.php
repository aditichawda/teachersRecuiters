<?php
    $tabs = [];
    $quantity = min((int) $shortcode->quantity, 20);
    if ($quantity) {
        for ($i = 1; $i <= $quantity; $i++) {
            if ($title = $shortcode->{'title_' . $i}) {
                $tabs[] = [
                    'title' => $shortcode->{'title_' . $i},
                    'image' => $shortcode->{'image_' . $i},
                ];
            }
        }
    }
    $style = in_array($shortcode->style, ['style-1', 'style-7', 'list']) ? $shortcode->style : 'style-1';
?>

<?php echo $__env->make(Theme::getThemeNamespace('partials.shortcodes.candidates.' . $style), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/shortcodes/candidates/index.blade.php ENDPATH**/ ?>