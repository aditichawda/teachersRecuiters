<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Http\Requests\AdmissionEnquiryRequest;
use Botble\JobBoard\Models\Company;
use Botble\JobBoard\Models\CompanyAdmission;
use Botble\JobBoard\Models\AdmissionEnquiry;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdmissionController extends BaseController
{
    /**
     * Public Admission page (SEO) - featured/premium schools with admission content + enquiry form.
     */
    public function index(): View
    {
        $companies = Company::query()
            ->where('status', 'published')
            ->whereHas('admission', fn ($q) => $q->where('status', 'published'))
            ->with(['admission', 'slugable'])
            ->when(JobBoardHelper::isPinFeaturedcompaniesInTheTop(), fn ($q) => $q->orderByDesc('is_featured'))
            ->orderByDesc('is_featured')
            ->orderBy('name')
            ->get();

        SeoHelper::setTitle(__('Admission'));
        Theme::breadcrumb()->add(__('Admission'));

        return JobBoardHelper::view('admission.index', compact('companies'));
    }

    /**
     * Submit admission enquiry.
     */
    public function storeEnquiry(AdmissionEnquiryRequest $request): RedirectResponse
    {
        AdmissionEnquiry::query()->create($request->validated());

        return redirect()
            ->back()
            ->with('success_msg', __('Your admission enquiry has been submitted. The school will contact you soon.'));
    }
}
