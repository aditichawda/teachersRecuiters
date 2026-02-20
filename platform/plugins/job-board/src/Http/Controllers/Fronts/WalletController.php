<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\Invoice;
use Botble\JobBoard\Models\Transaction;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Database\Eloquent\Builder;

class WalletController extends BaseController
{
    public function index()
    {
        abort_unless(JobBoardHelper::isEnabledCreditsSystem(), 404);

        $account = auth('account')->user();
        $this->pageTitle(trans('plugins/job-board::dashboard.menu.wallet'));
        Theme::breadcrumb()->add(trans('plugins/job-board::dashboard.menu.wallet'));
        SeoHelper::setTitle(trans('plugins/job-board::dashboard.menu.wallet'));

        $transactions = Transaction::query()
            ->where('account_id', $account->getKey())
            ->with(['payment', 'user'])
            ->latest()
            ->paginate(15);

        $invoices = Invoice::query()
            ->whereHas('payment', function (Builder $q) use ($account): void {
                $q->where('customer_id', $account->getKey());
            })
            ->with('payment')
            ->latest()
            ->paginate(10, ['*'], 'invoice_page');

        return JobBoardHelper::view('dashboard.wallet', compact('account', 'transactions', 'invoices'));
    }
}
