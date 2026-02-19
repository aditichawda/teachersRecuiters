@if (! $account->id || ! $account->isEmployer())
<script>
document.addEventListener('DOMContentLoaded', function() {
    var applyNow = document.getElementById('applyNow');
    if (!applyNow) return;
    var screeningUrl = '{{ url("ajax/jobs/screening-questions") }}';

    applyNow.addEventListener('show.bs.modal', function(e) {
        var button = e.relatedTarget;
        var jobId = button && button.getAttribute('data-job-id');
        var wrap = document.getElementById('job-screening-questions-wrap');
        var list = document.getElementById('job-screening-questions-list');
        var step1 = document.getElementById('apply-step-1');
        if (step1) step1.style.display = 'block';
        if (list) list.innerHTML = '';
        if (wrap) wrap.style.display = 'none';
        var jobIdInput = applyNow.querySelector('input[name="job_id"]') || applyNow.querySelector('.modal-job-id');
        if (jobIdInput) jobIdInput.value = jobId || '';
        if (!jobId) return;
        fetch(screeningUrl + '/' + jobId, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                var questions = data.questions || [];
                if (questions.length === 0) return;
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
                if (!r.ok) return r.json().then(function(d) { throw new Error(d && d.message ? d.message : 'Request failed'); });
                return r.json();
            })
            .then(function(data) {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    if (submitBtn.tagName === 'BUTTON') submitBtn.innerHTML = originalLabel;
                }
                if (data && data.error === false) {
                    var modalEl = document.getElementById('applyNow');
                    if (modalEl) {
                        try {
                            var bsModal = (typeof bootstrap !== 'undefined' && bootstrap.Modal)
                                ? (bootstrap.Modal.getInstance(modalEl) || bootstrap.Modal.getOrCreateInstance(modalEl))
                                : null;
                            if (bsModal) bsModal.hide();
                            else {
                                modalEl.classList.remove('show');
                                modalEl.style.display = 'none';
                                modalEl.setAttribute('aria-hidden', 'true');
                                document.body.classList.remove('modal-open');
                                var backdrop = document.querySelector('.modal-backdrop');
                                if (backdrop) backdrop.remove();
                                document.body.style.removeProperty('overflow');
                                document.body.style.removeProperty('padding-right');
                            }
                        } catch (err) {
                            modalEl.classList.remove('show');
                            modalEl.style.display = 'none';
                            document.body.classList.remove('modal-open');
                            var back = document.querySelector('.modal-backdrop');
                            if (back) back.remove();
                        }
                    }
                    if (typeof Botble !== 'undefined') Botble.showSuccess(data.message || '{{ __("Application submitted successfully.") }}');
                    var applyBtn = document.querySelector('a[data-job-id="' + jobId + '"]');
                    if (applyBtn && !applyBtn.classList.contains('disabled')) {
                        applyBtn.classList.add('disabled');
                        applyBtn.removeAttribute('data-bs-toggle');
                        applyBtn.removeAttribute('href');
                        applyBtn.setAttribute('href', '#');
                        var span = applyBtn.querySelector('span');
                        if (span) span.textContent = '{{ __("Applied") }}'; else applyBtn.textContent = '{{ __("Applied") }}';
                    }
                } else {
                    if (typeof Botble !== 'undefined') Botble.showError((data && data.message) ? data.message : '{{ __("Application failed. Please try again.") }}');
                }
            })
            .catch(function() {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    if (submitBtn.tagName === 'BUTTON') submitBtn.innerHTML = originalLabel;
                }
                if (typeof Botble !== 'undefined') Botble.showError('{{ __("Application failed. Please try again.") }}');
            });
        });
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

    <div class="modal fade" id="applyNow" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body p-3">
                    <style>.apl-job-inpopup .form-label{font-size:0.9rem;margin-bottom:0.25rem}.apl-job-inpopup .form-control,.apl-job-inpopup .form-select{font-size:0.9rem;padding:0.35rem 0.5rem}.apl-job-inpopup .mb-3{margin-bottom:0.6rem!important}.apl-job-inpopup textarea.form-control{min-height:60px}</style>
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
