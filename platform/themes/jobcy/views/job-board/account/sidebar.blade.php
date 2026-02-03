<div class="card profile-sidebar me-lg-4">
    <div class="card-body p-4">
        <div class="text-center pb-4 border-bottom">
            <img src="{{ $account->avatar_url }}" alt="avatar"
                class="avatar-lg img-thumbnail rounded-circle mb-4" />
            <h5 class="mb-0">{{ $account->name }}</h5>
            <div class="text-center small">{{ $account->email }}</div>
        </div>
        <!--end profile-->

        <div class="mt-4">
            <h5 class="fs-17 fw-bold mb-3">{{ __('Menu') }}</h5>
            <div class="profile-contact">
                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="{{ route('public.account.overview') }}">
                            <i class="uil uil-user"></i>
                            <span>{{ __('Overview') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('public.account.settings') }}">
                            <i class="uil uil-cog"></i>
                            <span>{{ __('Settings') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('public.account.security') }}">
                            <i class="uil uil-lock"></i>
                            <span>{{ __('Security') }}</span>
                        </a>
                    </li>
                    @if ($account->isJobSeeker())
                        <li>
                            <a href="{{ route('public.account.educations.index') }}">
                                <i class="uil uil-cog"></i>
                                <span>{{ __('Educations') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('public.account.experiences.index') }}">
                                <i class="uil uil-cog"></i>
                                <span>{{ __('Experiences') }}</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        @if ($account->isJobSeeker() && $account->resume)
            <div class="mt-4 border-bottom pb-4">
                <h5 class="fs-17 fw-bold mb-3">{{ __('Documents') }}</h5>
                <ul class="profile-document list-unstyled mb-0">
                    <li>
                        <div class="profile-document-list d-flex align-items-center mt-4 ">
                            <div class="icon flex-shrink-0">
                                <i class="uil uil-file"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="fs-16 mb-0">{{ $account->resume_name }}</h6>
                                <p class="text-muted mb-0"></p>
                            </div>
                            <div class="ms-auto">
                                <a href="{{ $account->resume_url }}" download class="fs-20 text-muted">
                                    <i class="uil uil-import"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!--end document-->
        @endif

        <div class="mt-4">
            <h5 class="fs-17 fw-bold mb-3">{{ __('Contacts') }}</h5>
            <div class="profile-contact">
                <ul class="list-unstyled mb-0">
                    @if ($account->email)
                    <li>
                        <div class="d-flex">
                            <label>{{ __('Email') }}</label>
                            <div>
                                <p class="text-muted text-break mb-0">
                                    {{ Html::mailto($account->email) }}
                                </p>
                            </div>
                        </div>
                    </li>
                    @endif

                    @if ($account->phone)
                        <li>
                            <div class="d-flex">
                                <label>{{ __('Phone') }}</label>
                                <div>
                                    <p class="text-muted mb-0">{{ $account->phone }}</p>
                                </div>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <!--end contact-details-->

    </div>
    <!--end card-body-->
</div>
<!--end profile-sidebar-->
