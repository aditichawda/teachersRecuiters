<?php

namespace Botble\JobBoard\Providers;

use Botble\JobBoard\Commands\CheckExpiredJobsSoonCommand;
use Botble\JobBoard\Commands\DemoteExpiredPublishedJobsCommand;
use Botble\JobBoard\Commands\ExpirePackageFeaturedCommand;
use Botble\JobBoard\Commands\RenewJobsCommand;
use Botble\JobBoard\Commands\SyncJobApplicantsCountCommand;
use Botble\JobBoard\Commands\SyncPackageFeaturedCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            RenewJobsCommand::class,
            CheckExpiredJobsSoonCommand::class,
            SyncJobApplicantsCountCommand::class,
            ExpirePackageFeaturedCommand::class,
            SyncPackageFeaturedCommand::class,
        ]);

        $this->app->afterResolving(Schedule::class, function (Schedule $schedule): void {
            $schedule->command(RenewJobsCommand::class)->dailyAt('23:30');
            $schedule->command(CheckExpiredJobsSoonCommand::class)->dailyAt('23:30');
            $schedule->command(SyncPackageFeaturedCommand::class)->dailyAt('00:10');
            $schedule->command(ExpirePackageFeaturedCommand::class)->dailyAt('00:15');
            $schedule->command(DemoteExpiredPublishedJobsCommand::class)->hourly();
        });
    }
}
