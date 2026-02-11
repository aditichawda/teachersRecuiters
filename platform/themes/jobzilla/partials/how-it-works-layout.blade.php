{{-- How It Works - Professional Corporate Layout (Admin Editable) --}}
{!! Theme::partial('hiw-styles') !!}

{{-- Render page content from admin panel --}}
{!! BaseHelper::clean($page->content) !!}
