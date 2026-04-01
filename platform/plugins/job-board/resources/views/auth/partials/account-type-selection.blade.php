<div class="mb-2">
    <label class="form-label required visually-hidden">{{ trans('plugins/job-board::account.registration.account_type') }}</label>
    <div class="account-type-selection">
        <div class="row g-3">
            <div class="col-md-12">
                <div class="account-type-option">
                    <input type="radio" id="jobseeker" name="account_type" value="job-seeker" class="form-check-input" required checked>
                    <label for="jobseeker" class="account-type-label">
                        <div>
                            <div class="account-type-content" style="text-align:center;margin-top:10px;">
                                <h6>{{ trans('plugins/job-board::account.registration.job_seeker') }}</h6>
                                <p>{{ trans('plugins/job-board::account.registration.job_seeker_description') }}</p>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
