<?php

namespace Botble\JobBoard\Http\Controllers;

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
        $req = DedicatedRecruiterRequest::query()->where('status', 'pending')->findOrFail($id);
        $account = $req->account;
        if (! $account) {
            $msg = __('Employer account not found.');
            if ($request->expectsJson()) {
                return $this->httpResponse()->setError()->setMessage($msg);
            }
            return redirect()->route('dedicated-recruiter-requests.index')->with('error_msg', $msg);
        }

        $credits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_DEDICATED_RECRUITER, 5000);
        if ($account->credits < $credits) {
            $msg = __('Employer has insufficient credits.');
            if ($request->expectsJson()) {
                return $this->httpResponse()->setError()->setMessage($msg);
            }
            return redirect()->route('dedicated-recruiter-requests.index')->with('error_msg', $msg);
        }

        CreditConsumption::deductForFeature(
            $account,
            CreditConsumption::FEATURE_DEDICATED_RECRUITER,
            $credits,
            'Dedicated Recruiter – ' . $req->duration_months . ' month(s)'
        );

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
            return $this->httpResponse()->setMessage(__('Request accepted. Credits deducted.'));
        }
        return redirect()->route('dedicated-recruiter-requests.index')->with('success_msg', __('Request accepted. Credits deducted.'));
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
}
