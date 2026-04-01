<?php

namespace Botble\JobBoard\Listeners;

use Botble\JobBoard\Events\JobApplicationStatusUpdatedEvent;
use Botble\JobBoard\Jobs\SendJobSeekerStatusUpdateJob;
use Botble\JobBoard\Jobs\SendCompanyStatusUpdateNotificationJob;
use Botble\JobBoard\Jobs\SendJobSeekerStatusUpdateWhatsAppJob;

class JobApplicationStatusUpdatedListener
{
    public function handle(JobApplicationStatusUpdatedEvent $event): void
    {
        // Safe logging - handle enum serialization
        $oldStatusValue = ($event->oldStatus instanceof \Botble\JobBoard\Enums\JobApplicationStatusEnum) 
            ? $event->oldStatus->getValue() 
            : (is_string($event->oldStatus) ? $event->oldStatus : 'unknown');
        $newStatusValue = ($event->newStatus instanceof \Botble\JobBoard\Enums\JobApplicationStatusEnum) 
            ? $event->newStatus->getValue() 
            : (is_string($event->newStatus) ? $event->newStatus : 'unknown');
        
        \Log::info('[STATUS_UPDATE_DEBUG] Listener triggered', [
            'application_id' => $event->application->id,
            'job_id' => $event->job->id,
            'old_status' => $oldStatusValue,
            'new_status' => $newStatusValue,
            'old_status_type' => is_object($event->oldStatus) ? get_class($event->oldStatus) : gettype($event->oldStatus),
            'new_status_type' => is_object($event->newStatus) ? get_class($event->newStatus) : gettype($event->newStatus),
        ]);

        // Dispatch email job for candidate (job seeker) status update
        try {
            SendJobSeekerStatusUpdateJob::dispatch(
                $event->application,
                $event->job,
                $event->oldStatus,
                $event->newStatus
            );
            \Log::info('[STATUS_UPDATE_DEBUG] Email job dispatched', [
                'application_id' => $event->application->id,
            ]);
        } catch (\Throwable $e) {
            \Log::error('[STATUS_UPDATE_DEBUG] Email job dispatch failed', [
                'application_id' => $event->application->id,
                'error' => $e->getMessage(),
            ]);
        }

        // Dispatch WhatsApp job for candidate (job seeker) status update
        try {
            SendJobSeekerStatusUpdateWhatsAppJob::dispatch(
                $event->application,
                $event->job,
                $event->oldStatus,
                $event->newStatus
            );
            $newStatusForLog = ($event->newStatus instanceof \Botble\JobBoard\Enums\JobApplicationStatusEnum) 
                ? $event->newStatus->getValue() 
                : (is_string($event->newStatus) ? $event->newStatus : 'unknown');
            
            \Log::info('[STATUS_UPDATE_DEBUG] WhatsApp job dispatched', [
                'application_id' => $event->application->id,
                'new_status' => $newStatusForLog,
            ]);
        } catch (\Throwable $e) {
            \Log::error('[STATUS_UPDATE_DEBUG] WhatsApp job dispatch failed', [
                'application_id' => $event->application->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }

        // DISABLED: Company notification email - employer ko email nahi bhejna hai
        // Only job seeker (candidate) ko email aur WhatsApp notification jayega
        // Uncomment below code if employer notification is needed in future
        /*
        try {
            SendCompanyStatusUpdateNotificationJob::dispatch(
                $event->application,
                $event->job,
                $event->oldStatus,
                $event->newStatus
            );
            \Log::info('[STATUS_UPDATE_DEBUG] Company notification job dispatched', [
                'application_id' => $event->application->id,
            ]);
        } catch (\Throwable $e) {
            \Log::error('[STATUS_UPDATE_DEBUG] Company notification job dispatch failed', [
                'application_id' => $event->application->id,
                'error' => $e->getMessage(),
            ]);
        }
        */
    }
}
