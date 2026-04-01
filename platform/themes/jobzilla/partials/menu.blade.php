<ul {!! $options !!}>
    @foreach ($menu_nodes as $key => $row)
        <li class="@if ($row->has_child) has-child @endif @if ($row->css_class) {{ $row->css_class }} @endif @if ($row->active) active @endif">
            <a href="{{ url($row->url) }}" @if ($row->target !== '_self') target="{{ $row->target }}" @endif>
                @if ($row->icon_font)
                    <i class="{{ trim($row->icon_font) }}"></i>
                @endif
                {{ $row->title }}
            </a>
            @if ($row->has_child)
                {!! Menu::generateMenu([
                    'menu' => $row,
                    'menu_nodes' => $row->child,
                    'view' => 'menu',
                    'options' => ['class' => 'sub-menu'],
                ]) !!}
            @endif
        </li>
    @endforeach
</ul>
