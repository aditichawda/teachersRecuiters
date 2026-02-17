<?php

namespace Botble\JobBoard\Commands;

use Botble\JobBoard\Models\Job;
use Illuminate\Console\Command;

class SyncJobApplicantsCountCommand extends Command
{
    protected $signature = 'job-board:sync-applicants-count';

    protected $description = 'Sync number_of_applied on jobs with actual applicants count';

    public function handle(): int
    {
        $updated = 0;
        $jobs = Job::query()->withCount('applicants')->get();

        foreach ($jobs as $job) {
            $actual = (int) $job->applicants_count;
            if ((int) $job->number_of_applied !== $actual) {
                $old = (int) $job->number_of_applied;
                $job->update(['number_of_applied' => $actual]);
                $updated++;
                $this->info("Job #{$job->id} ({$job->name}): {$old} → {$actual}");
            }
        }

        $this->info("Updated {$updated} job(s).");

        return self::SUCCESS;
    }
}
