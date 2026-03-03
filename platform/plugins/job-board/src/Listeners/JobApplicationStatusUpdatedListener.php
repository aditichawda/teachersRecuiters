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
        // Dispatch email job for candidate (job seeker) status update
        SendJobSeekerStatusUpdateJob::dispatch(
            $event->application,
            $event->job,
            $event->oldStatus,
            $event->newStatus
        );

        // Dispatch WhatsApp job for candidate (job seeker) status update
        SendJobSeekerStatusUpdateWhatsAppJob::dispatch(
            $event->application,
            $event->job,
            $event->oldStatus,
            $event->newStatus
        );

        // Dispatch email job for company notification about status update
        SendCompanyStatusUpdateNotificationJob::dispatch(
            $event->application,
            $event->job,
            $event->oldStatus,
            $event->newStatus
        );
    }
}
