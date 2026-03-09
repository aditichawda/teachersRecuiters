# Laravel log – sirf errors (Aditi project)

Yeh list `storage/logs/laravel.log` se sirf **local.ERROR** wali lines hai. Jo errors **Aditi** project me aaye (path me `Aditi` ya recent date).

---

## 1. Razorpay callback return type (fix ho chuka)

- **Error:** `RazorpayController::callback(): Return value must be of type Botble\Base\Http\Responses\BaseHttpResponse, Illuminate\Http\Response returned`  
- **File:** `platform/plugins/razorpay/src/Http/Controllers/RazorpayController.php` (around line 834)  
- **Reason:** Callback `response()->view()` return karta hai (Illuminate Response), method return type `BaseHttpResponse` tha.  
- **Fix:** Method return type `\Symfony\Component\HttpFoundation\Response` kar diya gaya hai, taaki `response()->view()` valid ho.

---

## 2. Maximum execution time of 300 seconds exceeded

- **Error:** `Maximum execution time of 300 seconds exceeded` at `Illuminate\Foundation\Console\ServeCommand.php:140`  
- **Meaning:** Koi request/command 300 second (5 min) se zyada chal raha tha, PHP ne script band kar di.  
- **Jab aata hai:** Checkout, wallet, ya koi slow page jab 5 min se zyada run ho.  
- **Fix:** Us route/controller me kaun sa code slow hai (DB, loop, external API) wo dhundhna hoga; ya `max_execution_time` badha do (sirf temporary).

---

## 3. JobBoardHelper / PackageContext (pehle fix ho chuka)

- **Error:** `Non-static method JobBoardHelper::isEnabledCreditsSystem() cannot be called statically` at `PackageContext.php`  
- **Fix:** `JobBoardHelper::isEnabledCreditsSystem()` ko static bana diya + `PackageContext` me direct concrete class use kiya.

---

## 4. Route not defined

- **Error:** `Route [public.account.package.subscribe] not defined`  
- **Fix:** Cancel URL ke liye `public.account.package.subscribe.checkout` use kiya.

---

## 5. Config file missing (purana)

- **Error:** `require(.../platform/core/base/config/general.php): Failed to open stream: No such file or directory`  
- **Meaning:** Wo config file missing thi (ab ho sakta hai add ho chuki ho).

---

## 6. View / PHP errors (purane)

- **Error:** `syntax error, unexpected identifier "nk"` in `footer.blade.php`  
- **Error:** `in_array(): Argument #2 ($haystack) must be of type array, string given` in `settings/index.blade.php`  
- **Error:** `Column not found: 1054 Unknown column 'order' in 'order clause'` (faqs table)  
- **Error:** `Route [public.companies] not defined` in company.blade.php  

Inme se jo ab bhi reproduce ho, unki file + line fix karni hogi.

---

## Abhi ke liye jo errors bar-bar aa rahe hon

1. **Maximum execution time of 300 seconds exceeded** – checkout/wallet ya koi page 5 min se zyada chal raha hai; us request ka code optimize karna hoga.  
2. **Razorpay callback return type** – agar ab bhi dikhe to `RazorpayController::callback()` ka return type `\Symfony\Component\HttpFoundation\Response` hi hona chahiye (already set hai).

Naya error aaye to `storage/logs/laravel.log` me last lines dekho aur usi exact message ko is list me add kar sakte ho.
