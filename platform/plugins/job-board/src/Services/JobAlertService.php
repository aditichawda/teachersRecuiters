<?php

namespace Botble\JobBoard\Services;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\JobBoard\Enums\JobStatusEnum;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\JobAlert;
use Illuminate\Database\Eloquent\Builder;

class JobAlertService
{
    public function findMatchingJobs(JobAlert $alert): \Illuminate\Database\Eloquent\Collection
    {
        $query = Job::query()
            ->where('status', JobStatusEnum::PUBLISHED)
            ->where('moderation_status', BaseStatusEnum::PUBLISHED);

        // Keywords search
        if ($alert->keywords) {
            $keywords = array_filter(array_map('trim', explode(',', $alert->keywords)));
            if (!empty($keywords)) {
                $query->where(function ($q) use ($keywords): void {
                    foreach ($keywords as $keyword) {
                        $q->orWhere('name', 'LIKE', "%{$keyword}%")
                            ->orWhere('description', 'LIKE', "%{$keyword}%")
                            ->orWhere('content', 'LIKE', "%{$keyword}%");
                    }
                });
            }
        }

        // Category filter
        if ($alert->job_category_id) {
            $query->whereHas('categories', function ($q) use ($alert): void {
                $q->where('jb_categories.id', $alert->job_category_id);
            });
        }

        // Job Type filter
        if ($alert->job_type_id) {
            $query->whereHas('jobTypes', function ($q) use ($alert): void {
                $q->where('jb_job_types.id', $alert->job_type_id);
            });
        }

        // Location filters
        if ($alert->city_id) {
            $query->where('city_id', $alert->city_id);
        } elseif ($alert->state_id) {
            $query->where('state_id', $alert->state_id);
        } elseif ($alert->country_id) {
            $query->where('country_id', $alert->country_id);
        }

        // Salary range filter
        if ($alert->salary_from || $alert->salary_to) {
            $query->where(function ($q) use ($alert): void {
                if ($alert->salary_from) {
                    $q->where(function ($subQ) use ($alert): void {
                        $subQ->whereNull('salary_to')
                            ->orWhere('salary_to', '>=', $alert->salary_from);
                    });
                }
                if ($alert->salary_to) {
                    $q->where(function ($subQ) use ($alert): void {
                        $subQ->whereNull('salary_from')
                            ->orWhere('salary_from', '<=', $alert->salary_to);
                    });
                }
            });
        }

        return $query->latest()->get();
    }
}
