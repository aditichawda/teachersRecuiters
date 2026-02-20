<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Enums\JobApplicationStatusEnum;
use Botble\JobBoard\Events\JobApplicationStatusUpdatedEvent;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Forms\Fronts\ApplicantForm;
use Botble\JobBoard\Http\Requests\EditJobApplicationRequest;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\JobApplication;
use Botble\JobBoard\Tables\Fronts\ApplicantTable;
use Botble\SeoHelper\Facades\SeoHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ApplicantController extends BaseController
{
    public function index(ApplicantTable $table)
    {
        $this->pageTitle(trans('plugins/job-board::messages.applicants'));

        return $table->render(JobBoardHelper::viewPath('dashboard.table.base'), [], [
            'layout' => 'plugins/job-board::themes.dashboard.layouts.master',
        ]);
    }

    public function edit(int|string $applicant)
    {
        $id = $applicant instanceof JobApplication ? $applicant->getKey() : $applicant;
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $jobApplication = JobApplication::query()
            ->select(['*'])
            ->whereHas('job.company.accounts', function (Builder $query) use ($account): void {
                $query->where('account_id', $account->getKey());
            })
            ->with(['account', 'job.screeningQuestions'])
            ->where('id', $id)
            ->firstOrFail();

        $title = trans('plugins/job-board::messages.view_applicant', ['name' => $jobApplication->full_name]);

        $this->pageTitle($title);

        SeoHelper::setTitle($title);

        return ApplicantForm::createFromModel($jobApplication)->renderForm();
    }

    public function update(int|string $applicant, EditJobApplicationRequest $request): RedirectResponse|Response
    {
        $id = $applicant instanceof JobApplication ? $applicant->getKey() : $applicant;
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        try {
            $jobApplication = JobApplication::query()
                ->select(['*'])
                ->whereHas('job.company.accounts', function (Builder $query) use ($account): void {
                    $query->where('account_id', $account->getKey());
                })
                ->with(['job'])
                ->where('id', $id)
                ->firstOrFail();

            $oldStatus = $jobApplication->status ?? JobApplicationStatusEnum::PENDING();

            $jobApplication->fill($request->only(['status']));
            $jobApplication->save();

            $newStatus = $jobApplication->status ?? JobApplicationStatusEnum::PENDING();
            if ($oldStatus->getValue() !== $newStatus->getValue()) {
                try {
                    JobApplicationStatusUpdatedEvent::dispatch(
                        $jobApplication,
                        $jobApplication->job,
                        $oldStatus,
                        $newStatus
                    );
                } catch (\Throwable $e) {
                    Log::warning('JobApplicationStatusUpdatedEvent failed: ' . $e->getMessage());
                    report($e);
                }
            }

            try {
                event(new UpdatedContentEvent(JOB_APPLICATION_MODULE_SCREEN_NAME, $request, $jobApplication));
            } catch (\Throwable $e) {
                Log::warning('UpdatedContentEvent failed: ' . $e->getMessage());
                report($e);
            }
        } catch (\Throwable $e) {
            Log::error('Applicant update failed: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'error' => true,
                    'message' => trans('core/base::notices.update_failed_message'),
                ], 422);
            }
            return redirect()
                ->to(route('public.account.applicants.edit', $id))
                ->with('error_msg', trans('core/base::notices.update_failed_message'))
                ->withInput();
        }

        $successMessage = trans('core/base::notices.update_success_message');

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'error' => false,
                'message' => $successMessage,
            ]);
        }

        return redirect()
            ->to(route('public.account.applicants.edit', $id))
            ->with('success_msg', $successMessage);
    }

    public function destroy(int|string $applicant)
    {
        $id = $applicant instanceof JobApplication ? $applicant->getKey() : $applicant;
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $jobApplication = JobApplication::query()
            ->select(['*'])
            ->whereHas('job.company.accounts', function (Builder $query) use ($account): void {
                $query->where('account_id', $account->getKey());
            })
            ->where('id', $id)
            ->firstOrFail();

        return DeleteResourceAction::make($jobApplication);
    }
}
