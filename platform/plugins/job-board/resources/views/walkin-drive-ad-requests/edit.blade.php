@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <x-core::form :url="route('walkin-drive-ad-requests.update', $item)" method="put">
        @csrf
        <x-core::card>
            <x-core::card.header>
                <x-core::card.title>{{ __('Edit Walk-in Drive Ad Request #:id', ['id' => $item->id]) }}</x-core::card.title>
            </x-core::card.header>
            <x-core::card.body>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">{{ __('Banner image') }}</label>
                        @php
                            $imgUrl = $item->banner_image_url
                                ?: (! empty($item->banner_image) ? \Botble\Media\Facades\RvMedia::getImageUrl($item->banner_image) : null);
                        @endphp
                        @if($imgUrl)
                            <div class="mb-2">
                                <img src="{{ $imgUrl }}" alt="" class="rounded border" style="max-width:100%;max-height:200px;object-fit:contain;">
                            </div>
                            <a href="{{ $imgUrl }}" target="_blank" rel="noopener" class="small">{{ __('Open image') }}</a>
                        @else
                            <p class="text-muted mb-0">—</p>
                        @endif
                    </div>
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
                            {{ $item->company ? $item->company->name : '—' }}
                        </p>
                    </div>
                    <div class="col-12">
                        <p class="text-muted small mb-0">
                            <strong>{{ __('Placement') }}:</strong>
                            @switch($item->placement ?? '')
                                @case('home') {{ __('Home page') }} @break
                                @case('job_listing') {{ __('Job Listing page') }} @break
                                @case('both') {{ __('Both (Home & Job Listing)') }} @break
                                @default {{ $item->placement ?? '—' }}
                            @endswitch
                        </p>
                    </div>
                    <div class="col-12">
                        <x-core::form.select
                            name="status"
                            :label="__('Status')"
                            :options="[
                                'pending' => __('Pending'),
                                'approved' => __('Approved'),
                                'rejected' => __('Rejected'),
                            ]"
                            :value="$item->status ?? 'pending'"
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
                <a href="{{ route('walkin-drive-ad-requests.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </x-core::card.footer>
        </x-core::card>
    </x-core::form>
@stop
