<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\JobBoard\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNotificationController extends BaseController
{
    public function read(Request $request, $id, BaseHttpResponse $response)
    {
        $account = Auth::guard('account')->user();
        
        if (!$account) {
            return $response->setError()->setMessage('Unauthorized');
        }

        $notification = UserNotification::where('id', $id)
            ->where('account_id', $account->id)
            ->firstOrFail();

        if (!$notification->isRead()) {
            $notification->markAsRead();
        }

        // If notification has action_url, redirect there
        if ($notification->action_url && $notification->action_url !== '#') {
            return redirect()->to(url($notification->action_url));
        }

        return $response->setMessage('Notification marked as read');
    }

    public function markAsRead(Request $request, $id, BaseHttpResponse $response)
    {
        $account = Auth::guard('account')->user();
        
        if (!$account) {
            return $response->setError()->setMessage('Unauthorized');
        }

        $notification = UserNotification::where('id', $id)
            ->where('account_id', $account->id)
            ->firstOrFail();

        $notification->markAsRead();

        return $response->setMessage('Notification marked as read');
    }

    public function markAllAsRead(Request $request, BaseHttpResponse $response)
    {
        $account = Auth::guard('account')->user();
        
        if (!$account) {
            return $response->setError()->setMessage('Unauthorized');
        }

        UserNotification::where('account_id', $account->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return $response->setMessage('All notifications marked as read');
    }

    public function delete(Request $request, $id, BaseHttpResponse $response)
    {
        $account = Auth::guard('account')->user();
        
        if (!$account) {
            return $response->setError()->setMessage('Unauthorized');
        }

        $notification = UserNotification::where('id', $id)
            ->where('account_id', $account->id)
            ->firstOrFail();

        $notification->delete();

        return $response->setMessage('Notification deleted');
    }

    public function deleteAll(Request $request, BaseHttpResponse $response)
    {
        $account = Auth::guard('account')->user();
        
        if (!$account) {
            return $response->setError()->setMessage('Unauthorized');
        }

        UserNotification::where('account_id', $account->id)->delete();

        return $response->setMessage('All notifications deleted');
    }

    public function countUnread(BaseHttpResponse $response)
    {
        $account = Auth::guard('account')->user();
        
        if (!$account) {
            return $response->setData(0);
        }

        $count = UserNotification::where('account_id', $account->id)
            ->whereNull('read_at')
            ->count();

        return $response->setData($count);
    }

    public function countUnread(BaseHttpResponse $response)
    {
        $account = Auth::guard('account')->user();
        
        if (!$account) {
            return $response->setData(0);
        }

        $count = UserNotification::where('account_id', $account->id)
            ->whereNull('read_at')
            ->count();

        return $response->setData($count);
    }
}
