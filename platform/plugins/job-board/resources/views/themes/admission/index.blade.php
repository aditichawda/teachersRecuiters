@php
    Theme::set('pageTitle', __('Admission'));
    Theme::layout('default');
@endphp
<div class="container py-5">
    <h1>{{ __('Admission') }}</h1>
    <p>{{ __('Explore schools and submit your admission enquiry.') }}</p>
    @forelse($companies as $company)
        @php $admission = $company->admission; @endphp
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $company->name }}</h5>
                @if($admission->content)
                    <div>{!! BaseHelper::clean($admission->content) !!}</div>
                @endif
                <form action="{{ route('public.admission.enquiry') }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                    <input type="text" name="student_name" class="form-control mb-2" required placeholder="{{ __('Student Name') }}">
                    <input type="text" name="contact_number" class="form-control mb-2" required placeholder="{{ __('Contact Number') }}">
                    <input type="email" name="email" class="form-control mb-2" required placeholder="{{ __('Email') }}">
                    <input type="text" name="admission_for_standard" class="form-control mb-2" placeholder="{{ __('Admission for which standard') }}">
                    <textarea name="address" class="form-control mb-2" rows="2" placeholder="{{ __('Address') }}"></textarea>
                    <textarea name="message" class="form-control mb-2" rows="2" placeholder="{{ __('Message') }}"></textarea>
                    <button type="submit" class="btn btn-primary">{{ __('Submit Enquiry') }}</button>
                </form>
            </div>
        </div>
    @empty
        <p>{{ __('No schools have published admission information yet.') }}</p>
    @endforelse
</div>
