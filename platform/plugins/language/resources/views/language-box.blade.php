<div
    id="select-post-language"
    class="gap-2 mb-4 d-flex align-items-center"
>
    {!! language_flag($currentLanguage->lang_flag, $currentLanguage->lang_name, 24) !!}

    <select
        name="language"
        id="post_lang_choice"
        class="form-select"
    >
        @foreach ($languages as $language)
            @if (!array_key_exists(json_encode([$language->lang_code]), $related))
                <option
                    value="{{ $language->lang_code }}"
                    @if ($language->lang_code == $currentLanguage->lang_code) selected="selected" @endif
                    data-flag="{{ $language->lang_flag }}"
                >{{ $language->lang_name }}</option>
            @endif
        @endforeach
    </select>
</div>

@if (count($languages) > 1)
    <div>
        <style>
            #list-others-language {
                max-height: 200px;
                overflow-y: auto;
                scrollbar-width: thin;
                scrollbar-color: #cbd5e1 #f1f5f9;
            }
            
            #list-others-language::-webkit-scrollbar {
                width: 6px;
            }
            
            #list-others-language::-webkit-scrollbar-track {
                background: #f1f5f9;
                border-radius: 3px;
            }
            
            #list-others-language::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 3px;
            }
            
            #list-others-language::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }
            
            #list-others-language .dropdown-item {
                padding: 10px 16px;
                display: flex;
                align-items: center;
                gap: 10px;
                transition: all 0.2s ease;
            }
            
            #list-others-language .dropdown-item:hover {
                background: var(--bb-bg-surface-secondary, #f8f9fa);
                color: var(--bb-body-color, #212529);
            }
            
            #list-others-language .dropdown-item .flag {
                width: 20px;
                height: 15px;
                flex-shrink: 0;
            }
            
            #list-others-language .dropdown-item span {
                flex: 1;
                font-size: 14px;
            }
            
            #list-others-language .dropdown-item .ms-auto {
                margin-left: auto;
                opacity: 0.6;
                font-size: 14px;
            }
        </style>
        <x-core::dropdown
            label="Languages"
            wrapper-class="w-100"
        >
        <div id="list-others-language">
            @foreach ($languages as $language)
                @continue($language->lang_code === $currentLanguage->lang_code)

                @if (array_key_exists($language->lang_code, $related))
                        <x-core::dropdown.item
                            :href="Route::has($route['edit']) ? route($route['edit'], $related[$language->lang_code]) : '#'"
                    >
                            {!! language_flag($language->lang_flag, $language->lang_name, 20) !!}
                            <span>{{ $language->lang_name }}</span>
                            <x-core::icon name="ti ti-edit" class="ms-auto" />
                        </x-core::dropdown.item>
                @else
                        <x-core::dropdown.item
                            :href="Route::has($route['create']) ? route($route['create']) . '?' . http_build_query(array_merge($queryParams, [Language::refLangKey() => $language->lang_code])) : '#'"
                    >
                            {!! language_flag($language->lang_flag, $language->lang_name, 20) !!}
                            <span>{{ $language->lang_name }}</span>
                            <x-core::icon name="ti ti-plus" class="ms-auto" />
                        </x-core::dropdown.item>
                @endif
            @endforeach
        </div>
        </x-core::dropdown>
    </div>

    <input
        type="hidden"
        id="lang_meta_created_from"
        name="ref_from"
        value="{{ Language::getRefFrom() }}"
    >
    <input
        type="hidden"
        id="reference_id"
        value="{{ $queryParams['ref_from'] }}"
    >
    <input
        type="hidden"
        id="reference_type"
        value="{{ $args[1] }}"
    >
    <input
        type="hidden"
        id="route_create"
        value="{{ Route::has($route['create']) ? route($route['create']) : '#' }}"
    >
    <input
        type="hidden"
        id="route_edit"
        value="{{ Route::has($route['edit']) ? route($route['edit'], $queryParams['ref_from']) : '#' }}"
    >
    <input
        type="hidden"
        id="language_flag_path"
        value="{{ BASE_LANGUAGE_FLAG_PATH }}"
    >

    <div data-change-language-route="{{ route('languages.change.item.language') }}"></div>

    <x-core::modal.action
        id="confirm-change-language-modal"
        type="warning"
        :title="trans('plugins/language::language.confirm-change-language')"
        :description="BaseHelper::clean(trans('plugins/language::language.confirm-change-language-message'))"
        :submit-button-attrs="['id' => 'confirm-change-language-button']"
        :submit-button-label="trans('plugins/language::language.confirm-change-language-btn')"
    />
@endif

@push('header')
    <meta
        name="{{ Language::refFromKey() }}"
        content="{{ $queryParams['ref_from'] }}"
    >
    <meta
        name="{{ Language::refLangKey() }}"
        content="{{ $currentLanguage->lang_code }}"
    >
@endpush
