<?php

use Botble\Ads\Facades\AdsManager;

if (is_plugin_active('ads')) {
    // Register ad locations for various pages and positions
    AdsManager::registerLocation('home-top', 'Home Page - Top');
    AdsManager::registerLocation('home-sidebar', 'Home Page - Sidebar');
    AdsManager::registerLocation('home-between', 'Home Page - Between Content');
    AdsManager::registerLocation('home-bottom', 'Home Page - Bottom');
    
    AdsManager::registerLocation('jobs-top', 'Jobs Page - Top');
    AdsManager::registerLocation('jobs-sidebar', 'Jobs Page - Sidebar');
    AdsManager::registerLocation('jobs-between', 'Jobs Page - Between Content');
    AdsManager::registerLocation('jobs-bottom', 'Jobs Page - Bottom');
    
    AdsManager::registerLocation('job-detail-top', 'Job Detail - Top');
    AdsManager::registerLocation('job-detail-sidebar', 'Job Detail - Sidebar');
    AdsManager::registerLocation('job-detail-bottom', 'Job Detail - Bottom');
    
    AdsManager::registerLocation('candidates-top', 'Candidates Page - Top');
    AdsManager::registerLocation('candidates-sidebar', 'Candidates Page - Sidebar');
    AdsManager::registerLocation('candidates-between', 'Candidates Page - Between Content');
    AdsManager::registerLocation('candidates-bottom', 'Candidates Page - Bottom');
    
    AdsManager::registerLocation('candidate-detail-sidebar', 'Candidate Detail - Sidebar');
    
    AdsManager::registerLocation('company-sidebar', 'Company Page - Sidebar');
    AdsManager::registerLocation('company-detail-sidebar', 'Company Detail - Sidebar');
    
    AdsManager::registerLocation('for-schools-top', 'For Schools Page - Top');
    AdsManager::registerLocation('for-schools-sidebar', 'For Schools Page - Sidebar');
    AdsManager::registerLocation('for-schools-bottom', 'For Schools Page - Bottom');
    
    AdsManager::registerLocation('for-teachers-top', 'For Teachers Page - Top');
    AdsManager::registerLocation('for-teachers-sidebar', 'For Teachers Page - Sidebar');
    AdsManager::registerLocation('for-teachers-bottom', 'For Teachers Page - Bottom');
    
    AdsManager::registerLocation('dashboard-sidebar', 'Dashboard - Sidebar');
    AdsManager::registerLocation('dashboard-top', 'Dashboard - Top');
}
