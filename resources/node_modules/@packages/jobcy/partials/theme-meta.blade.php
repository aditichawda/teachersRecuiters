<style>
    :root {
        --primary-color: {{ theme_option('primary_color', '#5749cd') }};
        --primary-color-rgb: {{ implode(', ', BaseHelper::hexToRgb(theme_option('primary_color', '#5749cd'))) }};
    }
</style>
