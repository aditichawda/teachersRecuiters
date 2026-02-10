<div class="col-lg-2 col-6">
    <div class="footer-item mt-4 mt-lg-0">
        <p class="fs-16 text-white mb-4">{!! BaseHelper::clean($config['name']) !!}</p>
        {!!
            Menu::generateMenu([
                'slug'    => $config['menu_id'],
                'view'    => 'footer-menu',
                'options' => ['class' => 'list-unstyled footer-list mb-0']
            ])
        !!}
    </div>
</div>
