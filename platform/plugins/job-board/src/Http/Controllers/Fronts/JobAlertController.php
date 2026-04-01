<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Http\Requests\JobAlertRequest;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\JobAlert;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Http\Request;

class JobAlertController extends BaseController
{
    public function __construct()
    {
        $this->middleware(function (Request $request, \Closure $next) {
            abort_unless(auth('account')->check() && auth('account')->user()->type == AccountTypeEnum::JOB_SEEKER, 403);
            return $next($request);
        });
    }

    public function index()
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $alerts = JobAlert::query()
            ->where('account_id', $account->id)
            ->with(['jobCategory', 'jobType', 'city', 'state', 'country'])
            ->latest()
            ->get();

        $this->pageTitle(trans('plugins/job-board::job-alert.name'));
        SeoHelper::setTitle(trans('plugins/job-board::job-alert.name'));

        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.my_profile'), route('public.account.dashboard'))
            ->add(trans('plugins/job-board::job-alert.name'));

        return view(JobBoardHelper::viewPath('dashboard.job-alerts.index'), compact('alerts'));
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/job-board::job-alert.create'));
        SeoHelper::setTitle(trans('plugins/job-board::job-alert.create'));

        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.my_profile'), route('public.account.dashboard'))
            ->add(trans('plugins/job-board::job-alert.name'), route('public.account.job-alerts.index'))
            ->add(trans('plugins/job-board::job-alert.create'));

        return view(JobBoardHelper::viewPath('dashboard.job-alerts.create'));
    }

    public function store(JobAlertRequest $request)
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $alert = JobAlert::query()->create(array_merge($request->input(), [
            'account_id' => $account->id,
        ]));

        event(new CreatedContentEvent('job-alert', $request, $alert));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('public.account.job-alerts.index'))
            ->setNextUrl(route('public.account.job-alerts.edit', $alert->id))
            ->setMessage(trans('plugins/job-board::job-alert.created_successfully'));
    }

    public function edit(int|string $id)
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $alert = JobAlert::query()
            ->where('id', $id)
            ->where('account_id', $account->id)
            ->firstOrFail();

        $this->pageTitle(trans('plugins/job-board::job-alert.edit'));
        SeoHelper::setTitle(trans('plugins/job-board::job-alert.edit'));

        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.my_profile'), route('public.account.dashboard'))
            ->add(trans('plugins/job-board::job-alert.name'), route('public.account.job-alerts.index'))
            ->add(trans('plugins/job-board::job-alert.edit'));

        return view(JobBoardHelper::viewPath('dashboard.job-alerts.edit'), compact('alert'));
    }

    public function update(int|string $id, JobAlertRequest $request)
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $alert = JobAlert::query()
            ->where('id', $id)
            ->where('account_id', $account->id)
            ->firstOrFail();

        $alert->fill($request->input());
        $alert->save();

        event(new UpdatedContentEvent('job-alert', $request, $alert));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('public.account.job-alerts.index'))
            ->setMessage(trans('plugins/job-board::job-alert.updated_successfully'));
    }

    public function destroy(int|string $id, Request $request)
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $alert = JobAlert::query()
            ->where('id', $id)
            ->where('account_id', $account->id)
            ->firstOrFail();

        $alert->delete();

        event(new DeletedContentEvent('job-alert', $request, $alert));

        return $this
            ->httpResponse()
            ->setMessage(trans('plugins/job-board::job-alert.deleted_successfully'));
    }

    public function toggle(int|string $id)
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $alert = JobAlert::query()
            ->where('id', $id)
            ->where('account_id', $account->id)
            ->firstOrFail();

        $alert->is_active = !$alert->is_active;
        $alert->save();

        return $this
            ->httpResponse()
            ->setMessage($alert->is_active 
                ? trans('plugins/job-board::job-alert.activated_successfully')
                : trans('plugins/job-board::job-alert.deactivated_successfully'));
    }
}
