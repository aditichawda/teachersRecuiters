<?php
    use Botble\Base\Facades\BaseHelper;
    use Botble\Faq\Models\FaqCategory;
    
    Theme::set('header_css_class', '');
    Theme::set('withPageHeader', false);
    Theme::set('bodyClass', 'hide-page-banner faq-page');
    
    $categories = FaqCategory::where('status', 'published')
        ->orderBy('order')
        ->with(['faqs' => function($q) { 
            $q->where('status', 'published')->orderBy('id'); 
        }])
        ->get();
?>

<style>
.faq-section {
    padding: 90px 0 50px;
    background: #fff;
}
.faq-section .container {
    max-width: 1000px;
    padding: 0 15px;
}
.faq-header {
    text-align: center;
    margin-bottom: 30px;
}
.faq-header h1 {
    font-size: 32px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 8px;
}
.faq-header p {
    font-size: 15px;
    color: #94a3b8;
    max-width: 500px;
    margin: 0 auto;
}
.faq-tabs {
    display: flex;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 25px;
}
.faq-tab-btn {
    padding: 10px 24px;
    border: 1px solid #e2e8f0;
    background: #fff;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 500;
    color: #64748b;
    cursor: pointer;
    transition: all .25s ease;
}
.faq-tab-btn:hover {
    border-color: var(--primary-color, #1967d2);
    color: var(--primary-color, #1967d2);
}
.faq-tab-btn.active {
    background: var(--primary-color, #1967d2);
    border-color: var(--primary-color, #1967d2);
    color: #fff;
}
.faq-list {
    max-width: 800px;
    margin: 0 auto;
}
.faq-item {
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    margin-bottom: 12px;
    overflow: hidden;
    transition: all .25s;
}
.faq-item:hover {
    border-color: #cbd5e1;
}
.faq-question {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 22px;
    background: #fff;
    border: none;
    cursor: pointer;
    text-align: left;
    font-size: 15px;
    font-weight: 600;
    color: #1e293b;
    gap: 15px;
    transition: all .2s;
}
.faq-question:hover {
    background: #f8fafc;
}
.faq-question .faq-icon {
    flex-shrink: 0;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    color: #64748b;
    transition: all .3s;
}
.faq-question:not(.collapsed) .faq-icon {
    background: var(--primary-color, #1967d2);
    color: #fff;
    transform: rotate(45deg);
}
.faq-answer {
    padding: 0 20px 15px;
    font-size: 14px;
    color: #475569;
    line-height: 1.8;
}
.faq-contact {
    text-align: center;
    margin-top: 35px;
    padding: 25px 20px;
    background: #f8fafc;
    border-radius: 12px;
    max-width: 900px;
    margin-left: auto;
    margin-right: auto;
}
.faq-contact h3 {
    font-size: 18px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 8px;
}
.faq-contact p {
    font-size: 14px;
    color: #64748b;
    margin-bottom: 15px;
}
.faq-contact a {
    display: inline-block;
    padding: 10px 28px;
    background: var(--primary-color, #1967d2);
    color: #fff;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all .25s;
}
.faq-contact a:hover {
    opacity: .9;
    transform: translateY(-2px);
    color: #fff;
}
@media(max-width: 768px) {
    .faq-section { padding: 70px 0 40px; }
    .faq-section .container { padding: 0 15px; }
    .faq-header { margin-bottom: 25px; }
    .faq-header h1 { font-size: 24px; }
    .faq-header p { font-size: 13px; }
    .faq-tabs { gap: 8px; margin-bottom: 20px; }
    .faq-tab-btn { padding: 8px 16px; font-size: 13px; }
    .faq-question { padding: 12px 15px; font-size: 14px; }
    .faq-answer { padding: 0 15px 12px; font-size: 13px; }
    .faq-contact { padding: 20px 15px; margin-top: 30px; }
    .faq-contact h3 { font-size: 16px; }
    .faq-contact p { font-size: 13px; }
}
</style>

<section class="faq-section">
    <div class="container">
        <div class="faq-header">
            <h1><?php echo e(__('Frequently Asked Questions')); ?></h1>
            <p><?php echo e(__('Find answers to common questions about Teachers Recruiter')); ?></p>
        </div>

        <?php if($categories->count()): ?>
            <div class="faq-tabs">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button class="faq-tab-btn <?php echo e($loop->first ? 'active' : ''); ?>" 
                        data-target="faq-cat-<?php echo e($category->id); ?>">
                        <?php echo e($category->name); ?>

                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="faq-list">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="faq-cat-content <?php echo e($loop->first ? '' : 'd-none'); ?>" id="faq-cat-<?php echo e($category->id); ?>">
                        <div class="accordion" id="faq-accordion-<?php echo e($category->id); ?>">
                            <?php $__currentLoopData = $category->faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="faq-item">
                                    <button class="faq-question <?php echo e($loop->first ? '' : 'collapsed'); ?>" 
                                        type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#faq-a-<?php echo e($category->id); ?>-<?php echo e($loop->iteration); ?>"
                                        aria-expanded="<?php echo e($loop->first ? 'true' : 'false'); ?>">
                                        <span><?php echo e($faq->question); ?></span>
                                        <span class="faq-icon">+</span>
                                    </button>
                                    <div id="faq-a-<?php echo e($category->id); ?>-<?php echo e($loop->iteration); ?>" 
                                        class="collapse <?php echo e($loop->first ? 'show' : ''); ?>"
                                        data-bs-parent="#faq-accordion-<?php echo e($category->id); ?>">
                                        <div class="faq-answer">
                                            <?php echo BaseHelper::clean($faq->answer); ?>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="text-center" style="padding: 40px 0;">
                <p style="color: #94a3b8;"><?php echo e(__('No FAQs available at the moment.')); ?></p>
            </div>
        <?php endif; ?>

        <div class="faq-contact">
            <h3><?php echo e(__('Still have questions?')); ?></h3>
            <p><?php echo e(__('Can\'t find what you\'re looking for? Feel free to reach out to our support team.')); ?></p>
            <a href="<?php echo e(url('/contact')); ?>"><?php echo e(__('Contact Us')); ?></a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.faq-tab-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.faq-tab-btn').forEach(function(b) { b.classList.remove('active'); });
            this.classList.add('active');
            document.querySelectorAll('.faq-cat-content').forEach(function(c) { c.classList.add('d-none'); });
            document.getElementById(this.getAttribute('data-target')).classList.remove('d-none');
        });
    });
});
</script>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/faq.blade.php ENDPATH**/ ?>