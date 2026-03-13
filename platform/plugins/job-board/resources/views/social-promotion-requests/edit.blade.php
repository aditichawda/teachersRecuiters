@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <x-core::form :url="route('social-promotion-requests.update', $item)" method="put">
        @csrf
        <x-core::card>
            <x-core::card.header>
                <x-core::card.title>{{ __('Edit Social Promotion Request #:id', ['id' => $item->id]) }}</x-core::card.title>
            </x-core::card.header>
            <x-core::card.body>
                <div class="row g-3">
                    <div class="col-12">
                        <p class="text-muted small mb-0">{{ __('Employer') }}: {{ $item->account ? trim($item->account->first_name . ' ' . $item->account->last_name) : '—' }} (ID: {{ $item->account_id }})</p>
                    </div>
                    <div class="col-md-6">
                        <x-core::form.text-input
                            name="title"
                            :label="__('Title')"
                            :value="$item->title"
                            maxlength="255"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-core::form.text-input
                            name="tag"
                            :label="__('Tag')"
                            :value="$item->tag"
                            maxlength="255"
                        />
                    </div>
                    <div class="col-12">
                        <x-core::form.select
                            name="platform"
                            :label="__('Platform')"
                            :options="[
                                'LinkedIn' => 'LinkedIn',
                                'Facebook' => 'Facebook',
                                'Twitter' => 'Twitter',
                                'Instagram' => 'Instagram',
                                'Other' => 'Other',
                            ]"
                            :value="$item->platform"
                        />
                    </div>
                    <div class="col-12">
                        <x-core::form.textarea
                            name="message"
                            :label="__('Message')"
                            :value="$item->message"
                            :rows="4"
                            maxlength="2000"
                        />
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{ __('Image') }}</label>
                        @if($item->image)
                            <div class="mb-2">
                                <img src="{{ \Botble\Media\Facades\RvMedia::getImageUrl($item->image, 'thumb') }}" alt="" class="rounded" style="max-width:120px;max-height:120px;object-fit:cover;">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp">
                        <small class="text-muted">{{ __('Optional. Leave empty to keep current image.') }}</small>
                    </div>
                </div>
            </x-core::card.body>
            <x-core::card.footer>
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                <a href="{{ route('social-promotion-requests.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </x-core::card.footer>
        </x-core::card>
    </x-core::form>
@stop
