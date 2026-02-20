<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\Company;
use Botble\JobBoard\Models\CompanyAdmission;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdmissionAccountController extends BaseController
{
    /**
     * Show admission content edit form for employer's first company (or selected company).
     */
    public function edit(Request $request): View|RedirectResponse
    {
        $account = auth('account')->user();
        if (! $account->isEmployer()) {
            return redirect()->route('public.account.dashboard');
        }

        $company = $account->companies()->first();
        if (! $company) {
            return redirect()
                ->route('public.account.employer.settings.edit')
                ->with('error_msg', __('Please add an institution first to manage admission.'));
        }

        $admission = $company->admission ?? new CompanyAdmission(['company_id' => $company->id, 'status' => 'published']);

        SeoHelper::setTitle(__('Admission') . ' - ' . __('Settings'));
        Theme::breadcrumb()->add(__('Admission'));

        return JobBoardHelper::view('admission.account.edit', compact('company', 'admission'));
    }

    /**
     * Update admission content.
     */
    public function update(Request $request): RedirectResponse
    {
        $account = auth('account')->user();
        if (! $account->isEmployer()) {
            return redirect()->route('public.account.dashboard');
        }

        $company = $account->companies()->first();
        if (! $company) {
            return redirect()->back()->with('error_msg', __('Invalid request.'));
        }

        $admission = $company->admission ?? new CompanyAdmission(['company_id' => $company->id]);
        $admission->content = $request->input('content');
        $admission->admission_deadline = $request->input('admission_deadline') ?: null;
        $admission->status = $request->input('status', 'published');
        $admission->company_id = $company->id;
        $admission->save();

        return redirect()
            ->back()
            ->with('success_msg', __('Admission details saved successfully.'));
    }
}
