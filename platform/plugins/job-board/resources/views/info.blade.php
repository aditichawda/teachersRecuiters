@if ($jobApplication)
    <x-core::datagrid>
        <x-core::datagrid.item>
            <x-slot:title>
                {{ trans('plugins/job-board::job-application.tables.time') }}
            </x-slot:title>

            {{ $jobApplication->created_at }}
        </x-core::datagrid.item>

        <x-core::datagrid.item>
            <x-slot:title>
                {{ trans('plugins/job-board::job-application.tables.position') }}
            </x-slot:title>

            <a href="{{ $jobApplication->job->url }}" target="_blank">
                {{ $jobApplication->job->name }}
                <x-core::icon name="ti ti-external-link" />
            </a>
        </x-core::datagrid.item>

        @if (!$jobApplication->is_external_apply)
            <x-core::datagrid.item>
                <x-slot:title>
                    {{ trans('plugins/job-board::job-application.tables.name') }}
                </x-slot:title>

                @if ($jobApplication->account->id && $jobApplication->account->is_public_profile)
                    <a href="{{ $jobApplication->account->url }}" target="_blank">
                        {{ $jobApplication->account->name }}
                        <x-core::icon name="ti ti-external-link" />
                    </a>
                @else
                    {{ $jobApplication->full_name }}
                @endif
            </x-core::datagrid.item>
        @endif

        @if ($jobApplication->phone)
            <x-core::datagrid.item>
                <x-slot:title>
                    {{ trans('plugins/job-board::job-application.tables.phone') }}
                </x-slot:title>

                <a href="tel:{{ $jobApplication->phone }}">{{ $jobApplication->phone }}</a>
            </x-core::datagrid.item>
        @endif

        <x-core::datagrid.item>
            <x-slot:title>
                {{ trans('plugins/job-board::job-application.tables.email') }}
            </x-slot:title>

            <a href="mailto:{{ $jobApplication->email }}">{{ $jobApplication->email }}</a>
        </x-core::datagrid.item>

        @if(!$jobApplication->is_external_apply && (auth()->check() && is_in_admin(true) || auth('account')->check()))
            <x-core::datagrid.item>
                <x-slot:title>{{ trans('plugins/job-board::dashboard.send_email_to_applicant') }}</x-slot:title>
                <div class="mb-2">
                    <label class="form-label small mb-1">{{ trans('plugins/job-board::dashboard.whatsapp_subject_label') }}</label>
                    <input type="text" class="form-control form-control-sm mb-2 applicant-email-subject" placeholder="{{ trans('plugins/job-board::dashboard.email_subject_about_application') }}" value="{{ trans('plugins/job-board::dashboard.email_subject_about_application') }}">
                    <label class="form-label small mb-1">{{ trans('plugins/job-board::dashboard.email_message_placeholder') }}</label>
                    <textarea class="form-control form-control-sm mb-2 applicant-email-body" rows="2" placeholder="{{ trans('plugins/job-board::dashboard.email_message_placeholder') }}"></textarea>
                    <a href="#" class="btn btn-sm btn-outline-primary applicant-send-email" data-application-id="{{ $jobApplication->id }}">
                        <x-core::icon name="ti ti-mail" class="me-1" /> {{ trans('plugins/job-board::dashboard.send_email') }}
                    </a>
                </div>
            </x-core::datagrid.item>
            @if($jobApplication->phone)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/job-board::dashboard.send_whatsapp_to_applicant') }}</x-slot:title>
                    <div class="mb-2">
                        <label class="form-label small mb-1">{{ trans('plugins/job-board::dashboard.whatsapp_subject_label') }}</label>
                        <input type="text" class="form-control form-control-sm mb-2 applicant-wa-subject" placeholder="{{ trans('plugins/job-board::dashboard.email_subject_about_application') }}">
                        <label class="form-label small mb-1">{{ trans('plugins/job-board::dashboard.whatsapp_message_label') }}</label>
                        <textarea class="form-control form-control-sm mb-2 applicant-wa-message" rows="2" placeholder="{{ trans('plugins/job-board::dashboard.whatsapp_message_about_application') }}">{{ trans('plugins/job-board::dashboard.whatsapp_message_about_application') }}</textarea>
                        <a href="#" class="btn btn-sm btn-outline-success applicant-send-whatsapp" data-application-id="{{ $jobApplication->id }}">
                            <x-core::icon name="ti ti-brand-whatsapp" class="me-1" /> {{ trans('plugins/job-board::dashboard.send_whatsapp') }}
                        </a>
                        <small class="d-block text-muted mt-1">{{ trans('plugins/job-board::dashboard.whatsapp_opens_in_app') }}</small>
                        <small class="d-block text-muted mt-1">{{ trans('plugins/job-board::dashboard.whatsapp_system_sent_note') }}</small>
                    </div>
                </x-core::datagrid.item>
            @endif
        @endif

        @if (!$jobApplication->is_external_apply)
            @if ($jobApplication->resume || ($jobApplication->account->id && $jobApplication->account->resume))
                <x-core::datagrid.item>
                    <x-slot:title>
                        {{ trans('plugins/job-board::job-application.tables.resume') }}
                    </x-slot:title>

                    <a
                        href="{{ route(auth()->check() && is_in_admin(true) ? 'job-applications.download-cv' : 'public.account.applicants.download-cv', $jobApplication->id) }}"
                        target="_blank"
                        class="d-flex align-items-center gap-1"
                    >
                        {{ trans('plugins/job-board::job-application.tables.download_resume') }}
                        <x-core::icon name="ti ti-external-link" />
                    </a>
                </x-core::datagrid.item>
            @endif

            @if ($jobApplication->cover_letter)
                    <x-core::datagrid.item>
                        <x-slot:title>
                            {{ trans('plugins/job-board::job-application.tables.cover_letter') }}
                        </x-slot:title>

                        <a href="{{ RvMedia::url($jobApplication->cover_letter) }}" target="_blank" class="d-flex align-items-center gap-1">
                            {{ RvMedia::url($jobApplication->cover_letter) }}
                            <x-core::icon name="ti ti-external-link" />
                        </a>
                    </x-core::datagrid.item>
            @endif
        @endif
    </x-core::datagrid>

    @if ($jobApplication->message)
        <x-core::datagrid.item class="mt-4">
            <x-slot:title>
                {{ trans('plugins/job-board::job-application.tables.message') }}
            </x-slot:title>

            {{ $jobApplication->message }}
        </x-core::datagrid.item>
    @endif

    @php
        $screeningAnswers = $jobApplication->screening_answers ?? [];
        $screeningQuestionsMap = $jobApplication->job->getAllScreeningQuestionsForApply()->keyBy('id');
    @endphp
    @if (!$jobApplication->is_external_apply && $screeningQuestionsMap->isNotEmpty() && count($screeningAnswers) > 0)
        <div class="mt-4 pt-3 border-top">
            <h6 class="mb-3 fw-semibold">{{ trans('plugins/job-board::job-application.screening_questions_answers') }}</h6>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th style="width:40%">{{ trans('plugins/job-board::job-application.screening_question') }}</th>
                            <th style="width:45%">{{ trans('plugins/job-board::job-application.applicant_answer') }}</th>
                            <th class="text-center" style="width:15%">{{ trans('plugins/job-board::job-application.correct_answer') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($screeningAnswers as $qId => $answer)
                            @php
                                $sq = $screeningQuestionsMap->get($qId) ?? $screeningQuestionsMap->get('sq_' . $qId);
                                if (!$sq) continue;
                                if (is_string($answer) && str_starts_with(trim($answer), '[')) {
                                    $decoded = json_decode($answer, true);
                                    $answerDisplay = is_array($decoded) ? implode(', ', array_map('trim', $decoded)) : $answer;
                                } else {
                                    $answerDisplay = $answer !== null && $answer !== '' ? (string) $answer : '—';
                                }
                                $correctAnswer = $sq->correct_answer ?? null;
                                $hasCorrect = (bool) $correctAnswer;
                                $isCorrect = false;
                                if ($hasCorrect && $answer !== null && $answer !== '') {
                                    if (is_string($answer) && str_starts_with(trim($answer), '[')) {
                                        $arr = json_decode($answer, true);
                                        $isCorrect = is_array($arr) && in_array(trim($correctAnswer), array_map('trim', $arr));
                                    } else {
                                        $isCorrect = trim((string) $answer) === trim($correctAnswer);
                                    }
                                }
                            @endphp
                            <tr>
                                <td>{{ $sq->question }}</td>
                                <td>{{ $answerDisplay }}</td>
                                <td class="text-center">
                                    @if ($hasCorrect)
                                        @if ($isCorrect)
                                            <span class="text-success" title="{{ trans('plugins/job-board::job-application.answer_correct') }}"><x-core::icon name="ti ti-circle-check" /></span>
                                        @else
                                            <span class="text-danger" title="{{ trans('plugins/job-board::job-application.answer_incorrect') }}"><x-core::icon name="ti ti-circle-x" /></span>
                                        @endif
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if(!$jobApplication->is_external_apply && (auth()->check() && is_in_admin(true) || auth('account')->check()))
        @push('footer')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Send Email functionality
                    document.querySelectorAll('.applicant-send-email').forEach(function(btn) {
                        btn.addEventListener('click', function(e) {
                            e.preventDefault();
                            var applicationId = this.getAttribute('data-application-id');
                            var wrap = this.closest('[class*="datagrid"]') || document;
                            var subject = wrap.querySelector('.applicant-email-subject');
                            var body = wrap.querySelector('.applicant-email-body');
                            var sub = subject ? subject.value : '';
                            var b = body ? body.value : '';
                            
                            if (!sub || !b) {
                                alert('Please fill in both subject and message');
                                return;
                            }
                            
                            // Disable button and show loading
                            this.disabled = true;
                            var originalText = this.innerHTML;
                            this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Sending...';
                            
                            // Make API call
                            fetch('{{ route("public.account.applicants.send-email", ":id") }}'.replace(':id', applicationId), {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    subject: sub,
                                    message: b
                                })
                            })
                            .then(function(response) { return response.json(); })
                            .then(function(data) {
                                if (data.error === false) {
                                    if (typeof Botble !== 'undefined') {
                                        Botble.showSuccess(data.message || 'Email sent successfully');
                                    } else {
                                        alert(data.message || 'Email sent successfully');
                                    }
                                    // Clear form
                                    if (subject) subject.value = '';
                                    if (body) body.value = '';
                                } else {
                                    if (typeof Botble !== 'undefined') {
                                        Botble.showError(data.message || 'Failed to send email');
                                    } else {
                                        alert(data.message || 'Failed to send email');
                                    }
                                }
                            })
                            .catch(function(error) {
                                console.error('Error:', error);
                                if (typeof Botble !== 'undefined') {
                                    Botble.showError('Failed to send email');
                                } else {
                                    alert('Failed to send email');
                                }
                            })
                            .finally(function() {
                                btn.disabled = false;
                                btn.innerHTML = originalText;
                            });
                        });
                    });
                    
                    // Send WhatsApp functionality
                    document.querySelectorAll('.applicant-send-whatsapp').forEach(function(btn) {
                        btn.addEventListener('click', function(e) {
                            e.preventDefault();
                            var applicationId = this.getAttribute('data-application-id');
                            var wrap = this.closest('[class*="datagrid"]') || document;
                            var subjectEl = wrap.querySelector('.applicant-wa-subject');
                            var msgEl = wrap.querySelector('.applicant-wa-message');
                            var subject = subjectEl ? subjectEl.value : '';
                            var msg = msgEl ? msgEl.value : '';
                            
                            if (!msg) {
                                alert('Please enter a message');
                                return;
                            }
                            
                            // Combine subject and message
                            var fullMessage = (subject ? subject + '\n\n' : '') + msg;
                            
                            // Disable button and show loading
                            this.disabled = true;
                            var originalText = this.innerHTML;
                            this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Sending...';
                            
                            // Make API call
                            fetch('{{ route("public.account.applicants.send-whatsapp", ":id") }}'.replace(':id', applicationId), {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    message: fullMessage
                                })
                            })
                            .then(function(response) { return response.json(); })
                            .then(function(data) {
                                if (data.error === false) {
                                    if (typeof Botble !== 'undefined') {
                                        Botble.showSuccess(data.message || 'WhatsApp message sent successfully');
                                    } else {
                                        alert(data.message || 'WhatsApp message sent successfully');
                                    }
                                    // Clear form
                                    if (subjectEl) subjectEl.value = '';
                                    if (msgEl) msgEl.value = '';
                                } else {
                                    if (typeof Botble !== 'undefined') {
                                        Botble.showError(data.message || 'Failed to send WhatsApp message');
                                    } else {
                                        alert(data.message || 'Failed to send WhatsApp message');
                                    }
                                }
                            })
                            .catch(function(error) {
                                console.error('Error:', error);
                                if (typeof Botble !== 'undefined') {
                                    Botble.showError('Failed to send WhatsApp message');
                                } else {
                                    alert('Failed to send WhatsApp message');
                                }
                            })
                            .finally(function() {
                                btn.disabled = false;
                                btn.innerHTML = originalText;
                            });
                        });
                    });
                });
            </script>
        @endpush
    @endif
@endif
