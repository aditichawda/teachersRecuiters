@if (auth('account')->check() && $account && ! $account->isEmployer())
<style>
/* Hide success alerts to prevent navbar overlap and page shift */
.dialog-alert-overlay {
    display: none !important;
}
.dialog-alert-box {
    display: none !important;
}

/* Prevent page shift when button changes to "Applied" */
.jd-apply-btn {
    transition: all 0.2s ease;
    min-width: fit-content;
    display: inline-block;
}
.jd-apply-btn.disabled {
    min-width: 120px; /* Fixed width to prevent shift */
    text-align: center;
    white-space: nowrap;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var applyNow = document.getElementById('applyNow');
    if (!applyNow) return;
    var screeningUrl = '{{ url("ajax/jobs/screening-questions") }}';

    // Store reference to the button that opened the modal
    var modalTriggerButton = null;
    
    applyNow.addEventListener('show.bs.modal', function(e) {
        // Fix z-index for modal and backdrop
        applyNow.style.zIndex = '10050';
        
        // Fix backdrop z-index
        setTimeout(function() {
            var backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.style.zIndex = '10040';
            }
        }, 10);
        
        var button = e.relatedTarget;
        // Store the button reference globally so we can update it after form submission
        modalTriggerButton = button;
        console.log('Modal opened, stored button:', modalTriggerButton, 'jobId:', button ? button.getAttribute('data-job-id') : 'none');
        
        var jobId = button && button.getAttribute('data-job-id');
        var wrap = document.getElementById('job-screening-questions-wrap');
        var list = document.getElementById('job-screening-questions-list');
        var step1 = document.getElementById('apply-step-1');
        if (step1) step1.style.display = 'block';
        if (list) list.innerHTML = '';
        
        var jobIdInput = applyNow.querySelector('input[name="job_id"]') || applyNow.querySelector('.modal-job-id');
        if (jobIdInput) jobIdInput.value = jobId || '';
        if (!jobId) {
            if (wrap) {
                wrap.style.display = 'none';
                wrap.classList.remove('loading');
            }
            return;
        }
        
        // Show loader immediately - ensure element is visible first
        if (wrap) {
            // Remove loading class first
            wrap.classList.remove('loading');
            // Make element visible
            wrap.style.display = 'block';
            wrap.style.visibility = 'visible';
            wrap.style.opacity = '1';
            wrap.style.position = 'relative';
            wrap.style.minHeight = '200px';
            // Force reflow to ensure display change is applied
            void wrap.offsetHeight;
            // Add loading class after a tiny delay to ensure styles are applied
            setTimeout(function() {
                if (wrap) {
                    wrap.classList.add('loading');
                }
            }, 10);
        }
        
        fetch(screeningUrl + '/' + jobId, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                // Hide loader
                if (wrap) {
                    wrap.classList.remove('loading');
                    // Reset inline styles
                    wrap.style.minHeight = '';
                }
                
                var questions = data.questions || [];
                if (questions.length === 0) {
                    if (wrap) wrap.style.display = 'none';
                    return;
                }
                questions.forEach(function(q) {
                    var div = document.createElement('div');
                    div.className = 'mb-2';
                    var label = document.createElement('label');
                    label.className = 'form-label small';
                    label.textContent = q.question + (q.is_required ? ' *' : '');
                    div.appendChild(label);
                    var opts = q.options || [];
                    var namePrefix = 'screening_answers[' + q.id + ']';

                    if (q.question_type === 'textarea') {
                        var textarea = document.createElement('textarea');
                        textarea.rows = 2;
                        textarea.className = 'form-control form-control-sm';
                        textarea.name = namePrefix;
                        textarea.required = !!q.is_required;
                        div.appendChild(textarea);
                    } else if (q.question_type === 'dropdown') {
                        var select = document.createElement('select');
                        select.className = 'form-select form-select-sm';
                        select.name = namePrefix;
                        select.required = !!q.is_required;
                        var opt0 = document.createElement('option');
                        opt0.value = '';
                        opt0.textContent = '-- Select --';
                        select.appendChild(opt0);
                        opts.forEach(function(o) {
                            var opt = document.createElement('option');
                            opt.value = typeof o === 'string' ? o : (o.value || o.label || o);
                            opt.textContent = typeof o === 'string' ? o : (o.label || o.value || o);
                            select.appendChild(opt);
                        });
                        div.appendChild(select);
                    } else if (q.question_type === 'checkbox') {
                        if (opts.length > 0) {
                            opts.forEach(function(o, idx) {
                                var val = typeof o === 'string' ? o : (o.value || o.label || o);
                                var lbl = document.createElement('label');
                                lbl.className = 'd-flex align-items-center gap-2 small mb-1';
                                var rb = document.createElement('input');
                                rb.type = 'radio';
                                rb.name = namePrefix;
                                rb.value = val;
                                rb.className = 'form-check-input';
                                lbl.appendChild(rb);
                                lbl.appendChild(document.createTextNode(typeof o === 'string' ? o : (o.label || o.value || o)));
                                div.appendChild(lbl);
                            });
                        } else {
                            var singleCb = document.createElement('label');
                            singleCb.className = 'd-flex align-items-center gap-2 small';
                            var singleInput = document.createElement('input');
                            singleInput.type = 'checkbox';
                            singleInput.name = namePrefix;
                            singleInput.value = '1';
                            singleInput.className = 'form-check-input';
                            singleCb.appendChild(singleInput);
                            singleCb.appendChild(document.createTextNode('Yes'));
                            div.appendChild(singleCb);
                        }
                    } else if (q.question_type === 'file') {
                        var fileInput = document.createElement('input');
                        fileInput.type = 'file';
                        fileInput.name = 'screening_answers_file[' + q.id + ']';
                        fileInput.className = 'form-control form-control-sm';
                        fileInput.required = !!q.is_required;
                        if (q.file_types) fileInput.accept = q.file_types;
                        div.appendChild(fileInput);
                    } else {
                        var input = document.createElement('input');
                        input.type = (q.question_type === 'link' ? 'url' : 'text');
                        input.className = 'form-control form-control-sm';
                        input.name = namePrefix;
                        input.required = !!q.is_required;
                        if (q.question_type === 'link') input.placeholder = 'https://';
                        div.appendChild(input);
                    }
                    list.appendChild(div);
                });
                wrap.style.display = 'block';
            })
            .catch(function(error) {
                // Hide loader on error
                if (wrap) {
                    wrap.classList.remove('loading');
                    wrap.style.display = 'none';
                    wrap.style.minHeight = '';
                }
                console.error('Error loading screening questions:', error);
            });
    });

    applyNow.addEventListener('hide.bs.modal', function() {
        var list = document.getElementById('job-screening-questions-list');
        if (list) list.innerHTML = '';
        var wrap = document.getElementById('job-screening-questions-wrap');
        if (wrap) wrap.style.display = 'none';
        var step1 = document.getElementById('apply-step-1');
        if (step1) step1.style.display = 'block';
        var errEl = document.getElementById('apply-screening-error');
        if (errEl) errEl.remove();
    });

    // Submit apply form via AJAX: on success close modal and update button to "Applied"
    var applyForm = applyNow.querySelector('form.job-apply-form');
    if (applyForm) {
        applyForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var form = e.target;
            var submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
            var jobIdInput = form.querySelector('input[name="job_id"]') || form.querySelector('.modal-job-id');
            var jobId = jobIdInput ? jobIdInput.value : '';
            var originalLabel = submitBtn ? submitBtn.innerHTML : '';
            
            // Also try to get jobId from the stored button reference or find it
            if (!jobId && modalTriggerButton) {
                jobId = modalTriggerButton.getAttribute('data-job-id');
            }
            if (!jobId) {
                var modalTrigger = document.querySelector('a[data-bs-toggle="modal"][href="#applyNow"][data-job-id]');
                if (modalTrigger) {
                    jobId = modalTrigger.getAttribute('data-job-id');
                }
            }
            
            console.log('[JOB_APPLY] ========== Application Form Submit Started ==========');
            console.log('[JOB_APPLY] Job ID:', jobId);
            console.log('[JOB_APPLY] Form URL:', form.action || '{{ route("public.job.apply") }}');
            console.log('[JOB_APPLY] Stored button reference:', modalTriggerButton);

            if (submitBtn) {
                submitBtn.disabled = true;
                if (submitBtn.tagName === 'BUTTON') submitBtn.innerHTML = '{{ __("Sending...") }}';
                console.log('[JOB_APPLY] Submit button disabled and label changed to "Sending..."');
            }

            var formData = new FormData(form);
            var applyUrl = form.action || '{{ route("public.job.apply") }}';
            
            // Log form data (excluding sensitive info)
            var formDataEntries = [];
            for (var pair of formData.entries()) {
                var key = pair[0];
                var value = pair[1];
                // Don't log file contents, just file names
                if (value instanceof File) {
                    formDataEntries.push([key, 'File: ' + value.name + ' (' + value.size + ' bytes)']);
                } else {
                    formDataEntries.push([key, value]);
                }
            }
            console.log('[JOB_APPLY] Form data:', formDataEntries);
            
            console.log('[JOB_APPLY] Sending POST request to:', applyUrl);
            var requestStartTime = Date.now();

            fetch(applyUrl, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
            .then(function(r) {
                var requestTime = Date.now() - requestStartTime;
                console.log('[JOB_APPLY] Response received in', requestTime + 'ms');
                console.log('[JOB_APPLY] Response status:', r.status, r.statusText);
                console.log('[JOB_APPLY] Response headers:', Object.fromEntries(r.headers.entries()));
                
                if (!r.ok) {
                    return r.json().then(function(d) { 
                        console.error('[JOB_APPLY] ❌ Response error:', d);
                        console.error('[JOB_APPLY] Error details:', {
                            status: r.status,
                            statusText: r.statusText,
                            error: d.error,
                            message: d.message,
                            data: d.data
                        });
                        throw new Error(d && d.message ? d.message : 'Request failed'); 
                    });
                }
                return r.json();
            })
            .then(function(data) {
                console.log('[JOB_APPLY] ========== Response Data Received ==========');
                console.log('[JOB_APPLY] Full response:', data);
                console.log('[JOB_APPLY] Response structure:', {
                    'data.error': data ? data.error : 'data is null',
                    'data.success': data ? data.success : 'N/A',
                    'data.message': data ? data.message : 'N/A',
                    'data.data': data ? data.data : 'N/A',
                    'data type': typeof data,
                    'data keys': data ? Object.keys(data) : 'no keys'
                });
                
                // Check multiple possible success formats
                var isSuccess = false;
                if (data) {
                    // Format 1: { error: false, ... }
                    if (data.error === false) {
                        isSuccess = true;
                    }
                    // Format 2: { success: true, ... }
                    else if (data.success === true) {
                        isSuccess = true;
                    }
                    // Format 3: No error field and has message/data
                    else if (data.error === undefined && (data.message || data.data)) {
                        isSuccess = true;
                    }
                    // Format 4: Status code 200 and no error
                    else if (!data.error && data.message) {
                        isSuccess = true;
                    }
                }
                
                console.log('[JOB_APPLY] Success check result:', isSuccess);
                
                if (isSuccess) {
                    console.log('[JOB_APPLY] ✅ ========== APPLICATION SUCCESSFUL ==========');
                    console.log('[JOB_APPLY] ✅ Job ID:', jobId);
                    console.log('[JOB_APPLY] ✅ Success message:', data.message || 'Application submitted successfully');
                    console.log('[JOB_APPLY] ✅ Stored button reference:', modalTriggerButton);
                    console.log('[JOB_APPLY] ✅ Response data:', data);
                    
                    // Function to update button - simplified and more reliable
                    function updateApplyButton(btn) {
                        if (!btn) {
                            console.log('Button is null');
                            return false;
                        }
                        
                        if (btn.classList && btn.classList.contains('disabled')) {
                            console.log('Button already disabled');
                            return true;
                        }
                        
                        console.log('Updating button:', btn, 'Tag:', btn.tagName);
                        
                        try {
                            // Add disabled class
                            if (btn.classList) {
                                btn.classList.add('disabled');
                            }
                            
                            // Remove modal trigger attributes
                            btn.removeAttribute('data-bs-toggle');
                            btn.removeAttribute('href');
                            if (btn.style) {
                                btn.style.pointerEvents = 'none';
                                btn.style.cursor = 'not-allowed';
                                btn.style.opacity = '0.7';
                            }
                            
                            // Update text - completely replace content
                            var appliedText = '{{ __("Applied") }}';
                            
                            // Preserve button dimensions to prevent page shift
                            var originalWidth = btn.offsetWidth;
                            var originalHeight = btn.offsetHeight;
                            
                            btn.textContent = appliedText;
                            btn.innerHTML = appliedText;
                            
                            // Set fixed dimensions to prevent layout shift
                            if (btn.style) {
                                btn.style.minWidth = originalWidth + 'px';
                                btn.style.width = 'auto';
                                btn.style.height = originalHeight + 'px';
                            }
                            
                            // Make link non-clickable
                            if (btn.tagName === 'A') {
                                btn.href = '#';
                                btn.onclick = function(e) {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    return false;
                                };
                            }
                            
                            console.log('Button updated successfully. New text:', btn.textContent);
                            return true;
                        } catch (err) {
                            console.error('Error updating button:', err);
                            return false;
                        }
                    }
                    
                    // Update button IMMEDIATELY - try multiple methods synchronously
                    var buttonUpdated = false;
                    
                    // Method 1: Use stored button reference (most reliable)
                    if (modalTriggerButton) {
                        console.log('Trying stored button reference...', modalTriggerButton);
                        buttonUpdated = updateApplyButton(modalTriggerButton);
                        if (buttonUpdated) {
                            console.log('✅ Button updated via stored reference!');
                        }
                    }
                    
                    // Method 2: Find by data-job-id (try all possible selectors)
                    if (!buttonUpdated && jobId) {
                        console.log('Trying to find button by data-job-id:', jobId);
                        var selectors = [
                            '.jd-apply-btn[data-job-id="' + jobId + '"]',
                            'a[data-job-id="' + jobId + '"]',
                            '.site-button[data-job-id="' + jobId + '"]',
                            'a.jd-apply-btn[data-job-id="' + jobId + '"]',
                            'a[data-bs-toggle="modal"][data-job-id="' + jobId + '"]'
                        ];
                        
                        for (var i = 0; i < selectors.length; i++) {
                            var btn = document.querySelector(selectors[i]);
                            if (btn && !btn.classList.contains('disabled')) {
                                console.log('Found button with selector:', selectors[i], btn);
                                buttonUpdated = updateApplyButton(btn);
                                if (buttonUpdated) {
                                    console.log('✅ Button updated via selector!');
                                    break;
                                }
                            }
                        }
                    }
                    
                    // Method 3: Find in hero actions area
                    if (!buttonUpdated) {
                        console.log('Trying hero actions area...');
                        var heroActions = document.querySelector('.jd-hero-actions');
                        if (heroActions) {
                            var heroBtn = heroActions.querySelector('.jd-apply-btn:not(.disabled)');
                            if (heroBtn) {
                                console.log('Found button in hero actions', heroBtn);
                                buttonUpdated = updateApplyButton(heroBtn);
                                if (buttonUpdated) {
                                    console.log('✅ Button updated via hero actions!');
                                }
                            }
                        }
                    }
                    
                    // Method 4: Find any apply button on the page
                    if (!buttonUpdated) {
                        console.log('Trying any apply button on page...');
                        var allButtons = document.querySelectorAll('.jd-apply-btn:not(.disabled)');
                        console.log('Found', allButtons.length, 'potential buttons');
                        for (var j = 0; j < allButtons.length; j++) {
                            var btn = allButtons[j];
                            var btnJobId = btn.getAttribute('data-job-id');
                            // If jobId matches or button is in hero actions, update it
                            if (!btnJobId || btnJobId === jobId || btn.closest('.jd-hero-actions')) {
                                console.log('Updating button:', btn);
                                buttonUpdated = updateApplyButton(btn);
                                if (buttonUpdated) {
                                    console.log('✅ Button updated via fallback!');
                                    break;
                                }
                            }
                        }
                    }
                    
                    if (!buttonUpdated) {
                        console.error('❌ Could not update button! jobId:', jobId, 'modalTriggerButton:', modalTriggerButton);
                    }
                    
                    // Update submit button
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        if (submitBtn.tagName === 'BUTTON') {
                            submitBtn.innerHTML = '{{ __("Sent!") }}';
                        }
                    }
                    
                    // Don't show success alert - button change is enough feedback
                    // if (typeof Botble !== 'undefined') {
                    //     Botble.showSuccess(data.message || '{{ __("Application submitted successfully.") }}');
                    // }
                    
                    // Close modal - aggressive approach
                    var modalEl = document.getElementById('applyNow');
                    if (modalEl) {
                        // Function to force close modal
                        function forceCloseModal() {
                            console.log('Closing modal...');
                            
                            // Try Bootstrap 5
                            if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                                try {
                                    var bsModal = bootstrap.Modal.getInstance(modalEl);
                                    if (bsModal) {
                                        bsModal.hide();
                                        console.log('Closed via Bootstrap 5');
                                    } else {
                                        var newModal = new bootstrap.Modal(modalEl);
                                        newModal.hide();
                                        console.log('Closed via new Bootstrap 5 instance');
                                    }
                                } catch (err) {
                                    console.log('Bootstrap 5 error:', err);
                                }
                            }
                            
                            // Try jQuery
                            if (typeof $ !== 'undefined' && $.fn.modal) {
                                try {
                                    $(modalEl).modal('hide');
                                    console.log('Closed via jQuery');
                                } catch (err) {
                                    console.log('jQuery error:', err);
                                }
                            }
                            
                            // Force DOM manipulation (always execute)
                            try {
                                modalEl.classList.remove('show');
                                modalEl.style.display = 'none';
                                modalEl.setAttribute('aria-hidden', 'true');
                                modalEl.removeAttribute('aria-modal');
                                document.body.classList.remove('modal-open');
                                
                                // Remove all backdrops
                                var backdrops = document.querySelectorAll('.modal-backdrop');
                                backdrops.forEach(function(backdrop) {
                                    backdrop.remove();
                                });
                                
                                document.body.style.removeProperty('overflow');
                                document.body.style.removeProperty('padding-right');
                                console.log('Closed via DOM manipulation');
                            } catch (err) {
                                console.log('DOM manipulation error:', err);
                            }
                        }
                        
                        // Close after short delay to show success message
                        setTimeout(forceCloseModal, 800);
                        
                        // Force close again after 1.5 seconds if still open
                        setTimeout(function() {
                            if (modalEl && (modalEl.classList.contains('show') || modalEl.style.display !== 'none')) {
                                console.log('Modal still open, forcing close again...');
                                forceCloseModal();
                            }
                        }, 1500);
                    }
                    
                    // Reset submit button after modal closes
                    setTimeout(function() {
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            if (submitBtn.tagName === 'BUTTON') submitBtn.innerHTML = originalLabel;
                        }
                    }, 500);
                } else {
                    // Reset button on error
                    console.error('[JOB_APPLY] ❌ ========== APPLICATION FAILED ==========');
                    console.error('[JOB_APPLY] ❌ Full error response:', data);
                    console.error('[JOB_APPLY] ❌ Error details:', {
                        error: data ? data.error : 'unknown',
                        message: data ? data.message : 'No message',
                        data: data ? data.data : null,
                        errors: data ? data.errors : null
                    });
                    
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        if (submitBtn.tagName === 'BUTTON') submitBtn.innerHTML = originalLabel;
                        console.log('[JOB_APPLY] Submit button re-enabled');
                    }
                    
                    var errorMsg = (data && data.message) ? data.message : '{{ __("Application failed. Please try again.") }}';
                    console.error('[JOB_APPLY] Error message to display:', errorMsg);
                    
                    if (typeof Botble !== 'undefined') {
                        Botble.showError(errorMsg);
                        console.log('[JOB_APPLY] Error displayed to user via Botble.showError');
                    } else {
                        console.warn('[JOB_APPLY] Botble is not defined, cannot show error message');
                    }
                }
            })
            .catch(function(error) {
                console.error('[JOB_APPLY] ❌ ========== FETCH ERROR ==========');
                console.error('[JOB_APPLY] ❌ Error type:', error.name);
                console.error('[JOB_APPLY] ❌ Error message:', error.message);
                console.error('[JOB_APPLY] ❌ Error stack:', error.stack);
                console.error('[JOB_APPLY] ❌ Full error object:', error);
                if (submitBtn) {
                    submitBtn.disabled = false;
                    if (submitBtn.tagName === 'BUTTON') submitBtn.innerHTML = originalLabel;
                }
                var errorMsg = error && error.message ? error.message : '{{ __("Application failed. Please try again.") }}';
                console.error('Showing error to user:', errorMsg);
                if (typeof Botble !== 'undefined') Botble.showError(errorMsg);
            });
        });
    }
    
    // Handle external job application form (same functionality)
    var applyExternalJob = document.getElementById('applyExternalJob');
    if (applyExternalJob) {
        var externalForm = applyExternalJob.querySelector('form.job-apply-form');
        if (externalForm) {
            // Store button reference for external form
            var externalModalTriggerButton = null;
            
            applyExternalJob.addEventListener('show.bs.modal', function(e) {
                var button = e.relatedTarget;
                externalModalTriggerButton = button;
                console.log('External modal opened, stored button:', externalModalTriggerButton);
            });
            
            externalForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var form = e.target;
                var submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
                var jobIdInput = form.querySelector('input[name="job_id"]') || form.querySelector('.modal-job-id');
                var jobId = jobIdInput ? jobIdInput.value : '';
                var originalLabel = submitBtn ? submitBtn.innerHTML : '';
                
                if (!jobId && externalModalTriggerButton) {
                    jobId = externalModalTriggerButton.getAttribute('data-job-id');
                }
                
                console.log('External form submitted, jobId:', jobId);
                
                if (submitBtn) {
                    submitBtn.disabled = true;
                    if (submitBtn.tagName === 'BUTTON') submitBtn.innerHTML = '{{ __("Sending...") }}';
                }
                
                var formData = new FormData(form);
                var applyUrl = form.action || '{{ route("public.job.apply") }}';
                
                fetch(applyUrl, {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                })
                .then(function(r) {
                    console.log('External response status:', r.status);
                    if (!r.ok) {
                        return r.json().then(function(d) { 
                            console.error('External response error:', d);
                            throw new Error(d && d.message ? d.message : 'Request failed'); 
                        });
                    }
                    return r.json();
                })
                .then(function(data) {
                    console.log('External response data:', data);
                    
                    // Check success (same logic as internal form)
                    var isSuccess = false;
                    if (data) {
                        if (data.error === false || data.success === true || 
                            (data.error === undefined && (data.message || data.data))) {
                            isSuccess = true;
                        }
                    }
                    
                    if (isSuccess) {
                        console.log('✅ External application successful');
                        
                        // Update button (same function as internal)
                        function updateApplyButton(btn) {
                            if (!btn || (btn.classList && btn.classList.contains('disabled'))) {
                                return btn && btn.classList && btn.classList.contains('disabled');
                            }
                            
                            try {
                                if (btn.classList) btn.classList.add('disabled');
                                btn.removeAttribute('data-bs-toggle');
                                btn.removeAttribute('href');
                                if (btn.style) {
                                    btn.style.pointerEvents = 'none';
                                    btn.style.cursor = 'not-allowed';
                                    btn.style.opacity = '0.7';
                                }
                                
                                var appliedText = '{{ __("Applied") }}';
                                btn.textContent = appliedText;
                                btn.innerHTML = appliedText;
                                
                                if (btn.tagName === 'A') {
                                    btn.href = '#';
                                    btn.onclick = function(e) {
                                        e.preventDefault();
                                        e.stopPropagation();
                                        return false;
                                    };
                                }
                                
                                return true;
                            } catch (err) {
                                console.error('Error updating button:', err);
                                return false;
                            }
                        }
                        
                        // Update button
                        if (externalModalTriggerButton) {
                            updateApplyButton(externalModalTriggerButton);
                        }
                        if (jobId) {
                            var btn = document.querySelector('.jd-apply-btn[data-job-id="' + jobId + '"]');
                            if (btn) updateApplyButton(btn);
                        }
                        
                        // Don't show success alert - button change is enough feedback
                        // if (typeof Botble !== 'undefined') {
                        //     Botble.showSuccess(data.message || '{{ __("Application submitted successfully.") }}');
                        // }
                        
                        // Close external modal
                        setTimeout(function() {
                            if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                                var bsModal = bootstrap.Modal.getInstance(applyExternalJob);
                                if (bsModal) bsModal.hide();
                            }
                            if (typeof $ !== 'undefined' && $.fn.modal) {
                                $(applyExternalJob).modal('hide');
                            }
                            applyExternalJob.classList.remove('show');
                            applyExternalJob.style.display = 'none';
                            document.body.classList.remove('modal-open');
                            var backdrops = document.querySelectorAll('.modal-backdrop');
                            backdrops.forEach(function(b) { b.remove(); });
                        }, 800);
                    } else {
                        console.error('❌ External application failed:', data);
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            if (submitBtn.tagName === 'BUTTON') submitBtn.innerHTML = originalLabel;
                        }
                        if (typeof Botble !== 'undefined') {
                            Botble.showError((data && data.message) ? data.message : '{{ __("Application failed. Please try again.") }}');
                        }
                    }
                })
                .catch(function(error) {
                    console.error('❌ External fetch error:', error);
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        if (submitBtn.tagName === 'BUTTON') submitBtn.innerHTML = originalLabel;
                    }
                    if (typeof Botble !== 'undefined') {
                        Botble.showError(error && error.message ? error.message : '{{ __("Application failed. Please try again.") }}');
                    }
                });
            });
        }
    }
});
</script>
    <div class="modal fade" id="applyExternalJob" tabindex="-1" aria-labelledby="applyExternalJob" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5">
                    @if ($externalJobApplicationForm)
                        {!! $externalJobApplicationForm->renderForm() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Apply Modal Z-Index Fix - Above Header */
    #applyNow {
        z-index: 10050 !important;
    }
    #applyNow .modal-backdrop {
        z-index: 10040 !important;
        background-color: rgba(0, 0, 0, 0.5) !important;
    }
    /* .modal-backdrop.show {
        z-index: 10040 !important;
    } */
    #applyNow .modal-dialog {
        z-index: 10050 !important;
        margin: 1.75rem auto;
    }
    #applyNow .modal-content {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }
    #applyNow .modal-header {
        background: #fff;
        color: #333;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #e9ecef;
        border-radius: 12px 12px 0 0;
    }
    #applyNow .modal-header .modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
        color: #333;
    }
    #applyNow .modal-header .btn-close {
        opacity: 0.5;
    }
    #applyNow .modal-header .btn-close:hover {
        opacity: 1;
    }
    #applyNow .modal-body {
        padding: 1.5rem;
        max-height: calc(100vh - 200px);
        overflow-y: auto;
    }
    /* Form Styling */
    .apl-job-inpopup .form-label {
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
        font-weight: 500;
        color: #333;
    }
    .apl-job-inpopup .form-control,
    .apl-job-inpopup .form-select {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }
    .apl-job-inpopup .form-control:focus,
    .apl-job-inpopup .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .apl-job-inpopup .mb-3 {
        margin-bottom: 0.6rem !important;
    }
    .apl-job-inpopup textarea.form-control {
        min-height: 60px;
        resize: vertical;
    }
    /* Submit Button Styling - Reverted to original */
    #applyNow .job-apply-form button[type="submit"] {
        margin-top: 1rem;
    }
    /* Custom Scrollbar */
    #applyNow .modal-body::-webkit-scrollbar {
        width: 6px;
    }
    #applyNow .modal-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    #applyNow .modal-body::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    #applyNow .modal-body::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    /* Screening Questions Loader - Blue Spinner */
    #job-screening-questions-wrap.loading {
        position: relative !important;
        min-height: 200px !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        overflow: visible !important;
    }
    #job-screening-questions-wrap.loading::before {
        content: '' !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100% !important;
        height: 100% !important;
        min-height: 200px !important;
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(3px) !important;
        -webkit-backdrop-filter: blur(3px) !important;
        z-index: 10 !important;
        border-radius: 8px !important;
        display: block !important;
    }
    #job-screening-questions-wrap.loading::after {
        content: '' !important;
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
        -webkit-transform: translate(-50%, -50%) !important;
        width: 50px !important;
        height: 50px !important;
        border: 4px solid rgba(59, 130, 246, 0.2) !important;
        border-top-color: #3b82f6 !important;
        border-right-color: #3b82f6 !important;
        border-radius: 50% !important;
        animation: blue-spin 0.8s linear infinite !important;
        -webkit-animation: blue-spin 0.8s linear infinite !important;
        z-index: 11 !important;
        display: block !important;
    }
    @keyframes blue-spin {
        0% {
            transform: translate(-50%, -50%) rotate(0deg);
        }
        100% {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }
    @-webkit-keyframes blue-spin {
        0% {
            -webkit-transform: translate(-50%, -50%) rotate(0deg);
        }
        100% {
            -webkit-transform: translate(-50%, -50%) rotate(360deg);
        }
    }
    </style>
    <div class="modal fade" id="applyNow" aria-hidden="true" tabindex="-1" style="z-index: 10050;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="z-index: 10050;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-briefcase me-2"></i>
                        {{ __('Job Application') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="apl-job-inpopup job-apply-form-compact">
                        @if ($internalJobApplicationForm)
                            {!! $internalJobApplicationForm->renderForm() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
