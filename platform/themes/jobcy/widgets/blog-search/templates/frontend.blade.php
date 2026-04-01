@if (is_plugin_active('blog'))
    <aside class="widget widget_search">
        <form class="position-relative" role="search" method="GET" action="{{ route('public.search') }}">
            <input class="form-control" type="text" placeholder="{{ __('Search...') }}" value="{{ BaseHelper::stringify(request()->query('q')) }}" name="q">
            <button class="bg-transparent border-0 position-absolute top-50 end-0 translate-middle-y fs-22 me-2" type="submit">
                <span class="mdi mdi-magnify text-muted"></span>
            </button>
        </form>
    </aside>
@endif
