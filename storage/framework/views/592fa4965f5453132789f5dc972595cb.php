<!-- HOW IT WORK SECTION START -->
<div class="section-full p-b30 twm-how-it-work-area2" style="background-color: aliceblue">

    
    <div class="section-head left wt-small-separator-outer text-center pt-5">
    <h2 class="wt-title d-flex justify-content-center">
            <?php echo BaseHelper::clean($shortcode->subtitle); ?>

        </h2>
        <div class="wt-small-separator site-text-primary d-flex justify-content-center">
            <div><?php echo BaseHelper::clean($shortcode->title); ?></div>
        </div>

    </div>

    
    <?php
        $checkList = $shortcode->check_list
            ? array_filter(explode(';', $shortcode->check_list))
            : [];
    ?>

    <?php if($checkList): ?>
        <ul class="description-list text-center">
            <?php $__currentLoopData = $checkList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <i class="feather-check"></i> <?php echo e($item); ?>

                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>

    <div class="container">

        <div class="col-12">
            
            
            <div class="col-lg-12 col-md-12">

                
                <div class="twm-w-process-steps-2-wrap">
                    <div class="row">
                        <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $rgbColor = Arr::get($tab, 'rgb_color');
                                $bgColor  = Arr::get($tab, 'bg_color');
                            ?>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                <div class="twm-w-process-steps-2">
                                    <div
                                        class="twm-w-pro-top shadow bg-opacity-50 <?php echo e(!$rgbColor ? 'bg-clr-sky-light' : ''); ?>"
                                        <?php if($bgColor): ?>
                                            style="background-color: <?php echo e($bgColor); ?>;"
                                        <?php endif; ?>
                                    >
                                        <span
                                            class="twm-large-number <?php echo e(!$bgColor ? 'text-clr-sky' : ''); ?>"
                                            <?php if($bgColor): ?>
                                                style="color: <?php echo e($bgColor); ?>;"
                                            <?php endif; ?>
                                        >
                                            <?php echo e($loop->iteration < 10 ? '0'.$loop->iteration : $loop->iteration); ?>

                                        </span>

                                        <div class="twm-media">
                                            <span>
                                                <img
                                                    src="<?php echo e(RvMedia::getImageUrl(
                                                        Arr::get($tab, 'image'),
                                                        null,
                                                        false,
                                                        RvMedia::getDefaultImage()
                                                    )); ?>"
                                                    alt="<?php echo e(Arr::get($tab, 'title')); ?>"
                                                >
                                            </span>
                                        </div>

                                        <h4 class="twm-title">
                                            <?php echo e(Arr::get($tab, 'title')); ?>

                                        </h4>

                                        <p>
                                            <?php echo e(Arr::get($tab, 'subtitle')); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                
                <div class="hiw-video-below-section">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10 col-12">
                            <div class="hiw-video-below-card">
                                <div class="hiw-video-below-inner">
                                    <iframe 
                                        src="https://www.youtube.com/embed/r4PevhrJA_A?si=oVH36shDIgdaL5D4" 
                                        title="Teachers Recruiter - How It Works" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <?php
                // Check if URL exists - also check from shortcode directly as fallback
                $hasVideo = false;
                $videoUrl = $url;
                
                // First check if $url variable is set
                if (!empty($url) && is_string($url)) {
                    $hasVideo = true;
                    $videoUrl = $url;
                }
                // Fallback: check directly from shortcode
                elseif (!empty($shortcode->youtube_url)) {
                    $youtubeUrl = trim($shortcode->youtube_url);
                    
                    // Process URL directly here
                    if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $youtubeUrl, $matches)) {
                        $videoUrl = 'https://www.youtube.com/embed/' . $matches[1];
                        $hasVideo = true;
                    } elseif (preg_match('/(?:youtube\.com\/watch\?v=|youtube\.com\/watch\?.*&v=)([a-zA-Z0-9_-]{11})/', $youtubeUrl, $matches)) {
                        $videoUrl = 'https://www.youtube.com/embed/' . $matches[1];
                        $hasVideo = true;
                    } elseif (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/', $youtubeUrl, $matches)) {
                        $videoUrl = 'https://www.youtube.com/embed/' . $matches[1];
                        $hasVideo = true;
                    } elseif (strpos($youtubeUrl, 'youtube.com/embed/') !== false) {
                        $videoUrl = $youtubeUrl;
                        $hasVideo = true;
                    }
                }
            ?>
            
            <?php if($hasVideo && !empty($videoUrl)): ?>
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                    <div
                        class="youtube-iframe"
                        style="<?php echo e((!$width && !$height) ? 'position:relative;display:block;height:0;padding-bottom:56.25%;overflow:hidden;' : 'margin-bottom:20px;'); ?>"
                    >
                        <iframe
                            src="<?php echo e($videoUrl); ?>"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            frameborder="0"
                            title="Video"
                            style="
                                <?php echo e((!$width && !$height) ? 'position:absolute;top:0;left:0;width:100%;height:100%;border:0;' : ''); ?>

                                <?php echo e($width ? 'width:'.$width.'px !important;' : ''); ?>

                                <?php echo e($height ? 'height:'.$height.'px !important;' : ''); ?>

                                max-width:100%;
                            "
                        ></iframe>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="twm-how-it-work-section"></div>

    </div>
</div>




<!-- HOW IT WORK SECTION START -->
<!-- <div class="section-full  p-b30 site-bg-white twm-how-it-work-area2">
<div class="section-head left wt-small-separator-outer">
                    <div class="wt-small-separator site-text-primary" style="
    text-align: center;
    justify-content: center;
    display: flex;
">
                        <div><?php echo BaseHelper::clean($shortcode->title); ?></div>
                    </div>
                    <h2 class="wt-title" style="
    text-align: center;
    justify-content: center;
    display: flex;
"><?php echo BaseHelper::clean($shortcode->subtitle); ?></h2>
                </div>
                <?php if($shortcode->check_list && $list = array_filter(explode(';', $shortcode->check_list))): ?>
                    <ul class="description-list">
                        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><i class="feather-check"></i><?php echo e($item); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
                <?php if(!empty($url)): ?>
    <div class="container">

        <div class="row">
            <div class="col-lg-3 col-md-12">
                
               
    <div
        class="youtube-iframe"
        <?php if(!$width && !$height): ?> style="position: relative; display: block; height: 0; padding-bottom: 56.25%; overflow: hidden;"
        <?php else: ?>
            style="margin-bottom: 20px;" <?php endif; ?>
    >
        <iframe
            src="<?php echo e($url); ?>"
            allowfullscreen
            frameborder="0"
            style="<?php echo \Illuminate\Support\Arr::toCssStyles([
                'position: absolute; top: 0; bottom: 0; left: 0; width: 100%; height: 100%; border: 0;' => !$width && !$height,
                "height: {$height}px !important;" => $height,
                "width: {$width}px !important;" => $width,
                'max-width: 100%',
            ]) ?>"
            title="Video"
        ></iframe>
    </div>
<?php endif; ?>

               
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="twm-w-process-steps-2-wrap">
                    <div class="row col-6">
                        <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="twm-w-process-steps-2">
                                    <div class="twm-w-pro-top shadow bg-opacity-50 <?php if(! Arr::get($tab, 'rgb_color')): ?> bg-clr-sky-light <?php endif; ?>"
                                        <?php if(Arr::get($tab, 'rgb_color')): ?> style="background-color: rgba(<?php echo e(Arr::get($tab, 'rgb_color')); ?>, var(--bs-bg-opacity))" <?php endif; ?>>
                                        <span class="twm-large-number <?php if(! Arr::get($tab, 'bg_color')): ?> text-clr-sky <?php endif; ?>" 
                                        <?php if(Arr::get($tab, 'rgb_color')): ?> style="color: <?php echo e(Arr::get($tab, 'bg_color')); ?>;" <?php endif; ?>><?php echo e($loop->iteration < 10 ? ('0' . $loop->iteration) : $loop->iteration); ?></span>
                                        <div class="twm-media">
                                            <span>
                                                <img src="<?php echo e(RvMedia::getImageUrl(Arr::get($tab, 'image'), null, false, RvMedia::getDefaultImage())); ?>" alt="<?php echo e(Arr::get($tab, 'title')); ?>">
                                            </span>
                                        </div>
                                        <h4 class="twm-title"><?php echo e(Arr::get($tab, 'title')); ?></h4>
                                        <p><?php echo e(Arr::get($tab, 'subtitle')); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="twm-how-it-work-section"></div>
    </div>
</div> --><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/shortcodes/how-it-works/style-2.blade.php ENDPATH**/ ?>