<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\Invoice;
use Botble\JobBoard\Models\Package;
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

        $bonusCredits = (int) Transaction::query()
            ->where('account_id', $account->getKey())
            ->where(function ($q): void {
                $q->whereNull('type')->orWhere('type', '!=', 'deduct');
            })
            ->whereNotNull('user_id')
            ->sum('credits');

        $purchasedCredits = (int) Transaction::query()
            ->where('account_id', $account->getKey())
            ->where(function ($q): void {
                $q->whereNull('type')->orWhere('type', '!=', 'deduct');
            })
            ->whereNotNull('payment_id')
            ->sum('credits');

        $account->load(['packages']);
        $packages = Package::query()
            ->wherePublished()
            ->latest('order')
            ->withCount([
                'accounts' => function ($query) use ($account): void {
                    $query->where('account_id', $account->getKey());
                },
            ])
            ->take(4)
            ->get();

        $billingName = $account->full_name ?: $account->first_name ?: $account->name;
        $siteName = Theme::getSiteTitle();

        $viewData = compact(
            'account',
            'transactions',
            'invoices',
            'packages',
            'bonusCredits',
            'purchasedCredits',
            'billingName',
            'siteName'
        );

        if ($account->isEmployer()) {
            return JobBoardHelper::view('dashboard.wallet', $viewData);
        }

        $viewData['is_wallet_page'] = true;
        return JobBoardHelper::scope('dashboard.wallet-jobseeker', $viewData);
    }
}
