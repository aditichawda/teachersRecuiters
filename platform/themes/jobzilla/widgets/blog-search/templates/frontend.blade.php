@if (is_plugin_active('blog'))
    <div class="widget search-bx">
        <form role="search" action="{{ route('public.search') }}">
            <div class="input-group">
                <input type="text" class="form-control" name="q" placeholder="{{ __('Enter keyword...') }}" value="{{ BaseHelper::stringify(request()->query('q')) }}">
                <button class="btn" type="submit" id="button-addon2"><i class="feather-search"></i></button>
            </div>
        </form>
    </div>
@endif
