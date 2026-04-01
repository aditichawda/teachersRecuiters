<div class="col">
    <div class="widget widget_services ftr-list-center">
        <h3 class="widget-title">{!! BaseHelper::clean($config['name']) !!}</h3>
        {!!
            Menu::generateMenu([
                'slug' => $config['menu_id'],
                'view' => 'custom-menu',
            ])
        !!}
    </div>
</div>
