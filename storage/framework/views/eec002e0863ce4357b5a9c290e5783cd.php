<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('plugins/payment::partials.form', [
        'action' => route('payments.checkout'),
        'currency' => $package->currency->title
            ? strtoupper($package->currency->title)
            : cms_currency()->getDefaultCurrency()->title,
        'amount' => $package->price,
        'name' => $package->name,
        'returnUrl' => url('account/packages/' . $package->id . '/subscribe'),
        'callbackUrl' => route('public.account.package.subscribe.callback', $package->id),
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if(isset($walletUrl)): ?>
        <?php
            $walletUrlAbsolute = $walletUrl ? (str_starts_with($walletUrl, 'http') ? $walletUrl : url()->to($walletUrl)) : '';
            $processingText = trans('plugins/payment::payment.processing_please_wait');
        ?>
        <script>
            (function() {
                var walletUrl = <?php echo json_encode($walletUrlAbsolute, 15, 512) ?>;
                var processingText = <?php echo json_encode($processingText, 15, 512) ?>;
                var LOG = function(msg, data) {
                    try { console.log('[JobBoard Checkout] ' + msg, data !== undefined ? data : ''); } catch (e) {}
                };
                var LOG_ERR = function(msg, err) {
                    try { console.error('[JobBoard Checkout] ' + msg, err !== undefined ? err : ''); } catch (e) {}
                };
                var LOG_BG = function(msg, data) {
                    try { console.log('[JobBoard Checkout] BACKGROUND: ' + msg, data !== undefined ? data : ''); } catch (e) {}
                };

                LOG('Script loaded. walletUrl=', walletUrl);
                LOG_BG('No process running.');
                if (!walletUrl) {
                    LOG_ERR('walletUrl empty, redirect will not work');
                    return;
                }

                function isCodSelected(form) {
                    try {
                        var radio = form && form.querySelector('input[name="payment_method"]:checked');
                        return radio && (radio.value || '').toLowerCase() === 'cod';
                    } catch (e) {
                        LOG_ERR('isCodSelected error', e);
                        return false;
                    }
                }

                function getPaymentMethod(form) {
                    try {
                        var radio = form && form.querySelector('input[name="payment_method"]:checked');
                        return radio ? (radio.value || '').toLowerCase() : '';
                    } catch (e) { return ''; }
                }

                var redirectDone = false;
                function goToWallet(url, btn) {
                    if (redirectDone) { LOG('goToWallet: already redirecting, skip'); return; }
                    var u = (url || walletUrl || '').trim();
                    if (!u) u = walletUrl;
                    if (u.indexOf('http') !== 0 && u.indexOf('/') === 0) u = window.location.origin + u;
                    redirectDone = true;
                    try { if (btn && typeof btn.innerHTML !== 'undefined') btn.innerHTML = 'Redirecting to Wallet...'; } catch (e) {}
                    try { LOG('goToWallet: redirecting to', u); } catch (e) {}
                    setTimeout(function() {
                        try {
                            window.location.replace(u);
                        } catch (e2) {
                            try { window.location.href = u; } catch (e3) {}
                        }
                    }, 0);
                }

                function doCodCheckout(form, btn) {
                    LOG_BG('Process started: COD checkout (background XHR).');
                    LOG('doCodCheckout started (COD)', { formAction: form && form.action });
                    try {
                        if (btn) {
                            btn.disabled = true;
                            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span> ' + processingText;
                        }
                        var xhr = new XMLHttpRequest();
                        var timeoutMs = 30000;
                        var timeout = setTimeout(function() {
                            if (xhr.readyState !== 4) {
                                LOG_BG('Process: XHR timeout – no response in ' + (timeoutMs/1000) + 's, redirecting to wallet.');
                                LOG('XHR timeout, redirecting to wallet');
                                xhr.abort();
                                goToWallet(walletUrl, btn);
                            }
                        }, timeoutMs);

                        xhr.onreadystatechange = function() {
                            if (xhr.readyState !== 4) return;
                            clearTimeout(timeout);
                            LOG_BG('Process: Server response received (status ' + xhr.status + '). Redirecting to wallet.');
                            LOG('XHR readyState 4', { status: xhr.status, responseLength: (xhr.responseText || '').length });
                            var targetUrl = walletUrl;
                            if (xhr.status >= 200 && xhr.status < 300) {
                                try {
                                    var res = JSON.parse(xhr.responseText || '{}');
                                    var nextUrl = res.next_url || (res.checkoutUrl) || (res.additional && res.additional.next_url);
                                    if (nextUrl) { targetUrl = nextUrl; LOG('Using next_url from response', targetUrl); }
                                    else { LOG('No next_url in response, using walletUrl'); }
                                } catch (err) {
                                    LOG_ERR('JSON parse failed', err);
                                }
                            } else {
                                LOG('Server returned non-2xx, redirecting to wallet.');
                            }
                            goToWallet(targetUrl, btn);
                        };
                        xhr.onerror = function() {
                            clearTimeout(timeout);
                            LOG_BG('Process: XHR error (network failed). Redirecting to wallet.');
                            LOG_ERR('XHR onerror, redirecting to wallet');
                            goToWallet(walletUrl, btn);
                        };
                        xhr.ontimeout = function() {
                            clearTimeout(timeout);
                            LOG_BG('Process: XHR ontimeout. Redirecting to wallet.');
                            goToWallet(walletUrl, btn);
                        };
                        xhr.open('POST', form.action);
                        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.setRequestHeader('Accept', 'application/json');
                        xhr.timeout = timeoutMs;
                        var fd = new FormData(form);
                        xhr.send(new URLSearchParams(fd).toString());
                        LOG_BG('Process: XHR POST sent. Response aaye ya na aaye, timeout/error par wallet pe redirect hoga.');
                        LOG('XHR POST sent to', form.action);
                    } catch (e) {
                        LOG_ERR('doCodCheckout error', e);
                        goToWallet(walletUrl, btn);
                    }
                }

                var form = document.querySelector('form.payment-checkout-form');
                if (!form) {
                    LOG_ERR('Form .payment-checkout-form not found');
                    return;
                }
                LOG('Form found, attaching listeners');

                form.addEventListener('submit', function(e) {
                    try {
                        var method = getPaymentMethod(form);
                        LOG('Form submit', { method: method, isCod: isCodSelected(form) });
                        if (!isCodSelected(form)) return;
                        e.preventDefault();
                        e.stopPropagation();
                        doCodCheckout(form, form.querySelector('.payment-checkout-btn'));
                        return false;
                    } catch (err) {
                        LOG_ERR('Submit handler error', err);
                        e.preventDefault();
                        goToWallet(walletUrl, form.querySelector('.payment-checkout-btn'));
                        return false;
                    }
                }, true);

                document.addEventListener('click', function(e) {
                    try {
                        var btn = e.target && e.target.closest && e.target.closest('.payment-checkout-btn');
                        if (!btn || btn.closest('form') !== form) return;
                        var method = getPaymentMethod(form);
                        LOG('Checkout button click', { method: method, isCod: isCodSelected(form) });
                        if (!isCodSelected(form)) return;
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        doCodCheckout(form, btn);
                    } catch (err) {
                        LOG_ERR('Click handler error', err);
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        goToWallet(walletUrl, e.target && e.target.closest && e.target.closest('.payment-checkout-btn'));
                    }
                }, true);

                LOG('Listeners attached. COD=AJAX+redirect, others=form submit.');
            })();
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(JobBoardHelper::viewPath('dashboard.layouts.master'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/themes/dashboard/checkout.blade.php ENDPATH**/ ?>