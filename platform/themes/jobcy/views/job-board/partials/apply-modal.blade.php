@if (!$account->id || !$account->isEmployer())
    <div class="modal fade" id="applyNow" tabindex="-1" aria-labelledby="applyNow" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-5">
                    @if ($internalJobApplicationForm)
                        {!! $internalJobApplicationForm->renderForm() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>

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
@endif
