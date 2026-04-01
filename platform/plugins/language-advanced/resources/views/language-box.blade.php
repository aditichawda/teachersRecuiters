<input
    name="language"
    type="hidden"
    value="{{ $currentLanguage?->lang_code }}"
>
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
        @continue(!$currentLanguage || $language->lang_code === $currentLanguage->lang_code)
            <x-core::dropdown.item
                :href="Route::has($route['edit']) ? Request::url() . ($language->lang_code != Language::getDefaultLocaleCode() ? '?' . Language::refLangKey() . '=' . $language->lang_code : null) : '#'"
            target="_blank"
        >
                {!! language_flag($language->lang_flag, $language->lang_name, 20) !!}
                <span>{{ $language->lang_name }}</span>
                <x-core::icon name="ti ti-external-link" class="ms-auto" />
            </x-core::dropdown.item>
    @endforeach
</div>
</x-core::dropdown>

@push('header')
    <meta
        name="{{ Language::refFromKey() }}"
        content="{{ !empty($args[0]) && $args[0]->id ? $args[0]->id : 0 }}"
    >
    <meta
        name="{{ Language::refLangKey() }}"
        content="{{ $currentLanguage?->lang_code }}"
    >
@endpush
