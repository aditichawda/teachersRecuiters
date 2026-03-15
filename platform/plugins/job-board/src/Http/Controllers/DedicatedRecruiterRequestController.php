<?php

namespace Botble\JobBoard\Http\Controllers;

use Botble\ACL\Models\User;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\JobBoard\Models\CreditConsumption;
use Botble\JobBoard\Models\DedicatedRecruiterRequest;
use Botble\JobBoard\Tables\DedicatedRecruiterRequestTable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DedicatedRecruiterRequestController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/job-board::job-board.name'))
            ->add(__('Dedicated Recruiter Requests'), route('dedicated-recruiter-requests.index'));
    }

    public function index(DedicatedRecruiterRequestTable $table)
    {
        $this->pageTitle(__('Dedicated Recruiter Requests'));

        if (request()->has('draw') || request()->ajax() || request()->wantsJson()) {
            return $table->ajax();
        }

        return $table->renderTable();
    }

    public function accept(Request $request, int $id)
    {
        $req = DedicatedRecruiterRequest::query()->where('status', DedicatedRecruiterRequest::STATUS_PENDING)->findOrFail($id);

        $start = Carbon::now();
        $end = Carbon::now()->addMonths($req->duration_months);
        $req->update([
            'status' => DedicatedRecruiterRequest::STATUS_ACCEPTED,
            'accepted_at' => now(),
            'accepted_by' => auth()->id(),
            'start_date' => $start,
            'end_date' => $end,
            'staff_id' => $request->input('staff_id'),
        ]);

        if ($request->expectsJson()) {
            return $this->httpResponse()->setMessage(__('Request accepted.'));
        }
        return redirect()->route('dedicated-recruiter-requests.index')->with('success_msg', __('Request accepted.'));
    }

    public function reject(Request $request, int $id)
    {
        $req = DedicatedRecruiterRequest::query()->where('status', 'pending')->findOrFail($id);
        $req->update(['status' => DedicatedRecruiterRequest::STATUS_REJECTED]);
        if ($request->expectsJson()) {
            return $this->httpResponse()->setMessage(__('Request rejected.'));
        }
        return redirect()->route('dedicated-recruiter-requests.index')->with('success_msg', __('Request rejected.'));
    }

    public function edit(int $id)
    {
        $item = DedicatedRecruiterRequest::query()->with(['account', 'company', 'staff'])->findOrFail($id);
        $staffUsers = User::query()
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get(['id', 'first_name', 'last_name', 'email'])
            ->mapWithKeys(fn (User $u) => [$u->id => trim($u->first_name . ' ' . $u->last_name) ?: $u->email]);
        $this->pageTitle(__('Edit Dedicated Recruiter Request #:id', ['id' => $item->id]));
        return view('plugins/job-board::dedicated-recruiter-requests.edit', compact('item', 'staffUsers'));
    }

    public function update(Request $request, int $id)
    {
        $item = DedicatedRecruiterRequest::query()->findOrFail($id);
        $request->validate([
            'duration_months' => ['required', 'integer', 'min:1', 'max:24'],
            'note' => ['nullable', 'string', 'max:2000'],
            'staff_id' => ['nullable', 'integer', 'exists:users,id'],
            'status' => ['required', 'string', 'in:pending,accepted,rejected'],
        ]);
        $item->update([
            'duration_months' => $request->input('duration_months'),
            'note' => $request->input('note'),
            'staff_id' => $request->input('staff_id') ?: null,
            'status' => $request->input('status'),
        ]);
        return redirect()->route('dedicated-recruiter-requests.index')->with('success_msg', __('Request updated.'));
    }

    public function destroy(int $id)
    {
        $item = DedicatedRecruiterRequest::query()->findOrFail($id);
        $item->delete();
        return $this->httpResponse()->setMessage(__('Request deleted.'));
    }
}
