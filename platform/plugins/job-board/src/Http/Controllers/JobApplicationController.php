<?php

namespace Botble\JobBoard\Http\Controllers;

use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\JobBoard\Forms\JobApplicationForm;
use Botble\JobBoard\Http\Requests\EditJobApplicationRequest;
use Botble\JobBoard\Models\JobApplication;
use Botble\JobBoard\Tables\JobApplicationTable;
use Botble\Media\Facades\RvMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Database\Eloquent\Builder;

class JobApplicationController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/job-board::job-board.name'))
            ->add(trans('plugins/job-board::job-application.name'), route('job-applications.index'));
    }

    public function index(JobApplicationTable $table)
    {
        $this->pageTitle(trans('plugins/job-board::job-application.name'));

        return $table->renderTable();
    }

    public function edit(JobApplication $jobApplication)
    {
        $this->pageTitle(trans('plugins/job-board::job-application.edit'));

        return JobApplicationForm::createFromModel($jobApplication)->renderForm();
    }

    public function update(JobApplication $jobApplication, EditJobApplicationRequest $request)
    {
        $jobApplication->fill($request->input());
        $jobApplication->save();

        event(new UpdatedContentEvent(JOB_APPLICATION_MODULE_SCREEN_NAME, $request, $jobApplication));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('job-applications.index'))
            ->withUpdatedSuccessMessage();
    }

    public function destroy(JobApplication $jobApplication)
    {
        return DeleteResourceAction::make($jobApplication);
    }

    public function downloadCv(JobApplication $application)
    {
        if (auth('account')->check()) {
            $account = auth('account')->user();
            $belongsToEmployer = JobApplication::query()
                ->where('id', $application->id)
                ->whereHas('job.company.accounts', fn (Builder $q) => $q->where('account_id', $account->getKey()))
                ->exists();
            if (! $belongsToEmployer) {
                abort(404);
            }
        }

        if ($application->resume) {
            return RvMedia::responseDownloadFile($application->resume);
        }

        $account = $application->account;

        if ($account->id && $account->resume) {
            return RvMedia::responseDownloadFile($account->resume);
        }

        abort(404);
    }

    /**
     * Export resumes of selected applicants as a ZIP (for employer account).
     */
    public function exportResumes(Request $request): StreamedResponse|\Illuminate\Http\Response
    {
        $account = auth('account')->user();
        if (! $account) {
            abort(404);
        }

        $ids = array_filter(array_map('intval', explode(',', (string) $request->query('ids', ''))));
        if (empty($ids)) {
            return response()->redirectToRoute('public.account.applicants.index')
                ->with('error_msg', trans('plugins/job-board::dashboard.select_applicants_to_export'));
        }

        $applications = JobApplication::query()
            ->whereIn('id', $ids)
            ->whereHas('job.company.accounts', fn (Builder $q) => $q->where('account_id', $account->getKey()))
            ->with(['job:id,name', 'account:id,resume'])
            ->get();

        $filesToAdd = [];
        foreach ($applications as $app) {
            $resumeUrl = $app->resume ?: ($app->account->resume ?? null);
            if (! $resumeUrl) {
                continue;
            }
            $realPath = RvMedia::getRealPath($resumeUrl);
            if ($realPath && File::exists($realPath)) {
                $ext = pathinfo($realPath, PATHINFO_EXTENSION) ?: 'pdf';
                $safeName = sprintf('%s_%s.%s', $app->id, preg_replace('/[^a-zA-Z0-9_-]/', '_', $app->full_name), $ext);
                $filesToAdd[$safeName] = $realPath;
            }
        }

        if (empty($filesToAdd)) {
            return response()->redirectToRoute('public.account.applicants.index')
                ->with('error_msg', trans('plugins/job-board::dashboard.no_resumes_to_export'));
        }

        $zipName = 'applicant-resumes-' . date('Y-m-d-His') . '.zip';

        return response()->streamDownload(function () use ($filesToAdd) {
            $zip = new ZipArchive();
            $tempPath = tempnam(sys_get_temp_dir(), 'resumes_');
            if ($zip->open($tempPath, ZipArchive::OVERWRITE | ZipArchive::CREATE) !== true) {
                return;
            }
            foreach ($filesToAdd as $entryName => $filePath) {
                $zip->addFile($filePath, $entryName);
            }
            $zip->close();
            echo file_get_contents($tempPath);
            @unlink($tempPath);
        }, $zipName, ['Content-Type' => 'application/zip']);
    }
}
