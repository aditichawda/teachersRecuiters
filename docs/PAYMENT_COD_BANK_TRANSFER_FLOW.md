# COD (Cash on Delivery) aur Bank Transfer – Flow (Step by Step)

## 1. Common start (dono ke liye same)

- User **Wallet** → package select karke **Subscribe / Pay** pe click karta hai.
- Checkout page open hota hai: `account/packages/{id}/subscribe`.
- Form **POST** hota hai route pe: **`payments.checkout`** → `CheckoutController@postCheckout`.
- Request me aata hai: `payment_method` (cod / bank_transfer), `amount`, `currency`, `callback_url`, `return_url`, `customer_id`, `customer_type`, etc.

---

## 2. COD (Cash on Delivery) – Kya hota hai

### Step 1: User “Process Pay” / Checkout button click karta hai (COD selected)

- Frontend (checkout.blade.php):
  - Agar payment method **COD** hai to form submit normal POST ki jagah **AJAX** se hota hai (`doCodCheckout`).
  - Same URL: `route('payments.checkout')` (POST).
  - 12 second timeout: agar response nahi aata to direct **Wallet URL** pe redirect.

### Step 2: Server – `CheckoutController@postCheckout`

- `payment_method === COD` pe:
  1. **CodPaymentService->execute($paymentData)** call hota hai.
  2. Ye ek random **charge_id** banata hai aur **PAYMENT_ACTION_PAYMENT_PROCESSED** action fire karta hai with:
     - `payment_channel` = COD  
     - `status` = **PENDING**
  3. Job-board **HookServiceProvider** us action pe:
     - **Payment** record create karta hai (PaymentHelper::storeLocalPayment).
     - **Invoice** create/update karta hai.
     - Payment ke meta me `subscribed_packaged_id` save karta hai.

### Step 3: COD order complete (same request me)

- `CheckoutController` turant **completeCodOrderAndGetWalletUrl($chargeId, $request)** call karta hai:
  1. Session / callback URL se **package_id** nikalta hai.
  2. **Payment** dhundhta hai (charge_id se), **status = COMPLETED** kar deta hai.
  3. Account ke **credits** me package ke credits add karta hai.
  4. **Transaction** record create karta hai (history ke liye).
  5. **Invoice** status COMPLETED karta hai.
  6. Agar invoice nahi bani to **InvoiceHelper::store** se invoice create karta hai.
  7. Return karta hai: **Wallet URL** (employer/job seeker ke hisaab se).

### Step 4: Response aur redirect

- Controller response: `setNextUrl($checkoutUrl)` with Wallet URL.
- Frontend AJAX response me **next_url** milta hai → browser **Wallet page** pe redirect ho jata hai.
- Koi alag callback URL hit nahi hoti; sab same request me complete.

**Important files (COD):**

- `platform/plugins/payment/src/Services/Gateways/CodPaymentService.php` – charge_id + action fire.
- `platform/plugins/job-board/src/Http/Controllers/Fronts/CheckoutController.php` – postCheckout (COD case + completeCodOrderAndGetWalletUrl).
- `platform/plugins/job-board/resources/views/themes/dashboard/checkout.blade.php` – COD ke liye AJAX submit.

---

## 3. Bank Transfer – Kya hota hai

### Step 1: User “Process Pay” click karta hai (Bank Transfer selected)

- Form **normal submit** (AJAX nahi, sirf COD ke liye AJAX hai).
- POST same: `payments.checkout`.

### Step 2: Server – `CheckoutController@postCheckout`

- `payment_method === BANK_TRANSFER` pe:
  1. **BankTransferPaymentService->execute($paymentData)** call hota hai.
  2. Ye bhi random **charge_id** banata hai aur **PAYMENT_ACTION_PAYMENT_PROCESSED** fire karta hai with:
     - `payment_channel` = BANK_TRANSFER  
     - `status` = **PENDING**
  3. Job-board **HookServiceProvider** (same as COD):
     - Payment record create.
     - Invoice create/update.
     - `subscribed_packaged_id` meta me save.

### Step 3: Redirect (order complete nahi hota)

- Controller ab **direct Wallet page** pe redirect karta hai (COD jaisa):  
  **`getWalletRedirectUrl()`** → employer/job seeker ke hisaab se Wallet URL.
- Matlab user **Wallet page** pe redirect ho jata hai; payment abhi **PENDING** rehti hai.  
- Credits **nahi** milte; order “pending” rehta hai.

### Step 4: Kab credits milte hain (Bank Transfer)

- Jab admin **Payment** ko **Completed** kare:
  - Admin panel → Payments → us payment ko open karke status **Completed** save karta hai.
- **ACTION_AFTER_UPDATE_PAYMENT** hook chalता hai (HookServiceProvider):
  - Agar `payment_channel` = COD ya BANK_TRANSFER aur `status` = COMPLETED:
    - Account ko package ke credits add.
    - Package attach.
    - Invoice status COMPLETED.
- Isliye Bank Transfer = “pay offline, admin baad me confirm karke complete kare.”

**Important files (Bank Transfer):**

- `platform/plugins/payment/src/Services/Gateways/BankTransferPaymentService.php` – charge_id + action.
- `platform/plugins/job-board/src/Http/Controllers/Fronts/CheckoutController.php` – postCheckout (BANK_TRANSFER case).
- `platform/plugins/job-board/src/Providers/HookServiceProvider.php` – PAYMENT_ACTION_PAYMENT_PROCESSED + ACTION_AFTER_UPDATE_PAYMENT.

---

## 4. Short comparison

| Step / Feature           | COD                          | Bank Transfer                    |
|--------------------------|------------------------------|-----------------------------------|
| Button click             | AJAX POST (same URL)         | Normal form POST                  |
| Payment record           | Create, status PENDING → phir COMPLETED (same request) | Create, status PENDING only |
| Credits add              | Same request me (completeCodOrderAndGetWalletUrl) | Nahi; admin Complete karne pe (ACTION_AFTER_UPDATE_PAYMENT) |
| Redirect after checkout  | Wallet URL (direct)         | Wallet URL (direct) – pending bhi wallet pe redirect |
| Callback route           | Use nahi hoti               | Use nahi hoti (direct wallet redirect) |

---

## 5. Routes / constants

- Checkout form action: **`route('payments.checkout')`** → `POST payments/checkout` (job-board public routes).
- Callback (success): **`route('public.account.package.subscribe.callback', $package->id)`**.
- Cancel URL (payment plugin): **`route('public.account.package.subscribe.checkout', $id)`** + query params.
- Actions: **PAYMENT_ACTION_PAYMENT_PROCESSED** (payment + invoice create), **ACTION_AFTER_UPDATE_PAYMENT** (admin complete karne pe credits + invoice update).

Is hisaab se **COD = turant complete + wallet redirect**, **Bank Transfer = pending + wallet redirect, credits admin ke complete karne pe**.
