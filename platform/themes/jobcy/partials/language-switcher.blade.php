@php
    $supportedLocales = Language::getSupportedLocales();
    if (empty($options)) {
        $options = [
            'before'    => '',
            'lang_flag'  => true,
            'lang_name' => true,
            'class'     => '',
            'after'     => '',
        ];
    }
@endphp

@if ($supportedLocales && count($supportedLocales) > 1)
    @php
        $languageDisplay = setting('language_display', 'all');
    @endphp
    @if (setting('language_switcher_display', 'dropdown') == 'dropdown')
        <li class="list-inline-item py-2 align-middle">
            <div class="dropdown d-inline-block language-switch">
                {!! Arr::get($options, 'before') !!}
                <button type="button" class="btn" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                        {!! language_flag(Language::getCurrentLocaleFlag(), Language::getCurrentLocaleName()) !!}
                    @endif
                    @if (Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name'))
                        {{ Language::getCurrentLocaleName() }}
                    @endif
                    <i class="mdi mdi-chevron-down"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    @foreach ($supportedLocales as $localeCode => $properties)
                        @if ($localeCode != Language::getCurrentLocale())
                            <a href="{{ Language::getSwitcherUrl($localeCode, $properties['lang_code']) }}"
                               class="dropdown-item notify-item language">
                                @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                                    {!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}
                                @endif
                                @if (Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name'))
                                    <span class="align-middle">&nbsp;{{ $properties['lang_name'] }}</span>
                                @endif
                            </a>
                        @endif
                    @endforeach
                </div>
                {!! Arr::get($options, 'after') !!}
            </div>
        </li>
    @else
        @foreach ($supportedLocales as $localeCode => $properties)
            @if ($localeCode != Language::getCurrentLocale())
                <li class="list-inline-item py-2 align-middle">
                    <a href="{{ Language::getSwitcherUrl($localeCode, $properties['lang_code']) }}">
                        @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                            {!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}
                        @endif
                        @if (Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name'))
                            <span>&nbsp;{{ $properties['lang_name'] }}</span>
                        @endif
                    </a>
                </li>
            @endif
        @endforeach
    @endif
@endif
