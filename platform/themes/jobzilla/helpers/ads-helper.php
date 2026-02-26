<?php

use Botble\Ads\Facades\AdsManager;

if (!function_exists('display_ads_by_page')) {
    /**
     * Display ads based on page type and position
     *
     * @param string $pageType (home, jobs, job-detail, candidates, etc.)
     * @param string $position (top, sidebar-left, sidebar-right, between-content, bottom, etc.)
     * @param array $attributes Additional HTML attributes
     * @return string
     */
    function display_ads_by_page(string $pageType, string $position, array $attributes = []): string
    {
        if (!is_plugin_active('ads')) {
            return '';
        }

        return AdsManager::displayByPageAndPosition($pageType, $position, $attributes);
    }
}

if (!function_exists('get_current_page_type')) {
    /**
     * Get current page type based on route
     *
     * @return string
     */
    function get_current_page_type(): string
    {
        $route = request()->route()->getName() ?? '';
        
        if (str_contains($route, 'job-board.jobs') || str_contains($route, 'jobs')) {
            if (str_contains($route, 'detail') || str_contains($route, 'show')) {
                return 'job-detail';
            }
            return 'jobs';
        }
        
        if (str_contains($route, 'candidates') || str_contains($route, 'candidate')) {
            if (str_contains($route, 'detail') || str_contains($route, 'show')) {
                return 'candidate-detail';
            }
            return 'candidates';
        }
        
        if (str_contains($route, 'company')) {
            if (str_contains($route, 'detail') || str_contains($route, 'show')) {
                return 'company-detail';
            }
            return 'company';
        }
        
        if (str_contains($route, 'for-schools')) {
            return 'for-schools';
        }
        
        if (str_contains($route, 'for-teachers')) {
            return 'for-teachers';
        }
        
        if (str_contains($route, 'dashboard') || str_contains($route, 'account')) {
            return 'dashboard';
        }
        
        if (str_contains($route, 'settings')) {
            return 'settings';
        }
        
        // Default to home
        return 'home';
    }
}
