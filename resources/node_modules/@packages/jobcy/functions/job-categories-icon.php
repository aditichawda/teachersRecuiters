<?php

use Botble\JobBoard\Facades\JobBoardHelper;

app()->booted(function (): void {
    if (is_plugin_active('job-board')) {
        JobBoardHelper::useCategoryIconImage();
    }
});
