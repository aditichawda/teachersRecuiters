<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\Invoice;
use Botble\JobBoard\Models\Transaction;
use Botble\JobBoard\Supports\InvoiceHelper;
use Botble\JobBoard\Tables\Fronts\InvoiceTable;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Http\Request;

class InvoiceController extends BaseController
{
    public function index(InvoiceTable $invoiceTable)
    {
        $this->pageTitle(trans('plugins/job-board::messages.invoices'));

        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.my_profile'), route('public.account.dashboard'))
            ->add(trans('plugins/job-board::messages.manage_invoices'));

        SeoHelper::setTitle(trans('plugins/job-board::messages.invoices'));

        $account = auth('account')->user();
        $layout = ($account && $account->isJobSeeker())
            ? Theme::getThemeNamespace('views.job-board.account.partials.layout-settings')
            : JobBoardHelper::viewPath('dashboard.layouts.master');

        return $invoiceTable->render(JobBoardHelper::viewPath('dashboard.table.base'), [], ['layout' => $layout]);
    }

    public function show(Invoice $invoice)
    {
        $invoice->loadMissing(['payment', 'items']);
        abort_unless($this->canViewInvoice($invoice), 404);

        $title = trans('plugins/job-board::messages.invoice_detail', ['code' => $invoice->code]);

        $this->pageTitle($title);

        SeoHelper::setTitle($title);

        $account = auth('account')->user();
        $layout = ($account && $account->isJobSeeker())
            ? Theme::getThemeNamespace('views.job-board.account.partials.layout-settings')
            : JobBoardHelper::viewPath('dashboard.layouts.master');

        return JobBoardHelper::view('dashboard.invoices.detail', compact('invoice', 'layout'));
    }

    public function getGenerateInvoice(Invoice $invoice, Request $request, InvoiceHelper $invoiceHelper)
    {
        $invoice->loadMissing(['payment', 'items']);
        abort_unless($this->canViewInvoice($invoice), 404);

        // Release session lock so PDF generation does not block rest of the site
        session()->save();

        set_time_limit(120);

        if ($request->input('type') === 'print') {
            return $invoiceHelper->streamInvoice($invoice);
        }

        return $invoiceHelper->downloadInvoice($invoice);
    }

    protected function canViewInvoice(Invoice $invoice): bool
    {
        $payment = $invoice->payment;
        if (! $payment) {
            return false;
        }
        $accountId = auth('account')->id();
        if ($payment->customer_id && (int) $payment->customer_id === (int) $accountId) {
            return true;
        }
        // Fallback: payment may have been created with null customer_id (e.g. Razorpay callback)
        return (bool) Transaction::query()
            ->where('payment_id', $payment->id)
            ->where('account_id', $accountId)
            ->exists();
    }
}
