@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <x-core::form :url="route('job-posting-assistance-requests.update', $item)" method="put">
        @csrf
        <x-core::card>
            <x-core::card.header>
                <x-core::card.title>{{ __('Edit Job Posting Assistance Request #:id', ['id' => $item->id]) }}</x-core::card.title>
            </x-core::card.header>
            <x-core::card.body>
                <div class="row g-3">
                    <div class="col-12">
                        <p class="text-muted small mb-0">
                            <strong>{{ __('Employer') }}:</strong>
                            {{ $item->account ? trim($item->account->first_name . ' ' . $item->account->last_name) : '—' }}
                            @if($item->account && $item->account->email)
                                &middot; {{ $item->account->email }}
                            @endif
                        </p>
                    </div>
                    <div class="col-12">
                        <p class="text-muted small mb-0">
                            <strong>{{ __('Institution') }}:</strong>
                            {{ $item->company ? $item->company->name : ($item->institution_name ?: '—') }}
                        </p>
                    </div>
                    <div class="col-12">
                        <x-core::form.select
                            name="status"
                            :label="__('Status')"
                            :options="[
                                'pending' => __('Pending'),
                                'accepted' => __('Accepted'),
                                'rejected' => __('Rejected'),
                            ]"
                            :value="$item->status ?? 'pending'"
                        />
                    </div>
                    <div class="col-12">
                        <x-core::form.text-input
                            name="institution_name"
                            :label="__('Institution Name')"
                            :value="$item->institution_name"
                            maxlength="255"
                        />
                    </div>
                    <div class="col-12">
                        <x-core::form.textarea
                            name="message"
                            :label="__('Message')"
                            :value="$item->message"
                            :rows="4"
                            maxlength="5000"
                        />
                    </div>
                </div>
            </x-core::card.body>
            <x-core::card.footer>
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                <a href="{{ route('job-posting-assistance-requests.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </x-core::card.footer>
        </x-core::card>
    </x-core::form>
@stop
