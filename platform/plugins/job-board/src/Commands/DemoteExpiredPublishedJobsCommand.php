<?php

namespace Botble\JobBoard\Commands;

use Botble\JobBoard\Enums\JobStatusEnum;
use Botble\JobBoard\Models\Job;
use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    'cms:job-board:demote-expired-published-jobs',
    'Set job status to pending when the effective deadline has passed (published jobs only; moderation unchanged)'
)]
class DemoteExpiredPublishedJobsCommand extends Command
{
    public function handle(): int
    {
        $updated = Job::query()
            ->where('status', JobStatusEnum::PUBLISHED)
            ->expired()
            ->update(['status' => JobStatusEnum::PENDING]);

        $this->components->info(sprintf('Updated %s expired published job(s) to pending.', number_format((int) $updated)));

        return self::SUCCESS;
    }
}
