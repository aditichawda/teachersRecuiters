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
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
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
     * Employer receives a notification email (no form details in email); details viewable in dashboard only.
     */
    public function storeEnquiry(AdmissionEnquiryRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $company = Company::query()->findOrFail($data['company_id']);

            $data['email'] = isset($data['email']) && $data['email'] !== null && trim((string) $data['email']) !== ''
                ? (string) $data['email']
                : '';
            $data['message'] = isset($data['message']) && $data['message'] !== null && trim((string) $data['message']) !== ''
                ? (string) $data['message']
                : '';

            try {
                AdmissionEnquiry::query()->create($data);
            } catch (QueryException $e) {
                report($e);
                $msg = __('Something went wrong while saving. Please try again or contact support.');
                if (str_contains($e->getMessage(), 'age') || str_contains($e->getMessage(), 'Unknown column')) {
                    $msg = __('Database update required. Please run: php artisan migrate');
                }

                return redirect()
                    ->back()
                    ->withInput($request->except('_token'))
                    ->with('error_msg', $msg);
            }

            $employerEmails = array_filter([$company->email]);
            if (empty($employerEmails)) {
                $firstAccount = $company->accounts()->first();
                if ($firstAccount && $firstAccount->email) {
                    $employerEmails[] = $firstAccount->email;
                }
            }
            if (! empty($employerEmails)) {
                try {
                    $dashboardUrl = route('public.account.admission.edit');
                    $companyName = $company->name;
                    $subject = __('New admission enquiry received') . ' - ' . $companyName;
                    $html = '<p>' . __('You have received a new admission enquiry.') . '</p>';
                    $html .= '<p>' . __('Please log in to your dashboard to view the enquiry details.') . '</p>';
                    $html .= '<p><a href="' . e($dashboardUrl) . '" style="display:inline-block;background:#1967d2;color:#fff;padding:10px 20px;text-decoration:none;border-radius:5px;">' . __('View in Dashboard') . '</a></p>';
                    foreach ($employerEmails as $email) {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            Mail::send([], [], function ($message) use ($subject, $html, $email): void {
                                $message->from(config('mail.from.address', 'noreply@example.com'), config('mail.from.name', 'TeachersRecruiter'))
                                    ->to($email)
                                    ->subject($subject)
                                    ->html($html);
                            });
                        }
                    }
                } catch (\Throwable $e) {
                    report($e);
                }
            }

            return redirect()
                ->back()
                ->with('success_msg', __('Your admission enquiry has been submitted. The school will contact you soon.'));
        } catch (\Throwable $e) {
            report($e);

            return redirect()
                ->back()
                ->withInput($request->except('_token'))
                ->with('error_msg', __('Something went wrong. Please try again or contact support.'));
        }
    }
}
