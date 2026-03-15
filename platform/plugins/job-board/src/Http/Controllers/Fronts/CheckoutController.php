<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Enums\InvoiceStatusEnum;
use Botble\JobBoard\Http\Requests\CheckoutRequest;
use Botble\JobBoard\Jobs\CompleteCodOrderJob;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\Invoice;
use Botble\JobBoard\Models\Package;
use Botble\JobBoard\Models\Transaction;
use Botble\JobBoard\Supports\InvoiceHelper;
use Botble\Payment\Enums\PaymentMethodEnum;
use Botble\Payment\Enums\PaymentStatusEnum;
use Botble\Payment\Models\Payment;
use Botble\Payment\Services\Gateways\BankTransferPaymentService;
use Botble\Payment\Services\Gateways\CodPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CheckoutController extends BaseController
{
    public function postCheckout(CheckoutRequest $request)
    {
        set_time_limit(90);
        $isAjax = $request->expectsJson() || $request->ajax();
        $walletUrlFallback = $this->getWalletRedirectUrl();

        try {
            $returnUrl = $request->input('return_url');

            $currency = $request->input('currency', config('plugins.payment.payment.currency'));
            $currency = strtoupper($currency);

            $data = [
                'error' => false,
                'message' => false,
                'amount' => $request->input('amount'),
                'currency' => $currency,
                'type' => $request->input('payment_method'),
                'charge_id' => null,
            ];

            session()->put('selected_payment_method', $data['type']);

            $paymentData = apply_filters(PAYMENT_FILTER_PAYMENT_DATA, [], $request);

            switch ($request->input('payment_method')) {
                case PaymentMethodEnum::COD:
                    Log::info('JobBoard COD checkout: start', ['account_id' => auth('account')->id(), 'ajax' => $isAjax]);
                    $walletUrl = $walletUrlFallback ?: $this->getWalletRedirectUrl();
                    if (! $walletUrl) {
                        Log::warning('JobBoard COD checkout: wallet URL null (no auth?)');
                    } else {
                        Log::info('JobBoard COD checkout: wallet URL ok', ['wallet_url' => $walletUrl]);
                    }
                    try {
                        if (empty($paymentData['order_id'])) {
                            $packageId = Session::get('subscribed_packaged_id') ?: $this->parsePackageIdFromCallback($request->input('callback_url'));
                            Log::info('JobBoard COD checkout: package id', ['package_id' => $packageId, 'from_session' => Session::get('subscribed_packaged_id')]);
                            if ($packageId) {
                                session()->put('subscribed_packaged_id', $packageId);
                                $paymentData = apply_filters(PAYMENT_FILTER_PAYMENT_DATA, [], $request);
                            }
                        }
                        if (empty($paymentData['order_id'])) {
                            Log::error('JobBoard COD checkout: payment data has no order_id – session/callback may have no package', [
                                'has_session_package' => (bool) Session::get('subscribed_packaged_id'),
                                'callback_url' => $request->input('callback_url'),
                            ]);
                            $data['checkoutUrl'] = $walletUrl;
                            $data['message'] = trans('plugins/payment::payment.checkout_success');
                        } else {
                            Log::info('JobBoard COD checkout: calling CodPaymentService->execute', ['order_id' => $paymentData['order_id']]);
                            $codPaymentService = app(CodPaymentService::class);
                            $data['charge_id'] = $codPaymentService->execute($paymentData);
                        Log::info('JobBoard COD checkout: charge_id created', ['charge_id' => $data['charge_id']]);
                        $data['message'] = trans('plugins/payment::payment.checkout_success');

                        $packageId = (int) (Arr::first((array) ($paymentData['order_id'] ?? null)) ?: Session::get('subscribed_packaged_id') ?: $this->parsePackageIdFromCallback($request->input('callback_url')));
                        if ($isAjax && $packageId > 0 && auth('account')->id()) {
                            CompleteCodOrderJob::dispatch(
                                $data['charge_id'],
                                $packageId,
                                (int) auth('account')->id(),
                                (float) Session::get('coupon_discount_amount', 0),
                                Session::get('applied_coupon_code')
                            )->afterResponse();
                            $data['checkoutUrl'] = $walletUrl;
                            Log::info('JobBoard COD checkout: job dispatched, returning wallet URL', ['checkout_url' => $data['checkoutUrl']]);
                        } else {
                            Log::info('JobBoard COD checkout: calling completeCodOrderAndGetWalletUrl');
                            $completedUrl = $this->completeCodOrderAndGetWalletUrl($data['charge_id'], $request);
                            $data['checkoutUrl'] = $completedUrl ?: $walletUrl;
                            Log::info('JobBoard COD checkout: completed', ['checkout_url' => $data['checkoutUrl']]);
                        }
                        }
                    } catch (\Throwable $e) {
                        Log::error('JobBoard COD checkout: exception', [
                            'message' => $e->getMessage(),
                            'file' => $e->getFile(),
                            'line' => $e->getLine(),
                            'trace' => $e->getTraceAsString(),
                        ]);
                        $data['checkoutUrl'] = $walletUrl;
                        $data['message'] = trans('plugins/payment::payment.checkout_success');
                    }
                    $data['checkoutUrl'] = $data['checkoutUrl'] ?: $walletUrl;
                    Log::info('JobBoard COD checkout: returning', ['checkoutUrl' => $data['checkoutUrl']]);
                    break;

            case PaymentMethodEnum::BANK_TRANSFER:
                $bankTransferPaymentService = app(BankTransferPaymentService::class);
                $data['charge_id'] = $bankTransferPaymentService->execute($paymentData);
                $data['message'] = trans('plugins/payment::payment.payment_pending');
                // Pending payment (Bank Transfer) – redirect direct Wallet page pe
                $data['checkoutUrl'] = $this->getWalletRedirectUrl();
                return redirect()->to($data['checkoutUrl'])->with('success_msg', $data['message']);

            default:
                $data = apply_filters(PAYMENT_FILTER_AFTER_POST_CHECKOUT, $data, $request);

                break;
        }

        if ($checkoutUrl = Arr::get($data, 'checkoutUrl')) {
            if ($data['type'] === PaymentMethodEnum::COD) {
                Log::info('JobBoard COD checkout: sending response with next_url', ['next_url' => $checkoutUrl]);
            }
            return $this->httpResponse()
                ->setError($data['error'])
                ->setNextUrl($checkoutUrl)
                ->setAdditional(['next_url' => $checkoutUrl])
                ->withInput()
                ->setMessage($data['message'] ?? '');
        }

        if ($data['error'] || ! $data['charge_id']) {
            return $this->httpResponse()
                ->setError()
                ->setNextUrl($returnUrl)
                ->setAdditional(['next_url' => $returnUrl])
                ->withInput()
                ->setMessage($data['message'] ?: trans('plugins/job-board::messages.checkout_error'));
        }

            $callbackUrl = $request->input('callback_url') . '?' . http_build_query($data);

            return redirect()->to($callbackUrl)->with('success_msg', trans('plugins/payment::payment.checkout_success'));
        } catch (\Throwable $e) {
            Log::error('JobBoard checkout error (outer catch)', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'payment_method' => $request->input('payment_method'),
            ]);
            $walletUrl = $walletUrlFallback;
            if (! $walletUrl) {
                try {
                    $walletUrl = $this->getWalletRedirectUrl();
                } catch (\Throwable $e2) {
                    $walletUrl = $request->input('return_url') ?: url('/account/wallet');
                }
            }
            $walletUrl = $walletUrl ?: url('/account/wallet');
            if ($isAjax) {
                return $this->httpResponse()
                    ->setError(true)
                    ->setNextUrl($walletUrl)
                    ->setAdditional(['next_url' => $walletUrl])
                    ->setMessage($e->getMessage() ?: trans('plugins/job-board::messages.checkout_error'));
            }
            return redirect()->to($walletUrl)->with('error_msg', $e->getMessage() ?: trans('plugins/job-board::messages.checkout_error'));
        }
    }

    protected function getWalletRedirectUrl(): ?string
    {
        $account = auth('account')->user();
        if (! $account) {
            return null;
        }
        return $account->isJobSeeker()
            ? route('public.account.jobseeker.wallet')
            : route('public.account.wallet');
    }

    /**
     * For COD: complete order in same request (credits, package, invoice) and return wallet URL.
     * So user is redirected straight to wallet without a second callback request.
     */
    protected function completeCodOrderAndGetWalletUrl(string $chargeId, Request $request): ?string
    {
        try {
            Log::info('JobBoard COD completeCodOrder: start', ['charge_id' => $chargeId]);
            $packageId = Session::get('subscribed_packaged_id') ?: $this->parsePackageIdFromCallback($request->input('callback_url'));
            if (! $packageId) {
                Log::warning('JobBoard COD completeCodOrder: package_id null');
                return null;
            }
            Log::info('JobBoard COD completeCodOrder: package_id ok', ['package_id' => $packageId]);

            $package = Package::query()->find($packageId);
            if (! $package) {
                Log::warning('JobBoard COD completeCodOrder: package not found', ['package_id' => $packageId]);
                return null;
            }

            $payment = Payment::query()->where('charge_id', $chargeId)->first();
            if (! $payment || $payment->payment_channel != PaymentMethodEnum::COD) {
                Log::warning('JobBoard COD completeCodOrder: payment not found or not COD', ['charge_id' => $chargeId, 'found' => (bool) $payment]);
                return null;
            }

            $account = auth('account')->user();
            if (! $account) {
                Log::warning('JobBoard COD completeCodOrder: account null');
                return null;
            }

            Log::info('JobBoard COD completeCodOrder: updating payment status');
            $payment->status = PaymentStatusEnum::COMPLETED;
            $payment->customer_id = $account->getKey();
            $payment->customer_type = Account::class;
            $payment->order_id = $payment->order_id ?: $package->getKey();
            $payment->save();

            $creditsToAdd = $package->credits_included ?? $package->number_of_listings;
            $account->credits += $creditsToAdd;
            $account->save();
            $account->packages()->syncWithoutDetaching([$package->id]);
            
            // Send wallet recharged notification to job seeker
            if (!$account->isEmployer()) {
                try {
                    $notificationService = app(\Botble\JobBoard\Services\NotificationService::class);
                    $notificationService->sendWalletRechargedNotification(
                        $account,
                        $creditsToAdd
                    );
                    \Log::info('[NOTIFICATION] Wallet recharged notification sent', [
                        'account_id' => $account->id,
                        'credits_added' => $creditsToAdd,
                    ]);
                    
                    // Check for low balance after recharge
                    if ($account->credits < 100) {
                        $notificationService->sendWalletLowBalanceNotification(
                            $account,
                            $account->credits
                        );
                    }
                } catch (\Exception $e) {
                    \Log::error('[NOTIFICATION] Failed to send wallet notification', [
                        'account_id' => $account->id,
                        'error' => $e->getMessage(),
                    ]);
                }
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
                    'discount_amount' => Session::get('coupon_discount_amount', 0),
                    'coupon_code' => Session::get('applied_coupon_code'),
                ]);
            }

            Log::info('JobBoard COD completeCodOrder: success, returning wallet URL');
            return $this->getWalletRedirectUrl();
        } catch (\Throwable $e) {
            Log::error('JobBoard COD completeCodOrder: exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            return $this->getWalletRedirectUrl();
        }
    }

    protected function parsePackageIdFromCallback(?string $callbackUrl): ?int
    {
        if (! $callbackUrl || ! preg_match('/\/packages\/(\d+)\//', (string) $callbackUrl, $m)) {
            return null;
        }
        return (int) $m[1];
    }
}
