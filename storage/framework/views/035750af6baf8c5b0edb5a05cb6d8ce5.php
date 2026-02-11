<div class="section-full twm-contact-one">
    <div class="section-content">
        <div class="container">

            <!-- CONTACT FORM-->
            <div class="contact-one-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="contact-form-outer">
                            <div class="section-head left wt-small-separator-outer">
                                <h2 class="wt-title"><?php echo BaseHelper::clean($shortcode->title); ?></h2>
                                <p><?php echo BaseHelper::clean($shortcode->subtitle); ?></p>
                            </div>

                            <?php echo Form::open(['route' => 'public.send.contact', 'class' => 'contact-form cons-contact-form']); ?>

                                <?php echo apply_filters('pre_contact_form', null); ?>

                                <span id="error-msg"></span>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" name="name" id="contact-name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php endif; ?>"
                                                placeholder="<?php echo e(__('Enter your name')); ?>" required>
                                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback">
                                                    <?php echo e($errors->first('name')); ?>

                                                </div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-3">
                                            <input name="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php endif; ?>" required
                                                placeholder="<?php echo e(__('Enter your email')); ?>">
                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback">
                                                    <?php echo e($errors->first('email')); ?>

                                                </div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-3">
                                            <input name="phone" type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php endif; ?>" required
                                                placeholder="<?php echo e(__('Enter your phone')); ?>">
                                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback">
                                                    <?php echo e($errors->first('phone')); ?>

                                                </div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control" id="contact-subject <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php endif; ?>" name="subject"
                                                placeholder="<?php echo e(__('Enter your subject')); ?>">
                                            <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback">
                                                    <?php echo e($errors->first('subject')); ?>

                                                </div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group mb-3">
                                            <textarea class="form-control <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php endif; ?>" placeholder="<?php echo e(__('Enter your message')); ?>" name="content" id="contact-content" rows="3"></textarea>
                                            <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback">
                                                    <?php echo e($errors->first('content')); ?>

                                                </div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <?php if(is_plugin_active('captcha')): ?>
                                        <?php if(setting('enable_captcha')): ?>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <?php echo Captcha::display(); ?>

                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(setting('enable_math_captcha_for_contact_form', 0)): ?>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="math-group"><?php echo e(app('math-captcha')->label()); ?></label>
                                                    <?php echo app('math-captcha')->input(['class' => 'form-control', 'id' => 'math-group', 'placeholder' => app('math-captcha')->getMathLabelOnly() . ' = ?']); ?>

                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="col-md-12">
                                        <button type="submit" class="site-button"><?php echo e(__('Submit Now')); ?></button>
                                    </div>
                                </div>

                                <?php echo apply_filters('after_contact_form', null); ?>


                                <div class="col-12">
                                    <div class="contact-form-group mt-4">
                                        <div class="contact-message contact-success-message" style="display: none"></div>
                                        <div class="contact-message contact-error-message" style="display: none"></div>
                                    </div>
                                </div>
                            <?php echo Form::close(); ?>

                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="contact-info-wrap">
                            <div class="contact-info">
                                <div class="contact-info-section">

                                    <?php if($shortcode->address_1): ?>
                                        <div class="c-info-column">
                                            <div class="c-info-icon">
                                                <i class=" fas fa-map-marker-alt"></i>
                                            </div>
                                            <h3 class="twm-title"><?php echo e($shortcode->address_title ?: __('Address')); ?></h3>
                                            <p><?php echo e($shortcode->address_1); ?></p>
                                            <?php if($shortcode->address_2): ?>
                                                <p><?php echo e($shortcode->address_2); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($shortcode->phone_1): ?>
                                        <div class="c-info-column">
                                            <div class="c-info-icon custome-size">
                                                <i class="fas fa-mobile-alt"></i>
                                            </div>
                                            <h3 class="twm-title"><?php echo e($shortcode->phone_title ?: __('Feel free to contact us')); ?></h3>
                                            <p><a href="tel:<?php echo e($shortcode->phone_1); ?>" dir="ltr"><?php echo e($shortcode->phone_1); ?></a></p>
                                            <?php if($shortcode->phone_2): ?>
                                                <p><a href="tel:<?php echo e($shortcode->phone_2); ?>" dir="ltr"><?php echo e($shortcode->phone_2); ?></a></p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($shortcode->email_1): ?>
                                        <div class="c-info-column">
                                            <div class="c-info-icon">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <h3 class="twm-title"><?php echo e($shortcode->email_title ?: __('Support')); ?></h3>
                                            <p><a href="tel:<?php echo e($shortcode->email_1); ?>"><?php echo e($shortcode->email_1); ?></a></p>
                                            <?php if($shortcode->email_2): ?>
                                                <p><a href="tel:<?php echo e($shortcode->email_2); ?>"><?php echo e($shortcode->email_2); ?></a></p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/shortcodes/contact/form.blade.php ENDPATH**/ ?>