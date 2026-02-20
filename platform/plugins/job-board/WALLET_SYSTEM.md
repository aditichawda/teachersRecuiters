# Wallet System for Revenue Model

This document describes each field and feature of the Wallet system so you can add or remove parts accordingly.

---

## 1. Overview

The Wallet page (`/account/wallet`) is available to **employers** when the **Credits System** is enabled (Admin → Job Board → Settings → Enable credits system). It provides:

- **Wallet balance** (current credits)
- **Credit/Debit information** (total credited, total debited)
- **Transaction details** (history of all credit/debit)
- **Invoice details** (list of invoices with View and Download)

---

## 2. Wallet & Credit/Debit Information

### 2.1 Wallet Balance

| Field / Feature        | Description                    | Where to change / remove                    |
|------------------------|--------------------------------|----------------------------------------------|
| **Current balance**    | Shows `account.credits`        | Model: `Account`, column: `credits`          |
| **Label**              | "Wallet Balance"               | Lang: `dashboard.wallet_balance`             |
| **Buy Credits button** | Link to Packages page          | View: wallet.blade.php; route: packages     |

To remove: Delete the first card in the wallet view and the "Buy Credits" link if you do not want top-up.

### 2.2 Credit Summary (Total Credited)

| Field / Feature | Description                          | Where to change / remove        |
|-----------------|--------------------------------------|----------------------------------|
| **Total credit**| Sum of all transactions where type ≠ deduct | View: `$account->transactions()` |
| **Label**       | "Credit"                             | Lang: `dashboard.wallet_credit` |

To remove: Delete the second summary card in the wallet view.

### 2.3 Debit Summary (Total Debited)

| Field / Feature | Description                                  | Where to change / remove        |
|-----------------|----------------------------------------------|----------------------------------|
| **Total debit** | Sum of all transactions where type = deduct  | View: same transactions query   |
| **Label**       | "Debit"                                      | Lang: `dashboard.wallet_debit`   |

To remove: Delete the third summary card. To **add** debit entries: when a job is posted or renewed, create a row in `jb_transactions` with `type = 'deduct'`, `credits = 1`, `account_id`, and optional `description` (e.g. "Job post: Job Title").

---

## 3. Transaction Details

| Field / Feature | Description                    | Where to change / remove                    |
|-----------------|--------------------------------|----------------------------------------------|
| **Table**       | List of all wallet transactions | Controller: `WalletController@index`; view: wallet.blade.php |
| **Date**        | `created_at` of transaction    | Column: `jb_transactions.created_at`         |
| **Description** | Human-readable text (purchase, admin add, or debit) | Model: `Transaction::getDescription()` |
| **Amount**      | Credits (+ for credit, − for debit) | Column: `jb_transactions.credits` and `type` |

### Transaction model (`jb_transactions`)

| Column        | Type    | Purpose                                      |
|---------------|---------|----------------------------------------------|
| id            | bigint  | Primary key                                  |
| credits       | int     | Number of credits (always positive; sign shown by type) |
| description   | string  | Optional custom text (e.g. for debit)        |
| type          | string  | `add` = credit, `deduct` = debit             |
| user_id       | FK      | Set when admin adds credits                  |
| account_id    | FK      | Employer account                             |
| payment_id    | FK      | Set when credits from package purchase       |
| created_at    | datetime| Transaction time                            |

To remove: Omit the "Transaction details" card/section from the wallet view and optionally the summary cards that use the same data.

---

## 4. Invoice Details and Download

| Field / Feature   | Description                    | Where to change / remove                    |
|-------------------|--------------------------------|----------------------------------------------|
| **Invoice list**  | Invoices for current account  | Controller: `WalletController@index` (invoices query) |
| **Code**          | Invoice code                  | `jb_invoices.code`                           |
| **Amount**        | Invoice amount (formatted)     | `jb_invoices.amount` + currency             |
| **Status**        | Pending / Processing / Completed / Canceled | `jb_invoices.status` (enum)        |
| **Date**          | Invoice created_at            | `jb_invoices.created_at`                    |
| **View**          | Link to invoice detail page   | Route: `public.account.invoices.show`       |
| **Download**      | PDF download                   | Route: `public.account.invoices.generate_invoice` with `type=download` |

To remove: Delete the "Invoice details" card and the "View Invoices" link. You can keep the separate Invoices menu item for a full list.

---

## 5. Routes and Menu

| Item           | Route / Usage                              | Where to change / remove        |
|----------------|--------------------------------------------|----------------------------------|
| **Wallet page**| `GET /account/wallet`                      | `routes/account.php` → WalletController |
| **Menu item**  | "Wallet" in employer dashboard sidebar     | `JobBoardServiceProvider` (DashboardMenu) |
| **Middleware** | `account:employer`, `enable-credits`        | Same route group in account.php |

To remove wallet: Remove the wallet route group, the Wallet menu registration, and the WalletController (and view if unused elsewhere).

---

## 6. Adding Debit When Job is Posted/Renewed

To record a **debit** when an employer posts or renews a job:

1. In `AccountJobController@store` (and `update` for renew) or wherever credits are decremented (e.g. `$account->credits--`), after decreasing credits add:

```php
use Botble\JobBoard\Models\Transaction;

Transaction::query()->create([
    'account_id' => $account->getKey(),
    'credits' => 1,
    'type' => Transaction::TYPE_DEBIT,
    'description' => 'Job post: ' . $job->name, // or "Job renewed: ..."
]);
```

2. Ensure `jb_transactions` has column `type` (default `'add'`). It exists in the original migration.

---

## 7. Feature Checklist (Add/Remove)

- [ ] **Wallet balance card** – current credits + Buy Credits button  
- [ ] **Total credited card** – sum of credit transactions  
- [ ] **Total debited card** – sum of debit transactions  
- [ ] **Transaction table** – date, description, amount (+/-)  
- [ ] **Invoice table** – code, amount, status, date  
- [ ] **View invoice** – link to detail page  
- [ ] **Download invoice** – PDF download link  
- [ ] **Record debit on job post/renew** – optional; add Transaction row with type `deduct`  

You can remove any section from the wallet view (or hide via setting) and keep the rest. All labels are in language files so they can be renamed or translated without code changes.
