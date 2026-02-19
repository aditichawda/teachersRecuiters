
<style>
.pp-section {
    padding: 100px 0 60px;
    background: #fff;
}
.pp-header {
    text-align: center;
    margin-bottom: 45px;
}
.pp-header h1 {
    font-size: 32px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 10px;
}
.pp-header p {
    font-size: 14px;
    color: #94a3b8;
}
.pp-content {
    /* max-width: 800px; */
    margin: 0 auto;
}
.pp-content h2 {
    font-size: 20px;
    font-weight: 600;
    color: #1e293b;
    margin: 35px 0 12px;
    padding-bottom: 8px;
    border-bottom: 1px solid #f1f5f9;
}
.pp-content h2:first-of-type {
    margin-top: 0;
}
.pp-content h3 {
    font-size: 17px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 10px;
}
.pp-content p {
    font-size: 15px;
    color: #475569;
    line-height: 1.8;
    margin-bottom: 12px;
}
.pp-content ul {
    padding-left: 20px;
    margin-bottom: 15px;
}
.pp-content ul li {
    font-size: 15px;
    color: #475569;
    line-height: 1.8;
    margin-bottom: 5px;
}
.pp-content .pp-contact {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 25px 30px;
    margin-top: 35px;
}
.pp-content .pp-contact h3 {
    font-size: 17px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 10px;
}
.pp-content .pp-contact p {
    margin-bottom: 5px;
}
@media(max-width: 768px) {
    .pp-section { padding: 80px 15px 40px; }
    .pp-header { margin-bottom: 30px; }
    .pp-header h1 { font-size: 24px; }
    .pp-content h2 { font-size: 17px; margin: 25px 0 10px; }
    .pp-content p, .pp-content ul li { font-size: 14px; line-height: 1.7; }
    .pp-content .pp-contact { padding: 20px; }
    .pp-content .pp-contact h3 { font-size: 15px; }
}
@media(max-width: 480px) {
    .pp-section { padding: 70px 10px 30px; }
    .pp-header h1 { font-size: 22px; }
    .pp-content h2 { font-size: 16px; }
    .pp-content p, .pp-content ul li { font-size: 13px; }
    .pp-content ul { padding-left: 16px; }
    .pp-content .pp-contact { padding: 15px; }
}
</style>

<section class="pp-section">
    <div class="container">
        <div class="pp-header">
            <h1><?php echo e($page->name ?? 'Privacy Policy'); ?></h1>
            <?php if($page->getMetaData('subtitle', true)): ?>
                <p><?php echo e($page->getMetaData('subtitle', true)); ?></p>
            <?php else: ?>
                <p>Last Updated: <?php echo e($page->updated_at ? $page->updated_at->format('F d, Y') : 'February 10, 2026'); ?></p>
            <?php endif; ?>
        </div>

        <div class="pp-content">
            <?php echo BaseHelper::clean($page->content); ?>

        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/privacy-layout.blade.php ENDPATH**/ ?>