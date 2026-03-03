<?php

namespace Botble\JobBoard\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Facades\Assets;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\JobBoard\Models\Invoice;
use Botble\JobBoard\Supports\InvoiceHelper;
use Botble\JobBoard\Tables\InvoiceTable;
use Illuminate\Http\Request;

class InvoiceController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/job-board::job-board.name'))
            ->add(trans('plugins/job-board::invoice.name'), route('invoice.index'));
    }

    public function index(InvoiceTable $table)
    {
        $this->pageTitle(trans('plugins/job-board::invoice.name'));

        return $table->renderTable();
    }

    public function edit(Invoice $invoice, Request $request)
    {
        event(new BeforeEditContentEvent($request, $invoice));

        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $invoice->code]));

        Assets::addStylesDirectly('vendor/core/plugins/job-board/css/invoice.css');

        return view('plugins/job-board::invoice.edit', ['invoice' => $invoice]);
    }

    public function destroy(Invoice $invoice)
    {
        return DeleteResourceAction::make($invoice);
    }

    public function getGenerateInvoice(int $invoiceId, Request $request, InvoiceHelper $invoiceHelper)
    {
        $invoice = Invoice::query()->with('payment')->findOrFail($invoiceId);

        set_time_limit(120);

        try {
            if ($request->input('type') === 'print') {
                $response = $invoiceHelper->streamInvoice($invoice);
            } else {
                $response = $invoiceHelper->downloadInvoice($invoice);
            }

            if ($response instanceof \Illuminate\Http\Response) {
                return $response;
            }
            if (is_string($response)) {
                return response($response, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="invoice-' . $invoice->code . '.pdf"',
                ]);
            }
        } catch (\Throwable $e) {
            report($e);
            return back()->with('error', $e->getMessage());
        }

        return back()->with('error', __('Failed to generate PDF.'));
    }
}
