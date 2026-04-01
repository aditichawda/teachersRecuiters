<div class="info-pagination" style="display: none">
    {{
        __('Showing :from – :to of :total results', [
                'from' => $companies->firstItem(),
                'to' => $companies->lastItem(),
                'total' => $companies->total(),
        ])
    }}
</div>

@if(request()->query('layout') === 'grid')
    {!! Theme::partial('companies.company-grid', compact('companies')) !!}
@else
    {!! Theme::partial('companies.company-list', compact('companies')) !!}
@endif
{{ $companies->links(Theme::getThemeNamespace('partials.pagination')) }}
