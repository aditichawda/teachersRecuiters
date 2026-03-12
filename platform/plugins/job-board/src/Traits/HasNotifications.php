<?php

namespace Botble\JobBoard\Traits;

use Botble\JobBoard\Services\NotificationService;

trait HasNotifications
{
    /**
     * Get notification service instance
     */
    protected function getNotificationService(): NotificationService
    {
        return app(NotificationService::class);
    }

    /**
     * Send notification using notification service
     */
    protected function sendNotification($account, $method, ...$args)
    {
        $service = $this->getNotificationService();
        
        if (method_exists($service, $method)) {
            return call_user_func_array([$service, $method], array_merge([$account], $args));
        }
        
        return null;
    }
}
