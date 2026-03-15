<?php

namespace Botble\JobBoard\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\JobBoard\Models\JobPostingAssistanceRequest;
use Botble\JobBoard\Tables\JobPostingAssistanceRequestTable;
use Illuminate\Http\Request;

class JobPostingAssistanceRequestController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/job-board::job-board.name'))
            ->add(__('Job Posting Assistance Requests'), route('job-posting-assistance-requests.index'));
    }

    public function index(JobPostingAssistanceRequestTable $table)
    {
        $this->pageTitle(__('Job Posting Assistance Requests'));

        if (request()->has('draw') || request()->ajax() || request()->wantsJson()) {
            return $table->ajax();
        }

        return $table->renderTable();
    }

    public function accept(Request $request, int $id)
    {
        $req = JobPostingAssistanceRequest::query()->with('company')->where('status', JobPostingAssistanceRequest::STATUS_PENDING)->findOrFail($id);

        $institutionName = $req->company ? $req->company->name : null;
        $req->update([
            'status' => JobPostingAssistanceRequest::STATUS_ACCEPTED,
            'accepted_at' => now(),
            'accepted_by' => auth()->id(),
            'institution_name' => $institutionName,
        ]);

        if ($request->expectsJson()) {
            return $this->httpResponse()->setMessage(__('Request accepted. Institution ID and name stored. You can create job for this institution.'));
        }
        return redirect()->route('job-posting-assistance-requests.index')->with('success_msg', __('Request accepted. Institution ID and name stored.'));
    }

    public function reject(Request $request, int $id)
    {
        $req = JobPostingAssistanceRequest::query()->where('status', JobPostingAssistanceRequest::STATUS_PENDING)->findOrFail($id);
        $req->update(['status' => JobPostingAssistanceRequest::STATUS_REJECTED]);
        if ($request->expectsJson()) {
            return $this->httpResponse()->setMessage(__('Request rejected.'));
        }
        return redirect()->route('job-posting-assistance-requests.index')->with('success_msg', __('Request rejected.'));
    }

    public function edit(int $id)
    {
        $item = JobPostingAssistanceRequest::query()->with(['account', 'company'])->findOrFail($id);
        $this->pageTitle(__('Edit Job Posting Assistance Request #:id', ['id' => $item->id]));
        return view('plugins/job-board::job-posting-assistance-requests.edit', compact('item'));
    }

    public function update(Request $request, int $id)
    {
        $item = JobPostingAssistanceRequest::query()->findOrFail($id);

        $request->validate([
            'status' => ['required', 'string', 'in:pending,accepted,rejected'],
            'message' => ['nullable', 'string', 'max:5000'],
            'institution_name' => ['nullable', 'string', 'max:255'],
        ]);

        $item->update([
            'status' => $request->input('status'),
            'message' => $request->input('message'),
            'institution_name' => $request->input('institution_name'),
        ]);

        return redirect()
            ->route('job-posting-assistance-requests.index')
            ->with('success_msg', __('Job posting assistance request updated.'));
    }

    public function destroy(int $id)
    {
        $item = JobPostingAssistanceRequest::query()->findOrFail($id);
        $item->delete();
        return $this->httpResponse()->setMessage(__('Request deleted.'));
    }
}
