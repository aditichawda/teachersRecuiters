<script type="text/javascript">
    // Immediately override alert() and confirm() before any other scripts load
    (function() {
        if (!window._dialogOverridesInstalled) {
            window._dialogOverridesInstalled = true;
            window.originalAlert = window.alert;
            window.originalConfirm = window.confirm;
            
            window.alert = function(message) {
                if (typeof window.showDialogAlert === 'function') {
                    window.showDialogAlert('info', message, 'Alert');
                } else {
                    // Queue for later
                    if (!window._pendingAlerts) window._pendingAlerts = [];
                    window._pendingAlerts.push({type: 'alert', message: message});
                    window.originalAlert(message);
                }
            };
            
            window.confirm = function(message) {
                if (typeof window.showDialogConfirm === 'function') {
                    let result = null;
                    let resolved = false;
                    window.showDialogConfirm(message, 'Confirm').then((confirmed) => {
                        result = confirmed;
                        resolved = true;
                    });
                    // Block until resolved (with timeout to prevent infinite loop)
                    const start = Date.now();
                    const maxWait = 60000; // 60 seconds
                    while (!resolved && (Date.now() - start) < maxWait) {
                        // Busy wait - needed for synchronous compatibility
                    }
                    return result === true;
                } else {
                    // Fallback to original - dialog system not ready yet
                    return window.originalConfirm(message);
                }
            };
        }
    })();
    
    var BotbleVariables = BotbleVariables || {};

    @if (Auth::guard()->check())
        BotbleVariables.languages = {
            tables: {{ Js::from(trans('core/base::tables')) }},
            notices_msg: {{ Js::from(trans('core/base::notices')) }},
            pagination: {{ Js::from(trans('pagination')) }},
        };
        BotbleVariables.authorized =
            "{{ setting('membership_authorization_at') && Carbon\Carbon::now()->diffInDays(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', setting('membership_authorization_at'))) <= 7 ? 1 : 0 }}";
        BotbleVariables.authorize_url = "{{ route('membership.authorize') }}";

        BotbleVariables.menu_item_count_url = "{{ route('menu-items-count') }}";
    @else
        BotbleVariables.languages = {
            notices_msg: {{ Js::from(trans('core/base::notices')) }},
        };
    @endif
</script>

@push('footer')
    @if (Session::has('success_msg') || Session::has('error_msg') || (isset($errors) && $errors->any()) || isset($error_msg))
        <script type="text/javascript">
            $(function() {
                @if (Session::has('success_msg'))
                    Botble.showSuccess('{!! BaseHelper::cleanToastMessage(session('success_msg')) !!}');
                @endif
                @if (Session::has('error_msg'))
                    Botble.showError('{!! BaseHelper::cleanToastMessage(session('error_msg')) !!}');
                @endif
                @if (isset($error_msg))
                    Botble.showError('{!! BaseHelper::cleanToastMessage($error_msg) !!}');
                @endif
                @if (isset($errors))
                    @foreach ($errors->all() as $error)
                        Botble.showError('{!! BaseHelper::cleanToastMessage($error) !!}');
                    @endforeach
                @endif
            })
        </script>
    @endif
    
    {{-- Cursor AI: Job created console log (session → browser console). See CURSOR_AI_CHANGES.md - 17 Feb 2026 --}}
    @if (Session::has('job_created_console_data'))
        @php
            $consoleData = session('job_created_console_data');
            session()->forget('job_created_console_data');
        @endphp
        <script type="text/javascript">
            $(function() {
                console.log('%c✅ Job Created Successfully!', 'color: #10b981; font-size: 16px; font-weight: bold;');
                console.log('%cJob Details:', 'color: #3b82f6; font-size: 14px; font-weight: bold;');
                console.log('  Job ID: {{ $consoleData['job_id'] }}');
                console.log('  Job Name: {{ $consoleData['job_name'] }}');
                console.log('');
                
                @if ($consoleData['email_count'] > 0)
                    console.log('%c📧 Email sent to {{ $consoleData['email_count'] }} job seeker(s):', 'color: #8b5cf6; font-size: 14px; font-weight: bold;');
                    @foreach ($consoleData['job_seekers'] as $index => $jobSeeker)
                        console.log('  {{ $index + 1 }}. {{ $jobSeeker['name'] }} ({{ $jobSeeker['email'] }})');
                    @endforeach
                @else
                    console.log('%c⚠️ No job seekers found to send emails.', 'color: #f59e0b; font-size: 14px; font-weight: bold;');
                    @if (isset($consoleData['debug_info']))
                        console.log('%cDebug Info: {{ $consoleData['debug_info'] }}', 'color: #6b7280; font-size: 12px;');
                    @endif
                    console.log('%c💡 Tip: Check PHP error logs for detailed debugging information.', 'color: #6b7280; font-size: 12px; font-style: italic;');
                @endif
            });
        </script>
    @endif
@endpush
