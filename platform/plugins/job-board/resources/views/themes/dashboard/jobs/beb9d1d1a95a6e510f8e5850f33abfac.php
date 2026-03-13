<?php
    Theme::set('header_css_class', '');
    Theme::set('withPageHeader', false);
    Theme::set('bodyClass', 'hide-page-banner premium-service-page');
?>

<style>
.premium-service-section {
    padding: 90px 0 50px;
    background: linear-gradient(135deg, #ffffff 0%, var(--primary-color, #1967d2) 100%);
    color: #1e293b;
}
.premium-service-section .container {
    max-width: 1200px;
    padding: 0 15px;
}
.premium-header {
    text-align: center;
    margin-bottom: 40px;
}
.premium-header h1 {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 12px;
    color: #1e293b;
}
.premium-header p {
    font-size: 18px;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
}
.premium-features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}
.premium-feature-card {
    background: #fff;
    border-radius: 15px;
    padding: 25px 20px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.premium-feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}
.premium-feature-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, var(--primary-color, #1967d2) 0%, #005bb5 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    color: #fff;
}
.premium-feature-card h3 {
    font-size: 22px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 12px;
}
.premium-feature-card p {
    font-size: 15px;
    color: #64748b;
    line-height: 1.6;
}
.premium-pricing {
    background: #fff;
    border-radius: 20px;
    padding: 35px 25px;
    max-width: 1000px;
    margin: 0 auto;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}
.premium-pricing h2 {
    text-align: center;
    font-size: 32px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 30px;
}
.pricing-plans {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}
.pricing-plan {
    border: 2px solid #e2e8f0;
    border-radius: 15px;
    padding: 25px 20px;
    text-align: center;
    transition: all 0.3s ease;
}
.pricing-plan:hover {
    border-color: var(--primary-color, #1967d2);
    transform: translateY(-5px);
}
.pricing-plan.featured {
    border-color: var(--primary-color, #1967d2);
    background: linear-gradient(135deg, var(--primary-color, #1967d2) 0%, #005bb5 100%);
    color: #fff;
}
.pricing-plan h3 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #1e293b;
}
.pricing-plan.featured h3 {
    color: #fff;
}
.pricing-amount {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 5px;
    color: #1e293b;
}
.pricing-plan.featured .pricing-amount {
    color: #fff;
}
.pricing-period {
    font-size: 14px;
    color: #64748b;
    margin-bottom: 25px;
}
.pricing-plan.featured .pricing-period {
    color: rgba(255, 255, 255, 0.9);
}
.pricing-features {
    list-style: none;
    padding: 0;
    margin: 0 0 25px;
    text-align: left;
}
.pricing-features li {
    padding: 10px 0;
    font-size: 14px;
    color: #475569;
    border-bottom: 1px solid #f1f5f9;
}
.pricing-plan.featured .pricing-features li {
    color: rgba(255, 255, 255, 0.9);
    border-bottom-color: rgba(255, 255, 255, 0.2);
}
.pricing-features li:before {
    content: "✓";
    color: #10b981;
    font-weight: bold;
    margin-right: 10px;
}
.pricing-plan.featured .pricing-features li:before {
    color: #fff;
}
.pricing-btn {
    display: inline-block;
    padding: 12px 30px;
    background: var(--primary-color, #1967d2);
    color: #fff;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid var(--primary-color, #1967d2);
}
.pricing-btn:hover {
    background: transparent;
    color: var(--primary-color, #1967d2);
}
.pricing-plan.featured .pricing-btn {
    background: #fff;
    color: var(--primary-color, #1967d2);
    border-color: #fff;
}
.pricing-plan.featured .pricing-btn:hover {
    background: transparent;
    color: #fff;
}
@media(max-width: 768px) {
    .premium-service-section { padding: 70px 0 40px; }
    .premium-service-section .container { padding: 0 15px; }
    .premium-header { margin-bottom: 30px; }
    .premium-header h1 { font-size: 28px; }
    .premium-header p { font-size: 16px; }
    .premium-features { grid-template-columns: 1fr; gap: 15px; margin-bottom: 30px; }
    .premium-feature-card { padding: 20px 15px; }
    .premium-pricing { padding: 25px 15px; }
    .pricing-plans { grid-template-columns: 1fr; gap: 15px; }
    .pricing-plan { padding: 20px 15px; }
}
</style>

<section class="premium-service-section">
    <div class="container">
        <div class="premium-header">
            <h1><?php echo e(__('Premium Service')); ?></h1>
            <p><?php echo e(__('Unlock exclusive features and get priority access to the best job opportunities')); ?></p>
        </div>

        <div class="premium-features">
            <div class="premium-feature-card">
                <div class="premium-feature-icon">
                    <i class="feather-zap"></i>
                </div>
                <h3><?php echo e(__('Priority Job Access')); ?></h3>
                <p><?php echo e(__('Get first access to new job postings before they go public. Apply early and increase your chances.')); ?></p>
            </div>

            <div class="premium-feature-card">
                <div class="premium-feature-icon">
                    <i class="feather-star"></i>
                </div>
                <h3><?php echo e(__('Featured Profile')); ?></h3>
                <p><?php echo e(__('Your profile will be highlighted to employers, making you stand out from other candidates.')); ?></p>
            </div>

            <div class="premium-feature-card">
                <div class="premium-feature-icon">
                    <i class="feather-bell"></i>
                </div>
                <h3><?php echo e(__('Job Alerts')); ?></h3>
                <p><?php echo e(__('Receive instant notifications about jobs matching your preferences and skills.')); ?></p>
            </div>

            <div class="premium-feature-card">
                <div class="premium-feature-icon">
                    <i class="feather-file-text"></i>
                </div>
                <h3><?php echo e(__('Resume Builder')); ?></h3>
                <p><?php echo e(__('Access professional resume templates and tools to create an impressive CV.')); ?></p>
            </div>

            <div class="premium-feature-card">
                <div class="premium-feature-icon">
                    <i class="feather-users"></i>
                </div>
                <h3><?php echo e(__('Career Coaching')); ?></h3>
                <p><?php echo e(__('Get expert advice and guidance from career coaches to advance your career.')); ?></p>
            </div>

            <div class="premium-feature-card">
                <div class="premium-feature-icon">
                    <i class="feather-shield"></i>
                </div>
                <h3><?php echo e(__('Verified Badge')); ?></h3>
                <p><?php echo e(__('Get a verified badge on your profile to show employers you\'re a trusted professional.')); ?></p>
            </div>
        </div>

        <div class="premium-pricing">
            <h2><?php echo e(__('Choose Your Plan')); ?></h2>
            <div class="pricing-plans">
                <?php $__empty_1 = true; $__currentLoopData = $packages ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="pricing-plan <?php echo e($plan->is_default ? 'featured' : ''); ?>">
                        <h3><?php echo e($plan->name); ?></h3>
                        <div class="pricing-amount">
                            <?php if((float)($plan->price ?? 0) == 0): ?>
                                <?php echo e(__('Free')); ?>

                            <?php else: ?>
                                <?php echo e($plan->price_text); ?>

                            <?php endif; ?>
                            <?php if($plan->validity_days): ?>
                                <span style="font-size: 18px;">/<?php echo e($plan->validity_days); ?> <?php echo e(__('days')); ?></span>
                            <?php else: ?>
                                <span style="font-size: 18px;"> · <?php echo e(__('Unlimited validity')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="pricing-period"><?php echo e($plan->description ?: __('Choose this plan')); ?></div>
                        <ul class="pricing-features">
                            <?php if(($packageType ?? '') === 'employer'): ?>
                                <?php if(isset($plan->number_of_listings) && $plan->number_of_listings !== null && $plan->number_of_listings !== ''): ?>
                                    <li><?php echo e($plan->number_of_listings); ?> <?php echo e(__('Job Postings')); ?></li>
                                <?php endif; ?>
                                <?php if(isset($plan->profile_views_allowed) && $plan->profile_views_allowed !== null && $plan->profile_views_allowed !== ''): ?>
                                    <li><?php echo e(__('Database Access')); ?> <?php echo e($plan->profile_views_allowed); ?> <?php echo e(__('Profile Views')); ?></li>
                                <?php endif; ?>
                                <?php if(!empty($plan->credits_included)): ?>
                                    <li><?php echo e($plan->credits_included); ?> <?php echo e(trans('plugins/job-board::dashboard.credits')); ?> <?php echo e(__('included')); ?></li>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php $__currentLoopData = $plan->formatted_features ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $featureText = is_string($feature) ? $feature : ($feature['text'] ?? $feature['title'] ?? $feature['value'] ?? $feature['key'] ?? ''); ?>
                                <?php if($featureText !== ''): ?>
                                    <li><?php echo e($featureText); ?></li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <a href="<?php echo e(route('public.account.package.subscribe.checkout', ['id' => $plan->id])); ?>" class="pricing-btn"><?php echo e(__('Get Started')); ?></a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12 text-center py-4">
                        <p class="text-muted mb-0"><?php echo e(($packageType ?? 'job-seeker') === 'employer' ? __('No employer plans available at the moment. Please check back later.') : __('No job seeker plans available at the moment. Please check back later.')); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/premium-service.blade.php ENDPATH**/ ?>