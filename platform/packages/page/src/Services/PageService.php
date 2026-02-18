<?php

namespace Botble\Page\Services;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Supports\RepositoryHelper;
use Botble\Media\Facades\RvMedia;
use Botble\Page\Models\Page;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Slug\Models\Slug;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class PageService
{
    public function handleFrontRoutes(Slug|array|null $slug): Slug|array
    {
        if ($slug && (! $slug instanceof Slug || $slug->reference_type !== Page::class)) {
            return $slug;
        }

        $condition = [
            'id' => $slug ? $slug->reference_id : BaseHelper::getHomepageId(),
            'status' => BaseStatusEnum::PUBLISHED,
        ];

        if (Auth::guard()->check() && request()->input('preview')) {
            Arr::forget($condition, 'status');
        }

        $page = Page::query()
            ->where($condition)
            ->with(['slugable', 'metadata']);

        $page = RepositoryHelper::applyBeforeExecuteQuery($page, new Page(), true)->first();

        if (empty($page)) {
            if (! $slug || $slug->reference_id == BaseHelper::getHomepageId()) {
                return [];
            }

            abort(404);
        }

        if (! BaseHelper::isHomepage($page->getKey())) {
            SeoHelper::setTitle($page->name)
                ->setDescription($page->description);

            Theme::breadcrumb()->add($page->name, $page->url);
        } else {
            $siteTitle = theme_option('seo_title') ?: Theme::getSiteTitle();
            $seoDescription = theme_option('seo_description');

            SeoHelper::setTitle($siteTitle)
                ->setDescription($seoDescription);
        }

        if ($page->image) {
            SeoHelper::openGraph()->setImage(RvMedia::getImageUrl($page->image));
        }

        SeoHelper::openGraph()->setUrl($page->url);
        SeoHelper::openGraph()->setType('article');

        SeoHelper::meta()->setUrl($page->url);

        if ($page->template) {
            Theme::uses(Theme::getThemeName())
                ->layout($page->template);
        }

        if (function_exists('admin_bar')) {
            admin_bar()
                ->registerLink(
                    trans('packages/page::pages.edit_this_page'),
                    route('pages.edit', $page->getKey()),
                    null,
                    'pages.edit'
                );
        }

        if (function_exists('shortcode')) {
            shortcode()->getCompiler()->setEditLink(route('pages.edit', $page->getKey()), 'pages.edit');
        }

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, PAGE_MODULE_SCREEN_NAME, $page);

        // Check if candidates page - only allow employers
        $isCandidatesPage = $page->slug === 'candidates' || str_contains($page->content ?? '', '[job-board-candidates');
        if ($isCandidatesPage && function_exists('auth')) {
            try {
                $account = auth('account')->user();
                if (!$account || !method_exists($account, 'isEmployer') || !$account->isEmployer()) {
                    // Prevent redirect loop - if already on login page or has redirect parameter, just return 403
                    $currentPath = request()->path();
                    $hasRedirectParam = request()->has('redirect');
                    $loginPath = 'login';
                    
                    if (str_contains($currentPath, $loginPath) || request()->routeIs('public.account.login') || $hasRedirectParam) {
                        abort(403, __('Only employers can view candidates. Please login as an employer.'));
                    }
                    
                    // Return special flag for controller to handle redirect
                    $redirectUrl = route('public.account.login');
                    $currentUrl = request()->url(); // Use url() instead of fullUrl() to avoid query string issues
                    
                    // Only add redirect parameter if current URL is different and doesn't already have redirect param
                    if ($currentUrl && $currentUrl !== $redirectUrl && !$hasRedirectParam) {
                        // Clean the URL to remove any existing query parameters to avoid nested redirects
                        $cleanUrl = strtok($currentUrl, '?');
                        if ($cleanUrl) {
                            $redirectUrl .= '?redirect=' . urlencode($cleanUrl);
                        }
                    }
                    
                    return [
                        'redirect' => true,
                        'url' => $redirectUrl,
                    ];
                }
            } catch (\Exception $e) {
                // If there's any error in auth check, log it but don't break the page
                \Log::warning('Error checking candidates page access: ' . $e->getMessage());
                // Continue to show the page - the shortcode will handle the access check
            }
        }

        return [
            'view' => 'page',
            'default_view' => 'packages/page::themes.page',
            'data' => compact('page'),
            'slug' => $page->slug,
        ];
    }
}
