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
        if (!wrap || !list) return;
        list.innerHTML = '';
        wrap.style.display = 'none';
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
                                var cb = document.createElement('input');
                                cb.type = 'checkbox';
                                cb.name = namePrefix + '[]';
                                cb.value = val;
                                cb.className = 'form-check-input';
                                lbl.appendChild(cb);
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
    });
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
