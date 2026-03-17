<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\Transaction;
use Botble\JobBoard\Models\WalletRecharge;
use Botble\JobBoard\Supports\PackageContext;
use Botble\Payment\Enums\PaymentStatusEnum;
use Botble\Payment\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class WalletRechargeController extends BaseController
{
    protected const MIN_RECHARGE_INR = 100;
    protected const INR_TO_CREDITS_RATE = 1; // 1 INR = 1 credit (can be changed later)

    protected function createRazorpayApi(): Api
    {
        $apiKey = get_payment_setting('key', RAZORPAY_PAYMENT_METHOD_NAME);
        $apiSecret = get_payment_setting('secret', RAZORPAY_PAYMENT_METHOD_NAME);

        return new Api($apiKey, $apiSecret);
    }

    protected function hasActivePlan(Account $account): bool
    {
        // Active hiring plan = canPostJob() (same logic used for posting).
        $packageContext = PackageContext::forAccount($account);

        return $packageContext->canPostJob($account);
    }

    public function start(Request $request)
    {
        abort_unless(JobBoardHelper::isEnabledCreditsSystem(), 404);

        /** @var Account $account */
        $account = auth('account')->user();
        if (! $account || ! $account->isEmployer()) {
            abort(403);
        }

        $amount = (int) $request->input('amount_inr', 0);
        if ($amount < self::MIN_RECHARGE_INR) {
            return redirect()->back()->with('error_msg', __('Minimum recharge amount is ₹:amount.', ['amount' => self::MIN_RECHARGE_INR]));
        }

        if (! $this->hasActivePlan($account)) {
            return redirect()->back()->with('error_msg', __('Wallet recharge is available only with an active hiring plan.'));
        }

        // Only allow recharge when wallet has no credits (as per requirement).
        if ((int) ($account->credits ?? 0) > 0) {
            return redirect()->back()->with('error_msg', __('Wallet recharge is available when your wallet credits are exhausted.'));
        }

        $credits = $amount * self::INR_TO_CREDITS_RATE;
        $token = Str::random(40);

        $recharge = WalletRecharge::query()->create([
            'account_id' => $account->getKey(),
            'token' => $token,
            'amount_inr' => $amount,
            'credits' => $credits,
            'currency' => 'INR',
            'gateway' => 'razorpay',
            'status' => 'pending',
        ]);

        try {
            $api = $this->createRazorpayApi();
            // @phpstan-ignore-next-line
            $order = $api->order->create([
                'receipt' => $token,
                'amount' => $amount * 100,
                'currency' => 'INR',
                'payment_capture' => 1,
                'notes' => [
                    'wallet_recharge_token' => $token,
                    'account_id' => (string) $account->getKey(),
                ],
            ]);

            $recharge->razorpay_order_id = $order['id'] ?? null;
            $recharge->save();
        } catch (\Throwable $e) {
            BaseHelper::logError($e);
            $recharge->status = 'failed';
            $recharge->save();

            return redirect()->back()->with('error_msg', __('Unable to start recharge right now. Please try again.'));
        }

        $callbackUrl = route('public.account.wallet.recharge.callback', ['token' => $token]);
        $siteName = theme_option('site_title') ?: config('app.name');

        $data = [
            'key_id' => get_payment_setting('key', RAZORPAY_PAYMENT_METHOD_NAME),
            'order_id' => $recharge->razorpay_order_id,
            'amount' => $amount * 100,
            'currency' => 'INR',
            'name' => $siteName,
            'description' => __('Wallet recharge'),
            'prefill' => [
                'name' => $account->name ?: $account->first_name ?: '',
                'email' => $account->email ?: '',
                'contact' => $account->phone ?: '',
            ],
            'notes' => [
                'wallet_recharge_token' => $token,
            ],
            'callback_url' => $callbackUrl,
            'redirect' => 1,
        ];

        // Reuse Razorpay plugin auto-submit form.
        return response()->view('plugins/razorpay::form', [
            'data' => $data,
            'action' => 'https://api.razorpay.com/v1/checkout/embedded',
        ]);
    }

    public function callback(string $token, Request $request): RedirectResponse
    {
        abort_unless(JobBoardHelper::isEnabledCreditsSystem(), 404);

        $recharge = WalletRecharge::query()->where('token', $token)->first();
        if (! $recharge) {
            return redirect()->to(route('public.account.wallet'))->with('error_msg', __('Recharge not found.'));
        }

        if ($recharge->status === 'completed') {
            return redirect()->to(route('public.account.wallet'))->with('success_msg', __('Wallet recharged successfully.'));
        }

        $chargeId = (string) $request->input('razorpay_payment_id', '');
        $razorpayOrderId = (string) $request->input('razorpay_order_id', '');
        $signature = (string) $request->input('razorpay_signature', '');

        if (! $chargeId || ! $razorpayOrderId) {
            $recharge->status = 'failed';
            $recharge->save();

            return redirect()->to(route('public.account.wallet'))->with('error_msg', __('Payment failed or cancelled.'));
        }

        try {
            $api = $this->createRazorpayApi();
            // @phpstan-ignore-next-line
            $api->utility->verifyPaymentSignature([
                'razorpay_signature' => $signature,
                'razorpay_payment_id' => $chargeId,
                'razorpay_order_id' => $razorpayOrderId,
            ]);
        } catch (SignatureVerificationError $e) {
            BaseHelper::logError($e);
            $recharge->status = 'failed';
            $recharge->razorpay_payment_id = $chargeId;
            $recharge->razorpay_signature = $signature;
            $recharge->save();

            return redirect()->to(route('public.account.wallet'))->with('error_msg', __('Payment verification failed.'));
        } catch (\Throwable $e) {
            BaseHelper::logError($e);
            $recharge->status = 'failed';
            $recharge->razorpay_payment_id = $chargeId;
            $recharge->razorpay_signature = $signature;
            $recharge->save();

            return redirect()->to(route('public.account.wallet'))->with('error_msg', __('Payment verification failed.'));
        }

        return DB::transaction(function () use ($recharge, $chargeId, $razorpayOrderId, $signature) {
            /** @var Account|null $account */
            $account = Account::query()->find($recharge->account_id);
            if (! $account) {
                $recharge->status = 'failed';
                $recharge->save();

                return redirect()->to(route('public.account.wallet'))->with('error_msg', __('Account not found.'));
            }

            // Enforce active plan on crediting (if plan expired mid-payment, keep recharge pending/failed).
            if (! $this->hasActivePlan($account)) {
                $recharge->status = 'failed';
                $recharge->save();

                return redirect()->to(route('public.account.wallet'))->with('error_msg', __('Recharge is allowed only with an active hiring plan.'));
            }

            $existingPayment = Payment::query()
                ->where('charge_id', $chargeId)
                ->where('payment_channel', RAZORPAY_PAYMENT_METHOD_NAME)
                ->first();

            if (! $existingPayment) {
                $payment = new Payment();
                $payment->fill([
                    'amount' => (float) $recharge->amount_inr,
                    'currency' => $recharge->currency,
                    'charge_id' => $chargeId,
                    'payment_channel' => RAZORPAY_PAYMENT_METHOD_NAME,
                    'status' => PaymentStatusEnum::COMPLETED,
                    'customer_id' => $account->getKey(),
                    'customer_type' => Account::class,
                ]);
                $payment->save();
            } else {
                $payment = $existingPayment;
                if (! $payment->customer_id) {
                    $payment->customer_id = $account->getKey();
                    $payment->customer_type = Account::class;
                }
                $payment->status = PaymentStatusEnum::COMPLETED;
                $payment->save();
            }

            // Credit wallet (no expiry).
            $account->credits = (int) ($account->credits ?? 0) + (int) $recharge->credits;
            $account->save();

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
                'credits' => (int) $recharge->credits,
                'payment_id' => $payment->id,
                'package_id' => null,
                'package_name' => 'Wallet Recharge',
                'description' => 'Wallet recharge (Razorpay) - Order: ' . $razorpayOrderId,
            ]);

            $recharge->status = 'completed';
            $recharge->razorpay_order_id = $razorpayOrderId;
            $recharge->razorpay_payment_id = $chargeId;
            $recharge->razorpay_signature = $signature;
            $recharge->save();

            return redirect()->to(route('public.account.wallet'))->with('success_msg', __('Wallet recharged successfully.'));
        });
    }
}

