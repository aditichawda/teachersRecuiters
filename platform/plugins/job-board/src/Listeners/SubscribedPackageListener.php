<?php

namespace Botble\JobBoard\Listeners;

use Botble\Base\Facades\EmailHandler;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\Package;
use Botble\JobBoard\Models\Transaction;
use Botble\Payment\Enums\PaymentStatusEnum;
use Botble\Payment\Events\PaymentWebhookReceived;
use Botble\Payment\Models\Payment;

class SubscribedPackageListener
{
    public function handle(PaymentWebhookReceived $event)
    {
        $payment = Payment::query()->where('charge_id', $event->chargeId)->first();

        if (! $payment) {
            return;
        }

        $packageId = $payment->order_id;

        if (! $packageId) {
            return;
        }

        $package = Package::query()->find($packageId);

        if (! $package) {
            return;
        }

        $accountId = $payment->customer_id;

        if (! $accountId) {
            return;
        }

        $account = Account::query()->find($accountId);

        if (! $account) {
            return;
        }

        if (($payment->status == PaymentStatusEnum::COMPLETED)) {
            $account->credits += $package->number_of_listings;
            $account->save();

            $account->packages()->attach($package);
        }

        $accountType = $account->isEmployer() ? 'employer' : 'job_seeker';
        $userDetails = [
            'name' => $account->name,
            'email' => $account->email,
            'phone' => $account->phone ? (($account->phone_country_code ?? '') . ' ' . $account->phone) : null,
            'address' => $account->address,
            'state' => $account->state_name,
            'city' => $account->city_name,
            'country' => $account->country_name,
        ];
        $institutionName = null;
        if ($account->isEmployer()) {
            $company = $account->companies()->first();
            $institutionName = $company ? $company->name : null;
        }

        Transaction::query()->create([
            'user_id' => 0,
            'account_id' => $account->id,
            'account_type' => $accountType,
            'user_details' => $userDetails,
            'institution_name' => $institutionName,
            'credits' => $package->number_of_listings,
            'payment_id' => $payment?->id,
            'package_id' => $package->getKey(),
            'package_name' => $package->name,
        ]);

        $emailHandler = EmailHandler::setModule(JOB_BOARD_MODULE_SCREEN_NAME);

        if (! $package->price) {
            $emailHandler
                ->setVariableValues([
                    'account_name' => $account->name,
                    'account_email' => $account->email,
                ])
                ->sendUsingTemplate('free-credit-claimed');
        } else {
            $emailHandler
                ->setVariableValues([
                    'account_name' => $account->name,
                    'account_email' => $account->email,
                    'package_name' => $package->name,
                    'package_price' => $package->price ?: 0,
                    'package_percent_discount' => $package->percent_save,
                    'package_number_of_listings' => $package->number_of_listings ?: 1,
                    'package_price_per_credit' => $package->price ? $package->price / ($package->number_of_listings ?: 1) : 0,
                ])
                ->sendUsingTemplate('payment-received');
        }

        $emailHandler
            ->setVariableValues([
                'account_name' => $account->name,
                'account_email' => $account->email,
                'package_name' => $package->name,
                'package_price' => $package->price ?: 0,
                'package_percent_discount' => $package->percent_save,
                'package_number_of_listings' => $package->number_of_listings ?: 1,
                'package_price_per_credit' => $package->price ? $package->price / ($package->number_of_listings ?: 1) : 0,
            ])
            ->sendUsingTemplate('payment-receipt', $account->email);
    }
}
