{{-- Fraud Alert - Warning Themed Layout --}}
{!! Theme::partial('hiw-styles') !!}

<style>
/* ===== Fraud Alert Page Styles ===== */

/* Hero - Red/Dark warning theme */
.fraud-hero {
    padding: 80px 0 60px;
    background: linear-gradient(160deg, #450a0a 0%, #7f1d1d 40%, #991b1b 100%);
    position: relative;
    overflow: hidden;
}
.fraud-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M20 0L0 20h10L20 10l10 10h10z'/%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
}
.fraud-hero::after {
    content: '';
    position: absolute;
    top: -100px;
    right: -80px;
    width: 450px;
    height: 450px;
    background: radial-gradient(circle, rgba(239,68,68,.15) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}
.fraud-hero .hiw-label {
    background: rgba(239,68,68,.2);
    color: #fca5a5;
    border-color: rgba(239,68,68,.3);
}
.fraud-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(239,68,68,.15);
    border: 1px solid rgba(239,68,68,.3);
    color: #fca5a5;
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 20px;
    animation: pulse-badge 2s infinite;
}
@keyframes pulse-badge {
    0%, 100% { opacity: 1; }
    50% { opacity: .7; }
}
.fraud-hero-badge i {
    font-size: 16px;
}
.fraud-hero-title {
    font-size: 46px;
    font-weight: 800;
    color: #fff;
    line-height: 1.15;
    margin-bottom: 20px;
}
.fraud-hero-title span {
    color: #fca5a5;
}
.fraud-hero-desc {
    font-size: 17px;
    color: rgba(255,255,255,.7);
    line-height: 1.8;
    margin-bottom: 15px;
    max-width: 580px;
}
.fraud-hero-warning-box {
    background: rgba(239,68,68,.12);
    border: 1px solid rgba(239,68,68,.25);
    border-radius: 12px;
    padding: 16px 20px;
    margin-top: 25px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    max-width: 580px;
}
.fraud-hero-warning-box i {
    color: #f87171;
    font-size: 20px;
    margin-top: 2px;
    flex-shrink: 0;
}
.fraud-hero-warning-box p {
    color: rgba(255,255,255,.8);
    font-size: 14px;
    line-height: 1.6;
    margin: 0;
}
.fraud-hero-visual {
    text-align: center;
    position: relative;
}
.fraud-shield-circle {
    width: 240px;
    height: 240px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(239,68,68,.15) 0%, rgba(239,68,68,.05) 100%);
    border: 2px solid rgba(239,68,68,.2);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    position: relative;
    box-shadow: 0 0 80px rgba(239,68,68,.15);
}
.fraud-shield-circle i {
    font-size: 80px;
    color: #f87171;
}
.fraud-shield-circle::after {
    content: '';
    position: absolute;
    inset: -15px;
    border: 1px dashed rgba(239,68,68,.2);
    border-radius: 50%;
    animation: spin-slow 30s linear infinite;
}
@keyframes spin-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Danger cards row */
.fraud-danger-section {
    padding: 70px 0;
    background: #fff;
}
.fraud-danger-card {
    background: #fff;
    border-radius: 16px;
    padding: 30px;
    height: 100%;
    border: 1px solid #fee2e2;
    border-left: 5px solid #ef4444;
    transition: all .3s;
    box-shadow: 0 4px 15px rgba(0,0,0,.03);
}
.fraud-danger-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 35px rgba(239,68,68,.1);
    border-color: #fca5a5;
}
.fraud-danger-card-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    color: #fff;
    margin-bottom: 18px;
    background: linear-gradient(135deg, #dc2626, #ef4444);
    box-shadow: 0 6px 15px rgba(239,68,68,.3);
}
.fraud-danger-card h4 {
    font-size: 17px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 10px;
}
.fraud-danger-card p {
    font-size: 14px;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

/* How to identify section */
.fraud-identify-section {
    padding: 70px 0;
    background: #fef2f2;
}
.fraud-identify-card {
    background: #fff;
    border-radius: 16px;
    padding: 35px 30px;
    height: 100%;
    text-align: center;
    border: 1px solid #fecaca;
    transition: all .3s;
    box-shadow: 0 4px 15px rgba(0,0,0,.03);
}
.fraud-identify-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(239,68,68,.08);
}
.fraud-identify-num {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #dc2626, #ef4444);
    color: #fff;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 18px;
    box-shadow: 0 6px 15px rgba(239,68,68,.25);
}
.fraud-identify-card h4 {
    font-size: 17px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 10px;
}
.fraud-identify-card p {
    font-size: 14px;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

/* Safe practices */
.fraud-safe-section {
    padding: 70px 0;
    background: #fff;
}
.fraud-safe-card {
    background: #f0fdf4;
    border-radius: 16px;
    padding: 28px;
    height: 100%;
    border: 1px solid #bbf7d0;
    transition: all .3s;
}
.fraud-safe-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(34,197,94,.1);
    border-color: #86efac;
}
.fraud-safe-icon {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, #16a34a, #22c55e);
    color: #fff;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    margin-bottom: 14px;
}
.fraud-safe-card h5 {
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 8px;
}
.fraud-safe-card p {
    font-size: 14px;
    color: #475569;
    line-height: 1.6;
    margin: 0;
}

/* Report section */
.fraud-report-section {
    padding: 70px 0;
    background: #1e293b;
    position: relative;
    overflow: hidden;
}
.fraud-report-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
}
.fraud-report-box {
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 20px;
    padding: 40px;
    text-align: center;
}
.fraud-report-box h3 {
    font-size: 28px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 12px;
}
.fraud-report-box p {
    font-size: 16px;
    color: #94a3b8;
    margin-bottom: 30px;
    max-width: 550px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.7;
}
.fraud-report-channels {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 30px;
}
.fraud-report-channel {
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 14px;
    padding: 20px 28px;
    text-align: center;
    min-width: 180px;
    transition: all .3s;
}
.fraud-report-channel:hover {
    background: rgba(255,255,255,.1);
    border-color: rgba(255,255,255,.2);
    transform: translateY(-3px);
}
.fraud-report-channel i {
    font-size: 28px;
    color: #f87171;
    margin-bottom: 10px;
    display: block;
}
.fraud-report-channel h6 {
    font-size: 13px;
    font-weight: 600;
    color: #94a3b8;
    margin-bottom: 4px;
    text-transform: uppercase;
    letter-spacing: .5px;
}
.fraud-report-channel span {
    font-size: 15px;
    color: #fff;
    font-weight: 600;
}

/* Disclaimer */
.fraud-disclaimer-section {
    padding: 50px 0;
    background: #fffbeb;
    border-top: 3px solid #f59e0b;
}
.fraud-disclaimer-box {
    display: flex;
    gap: 20px;
    align-items: flex-start;
    max-width: 900px;
    margin: 0 auto;
}
.fraud-disclaimer-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #d97706, #f59e0b);
    color: #fff;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
}
.fraud-disclaimer-box h4 {
    font-size: 18px;
    font-weight: 700;
    color: #92400e;
    margin-bottom: 8px;
}
.fraud-disclaimer-box p {
    font-size: 15px;
    color: #78350f;
    line-height: 1.7;
    margin: 0;
}

@media(max-width:991px) {
    .fraud-hero-title { font-size: 34px; }
    .fraud-shield-circle { width: 180px; height: 180px; }
    .fraud-shield-circle i { font-size: 60px; }
}
@media(max-width:767px) {
    .fraud-hero { padding: 50px 0 40px; }
    .fraud-hero-title { font-size: 28px; }
    .fraud-hero-visual { margin-top: 30px; }
    .fraud-danger-section, .fraud-identify-section, .fraud-safe-section, .fraud-report-section { padding: 50px 0; }
    .fraud-report-box { padding: 25px; }
    .fraud-disclaimer-box { flex-direction: column; text-align: center; align-items: center; }
}
</style>

{{-- SECTION 1: Red/Dark Hero --}}
<section class="fraud-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="fraud-hero-badge">
                    <i class="feather-alert-triangle"></i>
                    <span>Important Safety Notice</span>
                </div>
                <h1 class="fraud-hero-title">Fraud & <span>Spam Alert</span></h1>
                <p class="fraud-hero-desc">
                    Protect yourself from fraudulent job offers and scams. Teachers Recruiter is committed 
                    to safeguarding our community. Learn how to identify and report suspicious activities.
                </p>
                <p class="fraud-hero-desc">
                    We have noticed instances where fraudsters impersonate Teachers Recruiter or its 
                    partner schools to deceive job seekers. Stay alert and stay safe.
                </p>
                <div class="fraud-hero-warning-box">
                    <i class="feather-alert-octagon"></i>
                    <p><strong>Remember:</strong> Teachers Recruiter will NEVER ask you for money, OTPs, bank details, 
                    or any payment to process your job application. If anyone does, it is a scam.</p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="fraud-hero-visual">
                    <div class="fraud-shield-circle">
                        <i class="feather-alert-triangle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2: Common Fraud Types --}}
<section class="fraud-danger-section">
    <div class="container">
        <div class="hiw-section-header">
            <span class="hiw-label" style="color:#dc2626;background:rgba(239,68,68,.1);border-color:rgba(239,68,68,.2);">Beware</span>
            <h2 class="hiw-section-title">Common Types of Fraud</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="fraud-danger-card">
                    <div class="fraud-danger-card-icon"><i class="feather-dollar-sign"></i></div>
                    <h4>Money for Jobs</h4>
                    <p>Scammers demand registration fees, processing charges, or security deposits to "guarantee" a teaching job. Legitimate recruiters never charge candidates.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="fraud-danger-card">
                    <div class="fraud-danger-card-icon"><i class="feather-mail"></i></div>
                    <h4>Fake Emails & SMS</h4>
                    <p>Fraudulent emails or messages claiming to be from Teachers Recruiter with fake offer letters, interview calls, or payment links. Always verify the sender.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="fraud-danger-card">
                    <div class="fraud-danger-card-icon"><i class="feather-phone"></i></div>
                    <h4>Impersonation Calls</h4>
                    <p>Callers pretending to be from Teachers Recruiter asking for your OTP, Aadhaar number, bank details, or UPI PIN. We never make such requests.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="fraud-danger-card">
                    <div class="fraud-danger-card-icon"><i class="feather-globe"></i></div>
                    <h4>Fake Websites</h4>
                    <p>Clone websites that look like Teachers Recruiter but have slightly different URLs. Always check for <strong>teachersrecruiter.in</strong> in the address bar.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="fraud-danger-card">
                    <div class="fraud-danger-card-icon"><i class="feather-message-circle"></i></div>
                    <h4>WhatsApp/Telegram Scams</h4>
                    <p>Fake WhatsApp groups or Telegram channels offering "guaranteed placements" for a fee. Our official channels never ask for payments via messaging apps.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="fraud-danger-card">
                    <div class="fraud-danger-card-icon"><i class="feather-file-text"></i></div>
                    <h4>Fake Offer Letters</h4>
                    <p>Forged appointment letters or offer letters with Teachers Recruiter's logo demanding advance payment before joining. These are 100% fraudulent.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3: How to Identify Fraud --}}
<section class="fraud-identify-section">
    <div class="container">
        <div class="hiw-section-header">
            <span class="hiw-label" style="color:#dc2626;background:rgba(239,68,68,.1);border-color:rgba(239,68,68,.2);">Stay Alert</span>
            <h2 class="hiw-section-title">How to Spot a Scam</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="fraud-identify-card">
                    <span class="fraud-identify-num">1</span>
                    <h4>Too Good to Be True</h4>
                    <p>Unrealistic salary offers, guaranteed jobs without interviews, or instant placement promises are classic red flags.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="fraud-identify-card">
                    <span class="fraud-identify-num">2</span>
                    <h4>Demands Money</h4>
                    <p>Any request for money — registration fee, processing charge, training fee, or security deposit — is a scam. Period.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="fraud-identify-card">
                    <span class="fraud-identify-num">3</span>
                    <h4>Pressure Tactics</h4>
                    <p>Urgency like "pay now or lose the offer", "limited seats", or "last date today" is designed to make you panic and pay.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="fraud-identify-card">
                    <span class="fraud-identify-num">4</span>
                    <h4>Asks Personal Info</h4>
                    <p>Requests for OTP, bank account details, UPI PIN, Aadhaar card, or passwords via call/message are always fraudulent.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4: Safe Practices --}}
<section class="fraud-safe-section">
    <div class="container">
        <div class="hiw-section-header">
            <span class="hiw-label" style="color:#16a34a;background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.2);">Stay Safe</span>
            <h2 class="hiw-section-title">How to Protect Yourself</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="fraud-safe-card">
                    <div class="fraud-safe-icon"><i class="feather-check-circle"></i></div>
                    <h5>Verify the Source</h5>
                    <p>Always apply through our official website <strong>teachersrecruiter.in</strong>. Don't trust links from unknown sources.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="fraud-safe-card">
                    <div class="fraud-safe-icon"><i class="feather-lock"></i></div>
                    <h5>Never Share OTP</h5>
                    <p>Never share your OTP, passwords, bank details, or UPI PIN with anyone claiming to be from Teachers Recruiter.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="fraud-safe-card">
                    <div class="fraud-safe-icon"><i class="feather-dollar-sign"></i></div>
                    <h5>Never Pay Money</h5>
                    <p>We do not charge candidates any fee for job applications, registrations, or placements. Don't pay anyone.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="fraud-safe-card">
                    <div class="fraud-safe-icon"><i class="feather-link"></i></div>
                    <h5>Check URLs Carefully</h5>
                    <p>Verify the website URL before entering any information. Look for HTTPS and the correct domain name.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="fraud-safe-card">
                    <div class="fraud-safe-icon"><i class="feather-search"></i></div>
                    <h5>Research the School</h5>
                    <p>Before accepting any offer, verify the school's existence through independent research, not just the caller's claims.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="fraud-safe-card">
                    <div class="fraud-safe-icon"><i class="feather-flag"></i></div>
                    <h5>Report Immediately</h5>
                    <p>If you encounter anything suspicious, report it to us immediately. Quick reporting helps protect others too.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 5: Report Fraud --}}
<section class="fraud-report-section">
    <div class="container">
        <div class="fraud-report-box">
            <h3>Report Fraud or Suspicious Activity</h3>
            <p>If you have been targeted by a scam or received a suspicious communication, please report it to us through any of these channels:</p>
            <div class="fraud-report-channels">
                <div class="fraud-report-channel">
                    <i class="feather-mail"></i>
                    <h6>Email</h6>
                    <span>report@teachersrecruiter.com</span>
                </div>
                <div class="fraud-report-channel">
                    <i class="feather-phone"></i>
                    <h6>Helpline</h6>
                    <span>+91 98765 43210</span>
                </div>
                <div class="fraud-report-channel">
                    <i class="feather-message-circle"></i>
                    <h6>WhatsApp</h6>
                    <span>+91 98765 43210</span>
                </div>
            </div>
            <p style="font-size:14px;color:#64748b;">Please include screenshots, phone numbers, and any details of the fraudulent communication to help us investigate.</p>
        </div>
    </div>
</section>

{{-- SECTION 6: Disclaimer --}}
<section class="fraud-disclaimer-section">
    <div class="container">
        <div class="fraud-disclaimer-box">
            <div class="fraud-disclaimer-icon">
                <i class="feather-info"></i>
            </div>
            <div>
                <h4>Official Disclaimer</h4>
                <p>Teachers Recruiter is not responsible for any financial loss incurred due to fraudulent activities by third parties impersonating our brand. We strongly advise all users to verify all communications and only use our official website and verified contact channels. If you have already made a payment to a fraudster, please file a complaint with your local cyber crime cell immediately.</p>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 7: CTA --}}
<section class="hiw-cta-section" style="background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);">
    <div class="container">
        <div class="hiw-cta-content">
            <h2>Stay Vigilant, Stay Safe</h2>
            <p>When in doubt, always reach out to us through our official channels before taking any action.</p>
            <div class="hiw-cta-buttons">
                <a href="/contact" class="hiw-btn-white">Contact Us</a>
                <a href="/jobs" class="hiw-btn-outline">Browse Verified Jobs</a>
            </div>
        </div>
    </div>
</section>
