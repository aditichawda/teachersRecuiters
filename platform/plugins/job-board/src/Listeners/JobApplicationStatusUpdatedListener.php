<?php

namespace Botble\JobBoard\Listeners;

use Botble\JobBoard\Events\JobApplicationStatusUpdatedEvent;
use Botble\JobBoard\Jobs\SendJobSeekerStatusUpdateJob;

class JobApplicationStatusUpdatedListener
{
    public function handle(JobApplicationStatusUpdatedEvent $event): void
    {
        // Dispatch email job for status update
        SendJobSeekerStatusUpdateJob::dispatch(
            $event->application,
            $event->job,
            $event->oldStatus,
            $event->newStatus
        );
    }
}
