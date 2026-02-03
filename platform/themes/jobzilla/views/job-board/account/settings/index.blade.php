@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'))

@section('content')
    <div class="twm-right-section-panel site-bg-gray account-setting">
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">{{ __('Basic Informations') }}</h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30 ">
                    {!! Form::open(['route' => 'public.account.post.settings', 'method' => 'POST', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ __('First Name') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control @error('first_name') is-invalid @enderror" name="first_name" type="text" value="{{ old('first_name', $account->first_name) }}" placeholder="{{ __('Enter first name') }}">
                                        <i class="fs-input-icon fa fa-user"></i>
                                        @error('first_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ __('Last Name') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control @error('last_name') is-invalid @enderror" name="last_name" type="text" value="{{ old('last_name', $account->last_name) }}" placeholder="{{ __('Enter last name') }}">
                                        <i class="fs-input-icon fa fa-user"></i>
                                        @error('last_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ __('Phone') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control @error('last_name') is-invalid @enderror" name="phone" type="text" value="{{ old('phone', $account->phone) }}" placeholder="{{ __('Enter phone number') }}">
                                        <i class="fs-input-icon fa fa-phone-alt"></i>
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ __('Date of Birth') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control @error('dob') is-invalid @enderror" name="dob" type="date"
                                               value="{{ old('dob', $account->dob ? $account->dob->format('Y-m-d') : '') }}"
                                               max="{{ now()->format('Y-m-d') }}" pattern="\d{4}-\d{2}-\d{2}">
                                        <i class="fs-input-icon fas fa-clock"></i>
                                        @error('dob')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                             

                            <div class="col-lg-12 mb-3">
                         
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="gender">{{ __('Gender') }}</label>
                                    {!! Form::select('gender', ['' => __('-- select --')] + Botble\JobBoard\Enums\AccountGenderEnum::labels(), old('gender', $account->gender), [
                                            'class' => 'form-control'
                                        ]) !!}
                                </div>
                            </div>

                            @if (! $account->type->getKey() && setting('job_board_enabled_register_as_employer'))
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="type" class="form-label required">{{ __('Type') }}</label>
                                        {!! Form::select('type', ['' => __('-- select --')] + Botble\JobBoard\Enums\AccountTypeEnum::labels(), old('type', $account->type), [
                                            'class' => 'form-control',
                                            'required' => true,
                                        ]) !!}
                                    </div>
                                </div>
                            @endif

                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>{{ __('Address') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control @error('address') is-invalid @enderror" name="address" type="text" value="{{ old('address', $account->address) }}" placeholder="{{ __('Enter address') }}">
                                        <i class="fs-input-icon fa fa-map-marked"></i>
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            @if ($account->isJobSeeker())
                                @if (count($jobSkills) || count($selectedJobSkills))
                                    <div class="form-group">
                                        <label for="favorite_skills">{{ __('Favorite Job Skills') }}</label>
                                        <div class="ls-inputicon-box">
                                            <input type="text" class="tags form-control list-tagify" id="favorite_skills" name="favorite_skills" value="{{ implode(',', $selectedJobSkills) }}" data-keep-invalid-tags="false" data-list="{{ $jobSkills }}" data-user-input="false" placeholder="{{ __('Select from the list.') }}"/>
                                            <i class="fs-input-icon fa fa-tags"></i>
                                            @error('favorite_skills')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                @if (count($jobTags) || count($selectedJobTags))
                                    <div class="form-group mb-3">
                                        <label for="favorite_tags" class="form-label">{{ __('Favorite Job Tags') }}</label>
                                        <div class="ls-inputicon-box">
                                            <input type="text" class="tags form-control list-tagify" id="favorite_tags" name="favorite_tags" value="{{ implode(',', $selectedJobTags) }}" data-keep-invalid-tags="false" data-list="{{ $jobTags }}" data-user-input="false" placeholder="{{ __('Select from the list.') }}"/>
                                            <i class="fs-input-icon fa fa-tags"></i>
                                        </div>
                                        @error('favorite_tags')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                @endif

                                <div class="col-lg-12 mt-3">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="available_for_hiring" value="0">
                                            <input class="form-check-input" name="available_for_hiring" value="1" type="checkbox"
                                                   role="switch" id="available_for_hiring" @checked(old('available_for_hiring', $account))>
                                            <label class="font-sm color-text-mutted mb-10" for="available_for_hiring">{{ __('Available for hiring?') }}</label>
                                        </div>
                                    </div>
                                </div>
  <!-- Salary Fields -->
  <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ __('Salary') }}</label>
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
                                <div class="form-group">
                                    <label>{{ __('') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control @error('salary_amount') is-invalid @enderror" 
                                            name="salary_amount" 
                                            type="number" 
                                            step="0.01"
                                            value="{{ old('salary_amount', $account->salary_amount) }}" 
                                            placeholder="{{ __('salary') }}">
                                        <i class="fs-input-icon fa fa-rupee-sign"></i>
                                        @error('salary_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="is_public_profile" value="0">
                                            <input class="form-check-input" name="is_public_profile" value="1" type="checkbox"
                                                   role="switch" id="is_public_profile" @checked(old('is_public_profile', $account))>
                                            <label class="font-sm color-text-mutted mb-10" for="is_public_profile">{{ __('Is public profile?') }}</label>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>{{ __('Introduce Yourself') }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control @error('description') is-invalid @enderror" name="description" type="text" value="{{ old('description', $account->description) }}" placeholder="{{ __('Enter address') }}">
                                        <i class="fs-input-icon fa fa-info"></i>
                                        @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="bio">{{ __('BIO') }}</label>
                                    {!! Form::customEditor('bio', old('bio', $account->bio)) !!}
                                    @error('bio')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>


                            @if ($account->isJobSeeker())
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="attachments-cv" class="font-sm color-text-mutted mb-10">{{ __('Attachments CV') }}</label>
                                        <input type="file" class="form-control @error('resume') is-invalid @enderror"
                                               id="attachments-cv" name="resume" accept=".pdf,.doc,.docx,.ppt,.pptx" />
                                        @if ($account->resume)
                                            <div class="mb-4 mt-2">
                                                <p class="job-apply-resume-info"><i class="mdi mdi-information"></i> {!! BaseHelper::clean(__('Your current resume :resume. Just upload a new resume if you want to change it.', ['resume' => Html::link(RvMedia::url($account->resume), $account->resume, ['target' => '_blank'])->toHtml()])) !!}</p>
                                            </div>
                                        @endif
                                        @error('resume')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="attachments-cover-letter" class="font-sm color-text-mutted mb-10">{{ __('Cover letter') }}</label>
                                        <input type="file" @class(['form-control', 'is-invalid' => $errors->has('cover_letter')])
                                        id="attachments-cover-letter" name="cover_letter" accept=".pdf,.doc,.docx,.ppt,.pptx" />
                                        @if ($account->cover_letter)
                                            <div class="mb-4 mt-2">
                                                <p class="job-apply-resume-info"><i class="mdi mdi-information"></i> {!! BaseHelper::clean(__('Your current cover_letter :cover_letter. Just upload a new resume if you want to change it.', ['cover_letter' => Html::link(RvMedia::url($account->cover_letter), $account->cover_letter, ['target' => '_blank'])->toHtml()])) !!}</p>
                                            </div>
                                        @endif
                                        @error('cover_letter')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <div class="col-lg-12 col-md-12">
                                <div class="text-left">
                                    <button type="submit" class="site-button">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
    </div>
@endsection
