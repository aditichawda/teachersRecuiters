<?php if($paginator->hasPages()): ?>
    <div class="pagination-outer">
        <div class="pagination-style1">
            <ul class="clearfix pagination">
                <?php if($paginator->onFirstPage()): ?>
                    <li class="prev disabled">
                        <a href="javascript:;" class="disabled">
                            <span>
                                <i class="fa fa-angle-left"></i>
                            </span>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="prev">
                        <a href="<?php echo e($paginator->previousPageUrl()); ?>">
                            <span>
                                <i class="fa fa-angle-left"></i>
                            </span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php if(is_string($element)): ?>
                        <li class="disabled"><a href="javascript:;"><?php echo e($element); ?></a></li>
                    <?php endif; ?>

                    
                    <?php if(is_array($element)): ?>
                        <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($page == $paginator->currentPage()): ?>
                                <li class="active" aria-current="page">
                                    <a class="pagination-button" href="javascript:;" data-page="<?php echo e($page); ?>"><?php echo e($page); ?></a>
                                </li>
                            <?php else: ?>
                                <li><a class="pagination-button" href="<?php echo e($url); ?>" data-page="<?php echo e($page); ?>"><?php echo e($page); ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($paginator->hasMorePages()): ?>
                    <li class="next">
                        <a href="<?php echo e($paginator->nextPageUrl()); ?>">
                            <span>
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="next disabled">
                        <a href="javascript:;">
                            <span>
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/pagination.blade.php ENDPATH**/ ?>