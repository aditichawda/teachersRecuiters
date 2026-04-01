<?php

namespace Botble\Page\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Page\Models\Page;
use Botble\Page\Services\PageService;
use Botble\Slug\Facades\SlugHelper;
use Botble\Theme\Events\RenderingSingleEvent;
use Botble\Theme\Facades\Theme;

class PublicController extends BaseController
{
    public function getPage(string $slug, PageService $pageService)
    {
        try {
            $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Page::class));

            abort_unless($slug, 404);

            $data = $pageService->handleFrontRoutes($slug);

            // Check if redirect is needed (for candidates page)
            if (isset($data['redirect']) && $data['redirect'] === true && isset($data['url'])) {
                // Use simple redirect instead of guest() to avoid session issues on back navigation
                return redirect($data['url']);
            }

            // Ensure data is an array before accessing keys
            if (!is_array($data)) {
                abort(500, 'Invalid page data returned');
            }

            if (isset($data['slug']) && $data['slug'] !== $slug->key) {
                return redirect()->to(url(SlugHelper::getPrefix(Page::class) . '/' . $data['slug']));
            }

            event(new RenderingSingleEvent($slug));

            return Theme::scope($data['view'], $data['data'], $data['default_view'])->render();
        } catch (\Exception $e) {
            \Log::error('Error in PublicController::getPage: ' . $e->getMessage(), [
                'slug' => $slug ?? 'unknown',
                'trace' => $e->getTraceAsString()
            ]);
            
            // Re-throw the exception to show proper error page
            throw $e;
        }
    }
}
