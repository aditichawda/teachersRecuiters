# Invoice View vs Download – Flow (Link by Link)

## Routes

| Action   | URL | Route name | Controller method |
|----------|-----|------------|--------------------|
| **View** (detail page) | `GET /account/invoices/{id}` | `public.account.invoices.show` | `InvoiceController@show` |
| **Download** (PDF)     | `GET /account/invoices/{id}/generate-invoice?type=download` | `public.account.invoices.generate_invoice` | `InvoiceController@getGenerateInvoice` |
| **Print** (PDF in tab) | `GET /account/invoices/{id}/generate-invoice?type=print` | same | same |

All are under `account` middleware (login required).  
File: `platform/plugins/job-board/routes/account.php` (around lines 248–250).

---

## 1. VIEW Invoice (detail page) – step by step

**URL:** `http://127.0.0.1:8000/account/invoices/33`

1. **Route**  
   `GET account/invoices/{invoice}` → `InvoiceController@show`, `invoice` = 33 (model binding).

2. **InvoiceController@show**
   - `$invoice->loadMissing(['payment', 'items'])` – payment aur items load.
   - `canViewInvoice($invoice)` – check karta hai ki logged-in account is invoice ka owner hai (payment.customer_id ya Transaction se). Agar nahi → 404.
   - Title/SEO set karta hai.
   - Return: **Blade view**  
     `JobBoardHelper::view('dashboard.invoices.detail', compact('invoice', 'layout'))`.

3. **View file**  
   `platform/plugins/job-board/resources/views/themes/dashboard/invoices/detail.blade.php`  
   - Invoice number, date, payment method, transaction ID.
   - Employer details (company name, address, GST, phone, email).
   - Company details (settings se).
   - Table: plan name, **validity** (item metadata ya Package se), plan features, qty, cost, GST, total.
   - Totals, bank details.
   - Buttons: **Print** → `generate-invoice?type=print`, **Download** → `generate-invoice?type=download`.

**Result:** HTML page; koi PDF generate nahi hota. Isliye view hamesha fast aur simple hai.

---

## 2. DOWNLOAD Invoice (PDF) – step by step

**URL:** `http://127.0.0.1:8000/account/invoices/33/generate-invoice?type=download`

1. **Route**  
   `GET account/invoices/{invoice}/generate-invoice` → `InvoiceController@getGenerateInvoice`.  
   Query: `type=download`.

2. **InvoiceController@getGenerateInvoice**
   - `$invoice->loadMissing(['payment', 'items'])`.
   - `canViewInvoice($invoice)` – same permission check. Agar fail → 404.
   - `session()->save()` – session lock release (taaki PDF generate karte waqt doosri requests block na hon).
   - `set_time_limit(120)` – PDF ke liye 120 sec.
   - **Agar `type=print`:**  
     `return $invoiceHelper->streamInvoice($invoice);`  
     → PDF browser me open (inline).
   - **Agar `type=download` (ya default):**  
     `return $invoiceHelper->downloadInvoice($invoice);`  
     → PDF file download (attachment).

3. **InvoiceHelper@downloadInvoice**
   - `$pdf = $this->makeInvoice($invoice)` – PDF object banta hai (DOM PDF).
   - `$content = $pdf->output()` – PDF binary string.
   - Filename: `invoice-{code}.pdf`.
   - Return: **HTTP response**  
     `Content-Type: application/pdf`,  
     `Content-Disposition: attachment; filename="invoice-33.pdf"`,  
     body = PDF binary.

4. **InvoiceHelper@makeInvoice**
   - Template path: `plugin_path('job-board/resources/templates/invoice.tpl')`.
   - Custom path: `storage_path('app/templates/invoice.tpl')` (agar hai to use).
   - **Data:** `getDataForInvoiceTemplate($invoice)` se:
     - invoice, payment, items (with **validity** in item metadata for PDF).
     - currency, logo path, tax_id, customer_gst_number, transaction_id, payment_method, payment_status.
     - bank_details, settings (company name, address, GST, etc.).
   - **Pdf (Base)**  
     `(new Pdf())->templatePath(...)->data(...)->compile()`  
     → Twig se HTML compile → DomPDF `loadHTML()` → return DomPDF instance.

5. **Base Pdf@compile** (core)
   - Template file read (customized ya default).
   - **Twig compile:** template + data → HTML string.  
     Invoice template (`invoice.tpl`) me: logo, invoice fields, items (name, **validity**, description, qty, amount, tax, total), totals, bank details.
   - DomPDF options: chroot = [public_path(), base_path()], tempDir = storage/app, isRemoteEnabled = true.
   - `loadHTML($content, 'UTF-8')` → PDF render.
   - Return DomPDF object; `output()` se binary milta hai.

**Result:** Browser ko PDF response milti hai; “Save as” / download dialog (type=download) ya new tab me open (type=print).

---

## 3. View vs Download – difference (short)

| Step | View (detail) | Download (PDF) |
|------|----------------|----------------|
| Response | HTML (Blade view) | PDF binary (DomPDF) |
| Template | `invoices/detail.blade.php` | `invoice.tpl` (Twig) |
| Data | Same invoice from DB | `getDataForInvoiceTemplate()` (invoice + items + validity + settings) |
| Logo / images | Normal img tags (web) | DomPDF – logo path must be **local file path** inside chroot |
| Errors | Blade/PHP errors | DomPDF / Twig / missing file can break download |

---

## 4. Download pe issue kyon ho sakta hai

- **Logo:** Agar `logo_full_path` invalid ya DomPDF ke chroot ke bahar ho to image load fail → PDF fail.
- **Template / Twig:** Agar koi variable null hai ya format galat hai to Twig/DomPDF error de sakta hai.
- **Font / encoding:** Custom font ya character DomPDF support na kare to render fail.
- **Memory / time:** Badi invoice ya heavy template pe timeout ya memory limit.

**Fix direction:**  
- Logo path sirf tab pass karo jab file exist kare; nahi to `null` (template me already `{% if logo_full_path %}`).  
- Controller me try-catch: exception log karo, user ko clear error/redirect do.

---

## 5. Important files (short list)

- **Routes:** `platform/plugins/job-board/routes/account.php`
- **Controller:** `platform/plugins/job-board/src/Http/Controllers/Fronts/InvoiceController.php`  
  – `show()`, `getGenerateInvoice()`, `canViewInvoice()`
- **View (HTML):** `platform/plugins/job-board/resources/views/themes/dashboard/invoices/detail.blade.php`
- **PDF:** `platform/plugins/job-board/src/Supports/InvoiceHelper.php`  
  – `downloadInvoice()`, `streamInvoice()`, `makeInvoice()`, `getDataForInvoiceTemplate()`
- **PDF template:** `platform/plugins/job-board/resources/templates/invoice.tpl`
- **Base PDF:** `platform/core/base/src/Supports/Pdf.php`
