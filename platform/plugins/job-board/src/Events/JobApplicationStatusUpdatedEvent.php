<?php

namespace Botble\JobBoard\Events;

use Botble\JobBoard\Enums\JobApplicationStatusEnum;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\JobApplication;
use Illuminate\Foundation\Events\Dispatchable;

class JobApplicationStatusUpdatedEvent
{
    use Dispatchable;

    public function __construct(
        public JobApplication $application,
        public Job $job,
        public JobApplicationStatusEnum $oldStatus,
        public JobApplicationStatusEnum $newStatus
    ) {
    }
}
