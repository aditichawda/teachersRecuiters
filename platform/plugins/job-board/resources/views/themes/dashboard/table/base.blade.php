@php
    $layout = 'plugins/job-board::themes.dashboard.layouts.master';
@endphp

@extends('core/table::table')

@section('content')
    @parent
@stop

@push('footer')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.body.addEventListener('change', function(e) {
        var el = e.target;
        if (el.classList && el.classList.contains('applicant-status-select')) {
            var url = el.getAttribute('data-url');
            var status = el.value;
            if (!url) return;
            var td = el.closest('td');
            var meta = document.querySelector('meta[name="csrf-token"]');
            var token = meta ? meta.getAttribute('content') : '';
            el.disabled = true;
            el.classList.add('opacity-75');
            var loader = document.createElement('span');
            loader.className = 'applicant-status-loader ms-2 small text-muted';
            loader.textContent = 'Saving...';
            if (td) td.appendChild(loader);
            var formData = new FormData();
            formData.append('_token', token);
            formData.append('status', status);
            fetch(url, { method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                .then(function(r) { return r.json().catch(function() { return {}; }); })
                .then(function(data) {
                    el.disabled = false;
                    el.classList.remove('opacity-75');
                    if (loader && loader.parentNode) loader.remove();
                    if (typeof Botble !== 'undefined') {
                        if (data && data.error === false) {
                            Botble.showSuccess(data.message || '{{ __("Updated successfully") }}');
                        } else {
                            Botble.showError((data && data.message) ? data.message : '{{ __("Update failed") }}');
                        }
                    } else {
                        if (data && data.error === false) alert('{{ __("Updated successfully") }}');
                        else alert((data && data.message) || '{{ __("Update failed") }}');
                    }
                })
                .catch(function() {
                    el.disabled = false;
                    el.classList.remove('opacity-75');
                    if (loader && loader.parentNode) loader.remove();
                    if (typeof Botble !== 'undefined') Botble.showError('{{ __("Update failed") }}');
                    else alert('{{ __("Update failed") }}');
                });
        }
    });
});
</script>
@endpush
