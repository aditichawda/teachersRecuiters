<ul {!! BaseHelper::clean($options) !!}>
    @foreach ($menu_nodes as $key => $row)
        <li @if ($row->css_class) class="{{ $row->css_class }}" @endif>
            <a href="{{ $row->url }}" target="{{ $row->target }}">
                @if ($row->icon_font) <i class="{{ trim($row->icon_font) }}"></i> @endif{{ $row->title }}
            </a>
        </li>
    @endforeach
</ul>

