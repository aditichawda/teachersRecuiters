<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\AdmissionEnquiry;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\Company;
use Botble\JobBoard\Models\CompanyAdmission;
use Botble\JobBoard\Models\CreditConsumption;
use Illuminate\Support\Facades\Schema;
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

        if (JobBoardHelper::isEnabledCreditsSystem() && ! $this->hasAdmissionEnquiryAccess($account)) {
            return redirect()->route('public.account.wallet')
                ->with('error_msg', trans('plugins/job-board::messages.insufficient_credits'));
        }

        $company = $account->companies()->first();
        if (! $company) {
            return redirect()
                ->route('public.account.employer.settings.edit')
                ->with('error_msg', __('Please add an institution first to manage admission.'));
        }

        $admission = $company->admission ?? new CompanyAdmission(['company_id' => $company->id, 'status' => 'published']);

        // Load enquiries for ALL institutions linked to this employer
        $companyIds = $this->getEmployerCompanyIds($account);
        $sort = $request->get('sort', 'newest');
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');

        $enquiriesQuery = AdmissionEnquiry::query()
            ->whereIn('company_id', $companyIds)
            ->with('company:id,name');

        if ($fromDate) {
            $enquiriesQuery->whereDate('created_at', '>=', $fromDate);
        }
        if ($toDate) {
            $enquiriesQuery->whereDate('created_at', '<=', $toDate);
        }

        if ($sort === 'oldest') {
            $enquiriesQuery->oldest();
        } else {
            $enquiriesQuery->latest();
        }
        $enquiries = $enquiriesQuery->paginate(15)->withQueryString();

        SeoHelper::setTitle(__('Admission') . ' - ' . __('Settings'));
        Theme::breadcrumb()->add(__('Admission'));

        return JobBoardHelper::view('admission.account.edit', compact('company', 'admission', 'enquiries'));
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

        if (JobBoardHelper::isEnabledCreditsSystem() && ! $this->hasAdmissionEnquiryAccess($account)) {
            return redirect()->route('public.account.wallet')
                ->with('error_msg', trans('plugins/job-board::messages.insufficient_credits'));
        }

        $company = $account->companies()->first();
        if (! $company) {
            return redirect()->back()->with('error_msg', __('Invalid request.'));
        }

        $maxWords = 125;
        $maxContentLength = (int) setting('admission_about_school_max_length', 1300);
        $request->validate([
            'content' => [
                'nullable',
                'string',
                'max:' . $maxContentLength,
                function ($attribute, $value, $fail) use ($maxWords): void {
                    if ($value && str_word_count(strip_tags($value)) > $maxWords) {
                        $fail(__('The about school content must not exceed :max words.', ['max' => $maxWords]));
                    }
                },
            ],
            'admission_deadline' => ['required', 'date'],
            'status' => ['nullable', 'in:published,draft'],
        ]);

        $admission = $company->admission ?? new CompanyAdmission(['company_id' => $company->id]);
        $admission->content = $request->input('content');
        $admission->admission_deadline = $request->input('admission_deadline');
        $admission->status = $request->input('status', 'published');
        $admission->company_id = $company->id;
        $admission->save();

        return redirect()
            ->back()
            ->with('success_msg', __('Admission details saved successfully.'));
    }

    /**
     * Show single admission enquiry detail (employer's institution only).
     */
    public function showEnquiry(int $enquiry): View|RedirectResponse
    {
        $account = auth('account')->user();
        if (! $account->isEmployer()) {
            return redirect()->route('public.account.dashboard');
        }

        if (JobBoardHelper::isEnabledCreditsSystem() && ! $this->hasAdmissionEnquiryAccess($account)) {
            return redirect()->route('public.account.wallet')
                ->with('error_msg', trans('plugins/job-board::messages.insufficient_credits'));
        }

        $companyIds = $this->getEmployerCompanyIds($account);
        if ($companyIds->isEmpty()) {
            return redirect()->route('public.account.dashboard');
        }

        $enquiryModel = AdmissionEnquiry::query()
            ->where('id', $enquiry)
            ->whereIn('company_id', $companyIds)
            ->with('company:id,name')
            ->firstOrFail();

        SeoHelper::setTitle(__('Enquiry Detail') . ' - ' . __('Admission'));
        Theme::breadcrumb()
            ->add(__('Admission'), route('public.account.admission.edit'))
            ->add(__('Enquiry') . ' #' . $enquiryModel->id);

        return JobBoardHelper::view('admission.account.enquiry-show', compact('enquiryModel'));
    }

    /**
     * Get company IDs for this employer (from pivot + account_id fallback).
     */
    private function getEmployerCompanyIds($account): \Illuminate\Support\Collection
    {
        $ids = $account->companies()->pluck('id');
        if (Schema::hasColumn('jb_companies', 'account_id')) {
            $ownerIds = Company::where('account_id', $account->id)->pluck('id');
            $ids = $ids->merge($ownerIds)->unique()->values();
        }

        return $ids;
    }

    /**
     * Admission access when credits system enabled: employer has used credits for Admission Enquiry Form.
     * Valid while package is not expired, OR if no package then for 365 days from the debit transaction.
     */
    private function hasAdmissionEnquiryAccess(Account $account): bool
    {
        if (! Schema::hasColumn('jb_transactions', 'feature_key')) {
            return false;
        }

        $debit = Transaction::query()
            ->where('account_id', $account->getKey())
            ->where('type', Transaction::TYPE_DEBIT)
            ->where('feature_key', CreditConsumption::FEATURE_ADMISSION_ENQUIRY)
            ->latest()
            ->first();

        if (! $debit) {
            return false;
        }

        $lastPurchase = Transaction::query()
            ->where('account_id', $account->getKey())
            ->where(function ($q): void {
                $q->whereNull('type')->orWhere('type', '!=', 'deduct');
            })
            ->whereNotNull('payment_id')
            ->whereNotNull('package_id')
            ->with('package')
            ->latest()
            ->first();

        if ($lastPurchase && $lastPurchase->package && $lastPurchase->package->validity_days) {
            $packageExpiryAt = Carbon::parse($lastPurchase->created_at)->addDays($lastPurchase->package->validity_days);
            if (Carbon::now()->lte($packageExpiryAt)) {
                return true;
            }
        }

        return $debit->created_at->gte(Carbon::now()->subDays(365));
    }
}
