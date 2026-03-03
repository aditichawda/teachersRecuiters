<?php if(is_plugin_active('newsletter')): ?>
    <section class="bg-subscribe">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div class="text-center text-lg-start">
                        <h2 class="text-white h4"><?php echo e($config['title']); ?></h2>
                        <p class="text-white-50 mb-0"><?php echo e($config['subtitle']); ?></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-4 mt-lg-0">
                        <?php echo Botble\Newsletter\Forms\Fronts\NewsletterForm::create()
                                ->formClass('newsletter-form')
                                ->modify('wrapper_before', 'html', \Botble\Base\Forms\FieldOptions\HtmlFieldOption::make()->content('<div class="input-group justify-content-center justify-content-lg-end">')->toArray())
                                ->add('wrapper_after_before', 'html', \Botble\Base\Forms\FieldOptions\HtmlFieldOption::make()->content('<div class="input-group justify-content-center justify-content-lg-end">')->toArray())
                                ->add('wrapper_after_after', 'html', \Botble\Base\Forms\FieldOptions\HtmlFieldOption::make()->content('</div>')->toArray())
                                ->setFormEndKey('wrapper_after_after')
                                ->renderForm(); ?>

                    </div>
                </div>

            </div>

        </div>

        <?php if($config['image']): ?>
            <div class="email-img d-none d-lg-block text-end" style="max-width: 30%">
                <img src="<?php echo e(RvMedia::getImageUrl($config['image'])); ?>" alt="image" class="img-fluid">
            </div>
        <?php endif; ?>
    </section>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobcy/////widgets/newsletter/templates/frontend.blade.php ENDPATH**/ ?>