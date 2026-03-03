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

        return $invoiceTable->render(JobBoardHelper::viewPath('dashboard.table.base'));
    }

    public function show(Invoice $invoice)
    {
        $invoice->loadMissing(['payment', 'items']);
        abort_unless($this->canViewInvoice($invoice), 404);

        $title = trans('plugins/job-board::messages.invoice_detail', ['code' => $invoice->code]);

        $this->pageTitle($title);

        SeoHelper::setTitle($title);

        return JobBoardHelper::view('dashboard.invoices.detail', compact('invoice'));
    }

    public function getGenerateInvoice(Invoice $invoice, Request $request, InvoiceHelper $invoiceHelper)
    {
        $invoice->loadMissing(['payment', 'items']);
        abort_unless($this->canViewInvoice($invoice), 404);

        set_time_limit(120);
        try {
            if ($request->input('type') === 'print') {
                return $invoiceHelper->streamInvoice($invoice);
            }
            return $invoiceHelper->downloadInvoice($invoice);
        } catch (\Throwable $e) {
            report($e);
            if ($request->expectsJson()) {
                return response()->json(['message' => $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', trans('plugins/job-board::invoice.download_failed') ?: 'Invoice download failed. Please try again.');
        }
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
