<ul <?php echo BaseHelper::clean($options); ?>>
    <?php $__currentLoopData = $menu_nodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li <?php if($row->css_class): ?> class="<?php echo e($row->css_class); ?>" <?php endif; ?>>
            <a href="<?php echo e($row->url); ?>" target="<?php echo e($row->target); ?>">
                <?php if($row->icon_html): ?> <?php echo $row->icon_html; ?> <?php else: ?> <i class="mdi mdi-chevron-right"></i> <?php endif; ?> <?php echo e($row->title); ?>

            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobcy/partials/footer-menu.blade.php ENDPATH**/ ?>