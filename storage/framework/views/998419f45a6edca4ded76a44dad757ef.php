<fieldset class="form-fieldset">
    <h3><?php echo e(trans('plugins/ads::ads.settings.google_adsense_unit_ads_where_to_get_client_id')); ?></h3>

    <p><?php echo BaseHelper::clean(trans('plugins/ads::ads.settings.google_adsense_unit_ads_guide_to_get_client_id')); ?></p>

    <p><?php echo e(trans('plugins/ads::ads.settings.google_adsense_unit_ads_guide_example_snippet')); ?></p>

<pre><code>&lt;script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-123456789"
    crossorigin="anonymous"&gt;&lt;/script&gt;
&lt;ins class="adsbygoogle"
    style="display:block"
    data-ad-client="ca-pub-123456789
    data-ad-slot="123456789"
    data-ad-format="auto"&gt;&lt;/ins&gt;
&lt;script&gt;
    (adsbygoogle = window.adsbygoogle || []).push({});
&lt;/script&gt;</code></pre>
</fieldset>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/plugins/ads/resources/views/partials/google-adsense/client-id.blade.php ENDPATH**/ ?>