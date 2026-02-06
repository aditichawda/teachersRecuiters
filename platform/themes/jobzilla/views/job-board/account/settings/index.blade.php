@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'))

@section('content')
    <!-- Page Header -->
    <div class="js-page-header">
        <h2>{{ __('My Profile') }}</h2>
        <a href="{{ url('/') }}">GO TO HOMEPAGE →</a>
    </div>

    <!-- Profile Card -->
    <div class="js-content-card">
        <div class="js-content-card-header">
            <h5>{{ __('Basic Information') }}</h5>
        </div>
        <div class="js-content-card-body">
            {!! Form::open(['route' => 'public.account.post.settings', 'method' => 'POST', 'files' => true]) !!}
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('First Name') }}</label>
                            <input class="form-control @error('first_name') is-invalid @enderror" name="first_name" type="text" value="{{ old('first_name', $account->first_name) }}" placeholder="{{ __('Enter first name') }}">
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('Last Name') }}</label>
                            <input class="form-control @error('last_name') is-invalid @enderror" name="last_name" type="text" value="{{ old('last_name', $account->last_name) }}" placeholder="{{ __('Enter last name') }}">
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('Phone') }}</label>
                            <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="text" value="{{ old('phone', $account->phone) }}" placeholder="{{ __('Enter phone number') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('Date of Birth') }}</label>
                            <input class="form-control @error('dob') is-invalid @enderror" name="dob" type="date"
                                   value="{{ old('dob', $account->dob ? $account->dob->format('Y-m-d') : '') }}"
                                   max="{{ now()->format('Y-m-d') }}" pattern="\d{4}-\d{2}-\d{2}">
                            @error('dob')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="gender">{{ __('Gender') }}</label>
                            {!! Form::select('gender', ['' => __('-- select --')] + Botble\JobBoard\Enums\AccountGenderEnum::labels(), old('gender', $account->gender), [
                                    'class' => 'form-control'
                                ]) !!}
                        </div>
                    </div>

                    @if (! $account->type->getKey() && setting('job_board_enabled_register_as_employer'))
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group mb-3">
                                <label for="type" class="form-label required">{{ __('Type') }}</label>
                                {!! Form::select('type', ['' => __('-- select --')] + Botble\JobBoard\Enums\AccountTypeEnum::labels(), old('type', $account->type), [
                                    'class' => 'form-control',
                                    'required' => true,
                                ]) !!}
                            </div>
                        </div>
                    @endif

                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('Address') }}</label>
                            <input class="form-control @error('address') is-invalid @enderror" name="address" type="text" value="{{ old('address', $account->address) }}" placeholder="{{ __('Enter address') }}">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    @if ($account->isJobSeeker())
                        @if (count($jobSkills) || count($selectedJobSkills))
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="favorite_skills">{{ __('Favorite Job Skills') }}</label>
                                    <input type="text" class="tags form-control list-tagify" id="favorite_skills" name="favorite_skills" value="{{ implode(',', $selectedJobSkills) }}" data-keep-invalid-tags="false" data-list="{{ $jobSkills }}" data-user-input="false" placeholder="{{ __('Select from the list.') }}"/>
                                    @error('favorite_skills')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        @if (count($jobTags) || count($selectedJobTags))
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="favorite_tags">{{ __('Favorite Job Tags') }}</label>
                                    <input type="text" class="tags form-control list-tagify" id="favorite_tags" name="favorite_tags" value="{{ implode(',', $selectedJobTags) }}" data-keep-invalid-tags="false" data-list="{{ $jobTags }}" data-user-input="false" placeholder="{{ __('Select from the list.') }}"/>
                                    @error('favorite_tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Salary Type') }}</label>
                                {!! Form::select('salary_type', [
                                    '' => __('-- select --'),
                                    'yearly' => __('Yearly'),
                                    'monthly' => __('Monthly'),
                                    'weekly' => __('Weekly'),
                                    'hourly' => __('Hourly'),
                                ], old('salary_type', $account->salary_type), [
                                    'class' => 'form-control'
                                ]) !!}
                                @error('salary_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Expected Salary') }}</label>
                                <input class="form-control @error('salary_amount') is-invalid @enderror" 
                                    name="salary_amount" 
                                    type="number" 
                                    step="0.01"
                                    value="{{ old('salary_amount', $account->salary_amount) }}" 
                                    placeholder="{{ __('Enter amount') }}">
                                @error('salary_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="available_for_hiring" value="0">
                                    <input class="form-check-input" name="available_for_hiring" value="1" type="checkbox"
                                           role="switch" id="available_for_hiring" @checked(old('available_for_hiring', $account))>
                                    <label class="form-check-label" for="available_for_hiring">{{ __('Available for hiring?') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="is_public_profile" value="0">
                                    <input class="form-check-input" name="is_public_profile" value="1" type="checkbox"
                                           role="switch" id="is_public_profile" @checked(old('is_public_profile', $account))>
                                    <label class="form-check-label" for="is_public_profile">{{ __('Is public profile?') }}</label>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('Introduce Yourself') }}</label>
                            <input class="form-control @error('description') is-invalid @enderror" name="description" type="text" value="{{ old('description', $account->description) }}" placeholder="{{ __('Short introduction') }}">
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="bio">{{ __('BIO') }}</label>
                            {!! Form::customEditor('bio', old('bio', $account->bio)) !!}
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    @if ($account->isJobSeeker())
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label" for="attachments-cv">{{ __('Resume / CV') }}</label>
                                <input type="file" class="form-control @error('resume') is-invalid @enderror"
                                       id="attachments-cv" name="resume" accept=".pdf,.doc,.docx,.ppt,.pptx" />
                                @if ($account->resume)
                                    <small class="text-muted mt-1 d-block">
                                        <i class="fa fa-file me-1"></i>
                                        <a href="{{ RvMedia::url($account->resume) }}" target="_blank">View Current Resume</a>
                                    </small>
                                @endif
                                @error('resume')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label" for="attachments-cover-letter">{{ __('Cover Letter') }}</label>
                                <input type="file" class="form-control @error('cover_letter') is-invalid @enderror"
                                       id="attachments-cover-letter" name="cover_letter" accept=".pdf,.doc,.docx,.ppt,.pptx" />
                                @if ($account->cover_letter)
                                    <small class="text-muted mt-1 d-block">
                                        <i class="fa fa-file me-1"></i>
                                        <a href="{{ RvMedia::url($account->cover_letter) }}" target="_blank">View Current Cover Letter</a>
                                    </small>
                                @endif
                                @error('cover_letter')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="col-lg-12 col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-2"></i>{{ __('Save Changes') }}
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
