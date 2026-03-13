<?php

namespace Theme\Jobzilla\Http\Controllers;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\JobBoard\Models\Package;
use Botble\JobBoard\Models\UserNotification;
use Botble\JobBoard\Repositories\Interfaces\CategoryInterface;
use Botble\Location\Repositories\Interfaces\CityInterface;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Http\Controllers\PublicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Theme\Jobzilla\Http\Resources\CityResource;

class JobzillaController extends PublicController
{
    public function ajaxGetCities(Request $request, CityInterface $cityRepository, BaseHttpResponse $response)
    {
        // Force JSON response
        $request->headers->set('Accept', 'application/json');
        
        // Support both 'k' and 'keyword' parameters
        $keyword = BaseHelper::stringify($request->input('k')) ?: BaseHelper::stringify($request->input('keyword'));

        // Handle default_country parameter for initial load
        if ($request->has('default_country') && empty($keyword)) {
            // Return empty for now, or you can return popular cities
            return response()->json([
                'error' => false,
                'data' => [],
                'message' => null,
            ]);
        }

        // Only search if keyword is provided and has at least 2 characters
        if (empty($keyword) || strlen($keyword) < 2) {
            return response()->json([
                'error' => false,
                'data' => [],
                'message' => null,
            ]);
        }

        try {
            $cities = $cityRepository->filters($keyword, 20, ['state', 'country']);
            
            // Log for debugging
            \Log::info('[CITY_SEARCH] Search performed', [
                'keyword' => $keyword,
                'cities_count' => $cities->count(),
            ]);
            
            return response()->json([
                'error' => false,
                'data' => CityResource::collection($cities)->resolve(),
                'message' => null,
            ]);
        } catch (\Exception $e) {
            \Log::error('[CITY_SEARCH] Error searching cities', [
                'keyword' => $keyword,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return response()->json([
                'error' => false,
                'data' => [],
                'message' => null,
            ]);
        }
    }

    public function ajaxGetJobRoles(Request $request, CategoryInterface $categoryRepository, BaseHttpResponse $response)
    {
        // Accept fetch API requests (not just ajax/wantsJson)
        // Force JSON response
        $request->headers->set('Accept', 'application/json');
        
        $keyword = BaseHelper::stringify($request->input('k'));

        $categories = $categoryRepository->advancedGet([
            'condition' => [
                'status' => BaseStatusEnum::PUBLISHED,
            ],
            'order_by' => ['order' => 'ASC', 'created_at' => 'DESC'],
        ]);

        // If keyword is empty, return all categories (for dropdown on click)
        // Otherwise filter by keyword
        if (!empty($keyword) && strlen($keyword) >= 2) {
            $categories = $categories->filter(function ($category) use ($keyword) {
                return stripos($category->name, $keyword) !== false;
            });
        }

        $categories = $categories->take(100)->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
            ];
        });

        // Return JSON directly for fetch API compatibility
        return response()->json([
            'error' => false,
            'data' => $categories->values(),
            'message' => null,
        ]);
    }

    public function faq()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('FAQ'), route('public.faq'));

        return Theme::scope('faq')->render();
    }

    public function premiumService()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('Premium Service'), route('public.premium-service'));

        $account = Auth::guard('account')->user();
        $packageType = 'job-seeker'; // default when guest or job seeker
        if ($account && $account->isEmployer()) {
            $packageType = 'employer';
        }

        $packages = Package::query()
            ->wherePublished()
            ->where('package_type', $packageType)
            ->with('currency')
            ->orderBy('order')
            ->orderBy('id')
            ->get();

        return Theme::scope('premium-service', compact('packages', 'packageType'))->render();
    }

    public function forTeachers()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('For Teachers'), route('public.for-teachers'));

        return Theme::scope('for-teachers')->render();
    }

    public function forSchools()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('For Schools'), route('public.for-schools'));

        return Theme::scope('for-schools')->render();
    }

    public function startHiring()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('Start Hiring'), route('public.start-hiring'));

        return Theme::scope('start-hiring')->render();
    }

    public function careers()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('Careers'), route('public.careers'));

        return Theme::scope('careers')->render();
    }

    public function notifications()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('Notifications'), route('public.notifications'));

        $account = Auth::guard('account')->user();
        
        $notifications = collect([]);
        $unreadCount = 0;
        $readCount = 0;

        if ($account) {
            try {
                // Check if table exists before querying
                if (\Illuminate\Support\Facades\Schema::hasTable('jb_user_notifications')) {
                    $notifications = UserNotification::where('account_id', $account->id)
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->map(function ($notification) {
                            return [
                                'id' => $notification->id,
                                'type' => $notification->type,
                                'title' => $notification->title,
                                'message' => $notification->message,
                                'time' => $notification->created_at->diffForHumans(),
                                'read' => $notification->isRead(),
                                'icon' => $notification->icon,
                                'color' => $notification->color,
                                'action_url' => $notification->action_url,
                            ];
                        });

                    $unreadCount = UserNotification::where('account_id', $account->id)
                        ->whereNull('read_at')
                        ->count();
                    
                    $readCount = UserNotification::where('account_id', $account->id)
                        ->whereNotNull('read_at')
                        ->count();
                }
            } catch (\Exception $e) {
                \Log::error('Error fetching notifications: ' . $e->getMessage());
                // Continue with empty notifications if table doesn't exist
            }
        }

        return Theme::scope('notifications', compact('notifications', 'unreadCount', 'readCount'))->render();
    }
}
