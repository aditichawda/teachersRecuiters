<?php

namespace Botble\JobBoard\Jobs;

use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\Package;
use Botble\JobBoard\Models\Transaction;
use Botble\JobBoard\Supports\InvoiceHelper;
use Botble\Payment\Enums\PaymentMethodEnum;
use Botble\Payment\Enums\PaymentStatusEnum;
use Botble\Payment\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Botble\JobBoard\Models\Invoice;
use Botble\JobBoard\Enums\InvoiceStatusEnum;

class CompleteCodOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 2;
    public int $timeout = 60;

    public function __construct(
        public string $chargeId,
        public int $packageId,
        public int $accountId,
        public float $discountAmount = 0,
        public ?string $couponCode = null
    ) {
        $this->onQueue('default');
    }

    public function handle(): void
    {
        Log::info('JobBoard CompleteCodOrderJob: start', [
            'charge_id' => $this->chargeId,
            'package_id' => $this->packageId,
            'account_id' => $this->accountId,
        ]);

        $package = Package::query()->find($this->packageId);
        if (! $package) {
            Log::warning('JobBoard CompleteCodOrderJob: package not found', ['package_id' => $this->packageId]);
            return;
        }

        $payment = Payment::query()->where('charge_id', $this->chargeId)->first();
        if (! $payment || $payment->payment_channel != PaymentMethodEnum::COD) {
            Log::warning('JobBoard CompleteCodOrderJob: payment not found or not COD', ['charge_id' => $this->chargeId]);
            return;
        }

        $account = Account::query()->find($this->accountId);
        if (! $account) {
            Log::warning('JobBoard CompleteCodOrderJob: account not found', ['account_id' => $this->accountId]);
            return;
        }

        if ($payment->status === PaymentStatusEnum::COMPLETED) {
            Log::info('JobBoard CompleteCodOrderJob: already completed', ['charge_id' => $this->chargeId]);
            return;
        }

        $payment->status = PaymentStatusEnum::COMPLETED;
        $payment->customer_id = $account->getKey();
        $payment->customer_type = Account::class;
        $payment->order_id = $payment->order_id ?: $package->getKey();
        $payment->save();

        $creditsToAdd = $package->credits_included ?? $package->number_of_listings;
        $account->credits += $creditsToAdd;
        $account->save();
        $account->packages()->syncWithoutDetaching([$package->id]);

        $accountType = $account->isEmployer() ? 'employer' : 'job_seeker';
        $userDetails = [
            'name' => $account->name,
            'email' => $account->email,
            'phone' => $account->phone ? (($account->phone_country_code ?? '') . ' ' . $account->phone) : null,
            'address' => $account->address,
            'state' => $account->state_name ?? null,
            'city' => $account->city_name ?? null,
            'country' => $account->country_name ?? null,
        ];
        $institutionName = $account->isEmployer() && $account->companies()->exists()
            ? $account->companies()->first()->name
            : null;

        Transaction::query()->create([
            'user_id' => 0,
            'account_id' => $account->getKey(),
            'account_type' => $accountType,
            'user_details' => $userDetails,
            'institution_name' => $institutionName,
            'credits' => $creditsToAdd,
            'payment_id' => $payment->id,
            'package_id' => $package->getKey(),
            'package_name' => $package->name,
        ]);

        $package->applyEmployerPackageFeatures($account);

        Invoice::query()
            ->where('reference_id', $package->getKey())
            ->where('reference_type', Package::class)
            ->update(['status' => InvoiceStatusEnum::COMPLETED]);

        $invoiceExists = Invoice::query()->where('payment_id', $payment->id)->exists();
        if (! $invoiceExists) {
            InvoiceHelper::store([
                'order_id' => $package->getKey(),
                'customer_type' => Account::class,
                'customer_id' => $account->getKey(),
                'charge_id' => $payment->charge_id,
                'status' => PaymentStatusEnum::COMPLETED,
                'amount' => (float) $payment->amount,
                'discount_amount' => $this->discountAmount,
                'coupon_code' => $this->couponCode,
            ]);
        }

        Log::info('JobBoard CompleteCodOrderJob: completed', ['charge_id' => $this->chargeId]);
    }
}
