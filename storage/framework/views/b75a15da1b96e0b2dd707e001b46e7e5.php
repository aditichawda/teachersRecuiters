<div class="col-lg-2 col-6">
    <div class="footer-item mt-4 mt-lg-0">
        <p class="fs-16 text-white mb-4"><?php echo BaseHelper::clean($config['name']); ?></p>
        <?php echo Menu::generateMenu([
                'slug'    => $config['menu_id'],
                'view'    => 'footer-menu',
                'options' => ['class' => 'list-unstyled footer-list mb-0']
            ]); ?>

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobcy/////widgets/custom-menu/templates/frontend.blade.php ENDPATH**/ ?>