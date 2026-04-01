<script>
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('change', function(e) {
        var el = e.target;
        if (el.classList && el.classList.contains('applicant-status-select')) {
            var url = el.getAttribute('data-url');
            var status = el.value;
            var formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            formData.append('status', status);
            fetch(url, { method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (typeof Botble !== 'undefined' && data.error === false) {
                        Botble.showSuccess(data.message || 'Updated');
                    } else if (data.error) {
                        Botble.showError(data.message || 'Failed');
                    }
                })
                .catch(function() {
                    if (typeof Botble !== 'undefined') Botble.showError('Failed');
                });
        }
    });
});
</script>
