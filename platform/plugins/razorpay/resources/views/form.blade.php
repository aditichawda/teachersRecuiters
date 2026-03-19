<form action="{{ $action }}" method="post" id="razorpay-redirect-form">
    @foreach($data as $key => $value)
        @if (is_array($value))
            @foreach($value as $valueKey => $item)
                <input type="hidden" name="{{ $key }}[{{ $valueKey }}]" value="{{ $item }}"/>
            @endforeach
        @else
            <input type="hidden" name="{{ $key }}" value="{{ $value }}"/>
        @endif
    @endforeach
    <button type="submit"  aria-hidden="true">{{ trans('plugins/razorpay::razorpay.submit') }}</button>
</form>

<p class="text-center small text-muted py-3">{{ trans('plugins/razorpay::razorpay.redirecting') }}</p>

<script>
    'use strict';
    (function () {
        function submitRazorpayForm() {
            var f = document.getElementById('razorpay-redirect-form');
            if (f) {
                f.submit();
            }
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', submitRazorpayForm);
        } else {
            submitRazorpayForm();
        }
    })();
</script>
<noscript>
    <p class="text-center">{{ trans('plugins/razorpay::razorpay.redirecting') }}</p>
    <form action="{{ $action }}" method="post">
        @foreach($data as $key => $value)
            @if (is_array($value))
                @foreach($value as $valueKey => $item)
                    <input type="hidden" name="{{ $key }}[{{ $valueKey }}]" value="{{ $item }}"/>
                @endforeach
            @else
                <input type="hidden" name="{{ $key }}" value="{{ $value }}"/>
            @endif
        @endforeach
        <button type="submit" class="btn btn-primary">{{ trans('plugins/razorpay::razorpay.submit') }}</button>
    </form>
</noscript>
