@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <x-core::form :url="route('dedicated-recruiter-requests.update', $item)" method="put">
        @csrf
        <x-core::card>
            <x-core::card.header>
                <x-core::card.title>{{ __('Edit Dedicated Recruiter Request #:id', ['id' => $item->id]) }}</x-core::card.title>
            </x-core::card.header>
            <x-core::card.body>
                <div class="row g-3">
                    <div class="col-12">
                        <p class="text-muted small mb-0">{{ __('Employer') }}: {{ $item->account ? trim($item->account->first_name . ' ' . $item->account->last_name) : '—' }} (ID: {{ $item->account_id }})</p>
                    </div>
                    <div class="col-md-6">
                        <x-core::form.select
                            name="status"
                            :label="__('Status')"
                            :options="[
                                'pending' => __('Pending'),
                                'accepted' => __('Accepted'),
                                'rejected' => __('Rejected'),
                            ]"
                            :value="$item->status"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-core::form.text-input
                            name="duration_months"
                            type="number"
                            :label="__('Duration (months)')"
                            :value="$item->duration_months"
                            min="1"
                            max="24"
                            required
                        />
                    </div>
                    <div class="col-md-6">
                        <x-core::form.select
                            name="staff_id"
                            :label="__('Assign Staff (Admin User)')"
                            :options="['' => __('-- Select Staff --')] + $staffUsers->all()"
                            :value="$item->staff_id"
                        />
                    </div>
                    <div class="col-12">
                        <x-core::form.textarea
                            name="note"
                            :label="__('Note')"
                            :value="$item->note"
                            :rows="4"
                            maxlength="2000"
                        />
                    </div>
                </div>
            </x-core::card.body>
            <x-core::card.footer>
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                <a href="{{ route('dedicated-recruiter-requests.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </x-core::card.footer>
        </x-core::card>
    </x-core::form>
@stop
