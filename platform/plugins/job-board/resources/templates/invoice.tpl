<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Tax Invoice - #{{ invoice.code|default('') }}</title>
    <style>
        body {
            font-size: 14px;
            font-family: '{{ settings.font_family|default("DejaVu Sans") }}', Arial, sans-serif !important;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table tr td {
            padding: 4px 8px;
            vertical-align: top;
        }

        .bold, strong, b, .total, .stamp {
            font-weight: 700;
        }

        .right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .large {
            font-size: 1.25em;
        }

        .total {
            color: #c00;
        }

        .logo-container {
            margin: 0 0 20px;
            text-align: left;
        }

        .logo-container img {
            max-height: 80px;
        }

        .invoice-headline {
            font-size: 1.5em;
            font-weight: 700;
            margin: 10px 0 20px;
            text-align: center;
        }

        .info-block {
            margin-bottom: 20px;
            font-size: 0.9em;
        }

        .info-block p {
            margin: 3px 0;
        }

        .info-block .section-title {
            font-weight: 700;
            margin-bottom: 8px;
            border-bottom: 1px solid #333;
            padding-bottom: 4px;
        }

        .line-items-container {
            font-size: 0.9em;
            margin: 25px 0;
        }

        .line-items-container th {
            border: 1px solid #333;
            background: #f5f5f5;
            padding: 8px 6px;
            text-align: left;
        }

        .line-items-container th.heading-qty,
        .line-items-container th.heading-cost,
        .line-items-container th.heading-gst,
        .line-items-container th.heading-total {
            text-align: right;
            width: 80px;
        }

        .line-items-container td {
            border: 1px solid #ddd;
            padding: 8px 6px;
        }

        .line-items-container td.col-qty,
        .line-items-container td.col-cost,
        .line-items-container td.col-gst,
        .line-items-container td.col-total {
            text-align: right;
        }

        .footer-block {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #333;
            font-size: 0.85em;
            line-height: 1.5;
        }

        .footer-block .bank-details {
            margin: 10px 0;
        }

        .footer-block .bank-details p {
            margin: 3px 0;
        }

        .footer-block .disclaimer {
            margin-top: 15px;
            font-size: 0.9em;
            color: #555;
        }

        .stamp {
            border: 2px solid #0a9928;
            color: #0a9928;
            display: inline-block;
            font-size: 22px;
            left: 50%;
            line-height: 1;
            padding: 10px 24px;
            position: fixed;
            text-transform: uppercase;
            top: 40%;
            transform: translate(-50%, -50%) rotate(-12deg);
            letter-spacing: 3px;
            z-index: 10;
        }

        .stamp.is-failed {
            border-color: #d23;
            color: #d23;
        }

        .stamp.is-completed {
            border-color: #0a9928;
            color: #0a9928;
        }

        .meta-row td {
            padding: 4px 8px;
        }
    </style>
    {{ invoice_header_filter | raw }}
</head>
<body>
{# PAID stamp: only when payment is successful #}
{% if settings.enable_invoice_stamp|default(true) %}
    {% set is_paid = (payment_status|default('')) == 'Completed' %}
    {% if is_paid %}
        <span class="stamp is-completed">PAID</span>
    {% else %}
        <span class="stamp is-failed">UNPAID</span>
    {% endif %}
{% endif %}

{# Teachers Recruiter / Company Logo - show only if set in admin #}
<div class="logo-container">
    {% if logo_full_path %}
        <img src="{{ logo_full_path }}" alt="{{ settings.company_name_for_invoicing|default('Company') }}">
    {% endif %}
</div>

<h1 class="invoice-headline">Tax Invoice</h1>

{# Invoice Number, Date, Payment Method, Transaction ID #}
<table class="info-block" style="width:100%; margin-bottom:20px;">
    <tr>
        <td><strong>Invoice Number</strong></td>
        <td>#{{ invoice.code }}</td>
        <td><strong>Invoice Date</strong></td>
        <td>{{ invoice.created_at|date('d M Y') }}</td>
    </tr>
    <tr class="meta-row">
        <td><strong>Payment Method</strong></td>
        <td>{{ payment_method|default('-') }}</td>
        <td><strong>Transaction ID</strong></td>
        <td>{{ transaction_id|default('-') }}</td>
    </tr>
</table>

{# Details of Employer on Invoice - show each line only if value present #}
<table style="width:100%; margin-bottom:25px;">
    <tr>
        <td style="width:50%; vertical-align:top;">
            <div class="info-block">
                <div class="section-title">Details of Employer on Invoice</div>
                <p><strong>Institution Name:</strong> {{ invoice.company_name|default('-') }}</p>
                <p><strong>Address with City, State, Pin Code:</strong> {{ invoice.customer_address|default('-') }}</p>
                <p><strong>GST No (If available):</strong> {% if (customer_gst_number|default(''))|trim != '' %}{{ customer_gst_number }}{% else %}{{ tax_id|default('N/A') }}{% endif %}</p>
                <p><strong>Phone:</strong> {{ invoice.customer_phone|default('-') }}</p>
                <p><strong>Email:</strong> {{ invoice.customer_email|default('-') }}</p>
            </div>
        </td>
        <td style="width:50%; vertical-align:top;">
            <div class="info-block">
                <div class="section-title">Our Company Details on Invoice</div>
                <p><strong>Company Name:</strong> {{ settings.company_name_for_invoicing|default('-') }}</p>
                <p><strong>Address with Pincode, City and State:</strong> {{ settings.company_address_for_invoicing|default('-') }}</p>
                <p><strong>Phone:</strong> {{ settings.company_phone_for_invoicing|default('-') }}</p>
                <p><strong>Email:</strong> {{ settings.company_email_for_invoicing|default('-') }}</p>
                <p><strong>GST No:</strong> {{ settings.company_gst_for_invoicing|default('N/A') }}</p>
            </div>
        </td>
    </tr>
</table>

{# Plan/Service Description: Plan Name, Validity, Plan Features, Qty, Plan Cost, GST (CGST/SGST) 18%, Total Amount #}
<table class="line-items-container">
    <thead>
    <tr>
        <th>Plan Name</th>
        <th class="heading-qty">Validity</th>
        <th style="min-width:140px;">Plan Features</th>
        <th class="heading-qty">Qty</th>
        <th class="heading-cost">Plan Cost</th>
        <th class="heading-gst">GST (CGST/SGST) 18%</th>
        <th class="heading-total">Total Amount</th>
    </tr>
    </thead>
    <tbody>
    {% for item in invoice.items|default([]) %}
        <tr>
            <td>{{ item.name|default('-') }}</td>
            <td class="col-qty">
                {% if item.metadata is defined and item.metadata is not null and item.metadata.validity is defined and item.metadata.validity %}
                    {{ item.metadata.validity }}
                {% else %}
                    -
                {% endif %}
            </td>
            <td>{% if item.description %}{{ item.description }}{% else %}-{% endif %}</td>
            <td class="col-qty">{{ item.qty }}</td>
            <td class="col-cost">{{ item.amount|price_format(currency) }}</td>
            <td class="col-gst">
                {% if item.tax_amount and item.tax_amount > 0 %}
                    {{ item.tax_amount|price_format(currency) }}
                {% else %}
                    -
                {% endif %}
            </td>
            <td class="col-total">{{ (item.amount * item.qty)|price_format(currency) }}</td>
        </tr>
    {% endfor %}
    </tbody>
</table>

{# Totals: GST row only if tax present, Discount only if present #}
<table style="width:100%; max-width:400px; margin-left:auto;">
    {% if invoice.tax_amount and invoice.tax_amount > 0 %}
    <tr>
        <td class="right" style="padding:4px 8px;">GST (CGST/SGST) Amount (18%):</td>
        <td class="right bold" style="padding:4px 8px;">{{ invoice.tax_amount|price_format(currency) }}</td>
    </tr>
    {% endif %}
    {% if invoice.discount_amount and invoice.discount_amount > 0 %}
    <tr>
        <td class="right" style="padding:4px 8px;">Discount:</td>
        <td class="right" style="padding:4px 8px;">{{ invoice.discount_amount|price_format(currency) }}</td>
    </tr>
    {% endif %}
    <tr>
        <td class="right" style="padding:8px;"><strong>Total Amount:</strong></td>
        <td class="right large total" style="padding:8px;">{{ invoice.amount|price_format(currency) }}</td>
    </tr>
</table>

{# Footer: Bank Details + Thanks + Disclaimer #}
<div class="footer-block">
    <div class="section-title">Bank Details</div>
    <div class="bank-details">
        <p><strong>Account Number:</strong> {{ (bank_details is defined and bank_details) ? (bank_details.account_number|default('3566282988')) : '3566282988' }}</p>
        <p><strong>Account Name:</strong> {{ (bank_details is defined and bank_details) ? (bank_details.account_name|default('Teachers Recruiter')) : 'Teachers Recruiter' }}</p>
        <p><strong>IFSC:</strong> {{ (bank_details is defined and bank_details) ? (bank_details.ifsc|default('CBIN0281043')) : 'CBIN0281043' }}</p>
        <p><strong>Bank Name:</strong> {{ (bank_details is defined and bank_details) ? (bank_details.bank_name|default('Central Bank of India')) : 'Central Bank of India' }}</p>
    </div>
    <p style="margin-top:15px;"><strong>Thanks for using teachersrecruiter.in!</strong></p>
    <div class="disclaimer">
        This invoice serves as proof of payment for the services provided by Teachers Recruiter. The payment is non-refundable. Please use the order no. for future inquiries. This document is electronically generated and does not require a signature.
    </div>
</div>
{{ job_board_invoice_footer | raw }}
</body>
</html>
