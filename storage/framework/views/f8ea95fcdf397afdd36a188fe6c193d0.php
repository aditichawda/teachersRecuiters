<?php
    Theme::set('pageCoverImage', theme_option('background_breadcrumb_default'));
    $categories = $post->categories;
    $tags = $post->tags;
?>

<style>
/* ===== Blog Post Detail Styles ===== */
.bp-hero {
    padding: 120px 0 50px;
    background: linear-gradient(180deg, #f0f9ff 0%, #e0f2fe 40%, #bae6fd 80%, #7dd3fc 100%);
    position: relative;
    overflow: hidden;
}
.bp-hero::before {
    content: '';
    position: absolute;
    top: -40%;
    right: -15%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(14,165,233,0.08) 0%, transparent 70%);
    border-radius: 50%;
}
.bp-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
}
.bp-breadcrumb a {
    font-size: 13px;
    color: #0369a1;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}
.bp-breadcrumb a:hover {
    color: #0284c7;
}
.bp-breadcrumb span {
    font-size: 13px;
    color: #64748b;
}
.bp-breadcrumb .bp-sep {
    color: #94a3b8;
    font-size: 11px;
}
.bp-hero-content {
    max-width: 800px;
    position: relative;
    z-index: 1;
}
.bp-categories {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 16px;
}
.bp-category-tag {
    display: inline-block;
    background: rgba(14,165,233,0.12);
    color: #0369a1;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 14px;
    border-radius: 50px;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s;
}
.bp-category-tag:hover {
    background: #0ea5e9;
    color: #fff;
    text-decoration: none;
}
.bp-hero h1 {
    font-size: 36px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.3;
    margin-bottom: 20px;
    letter-spacing: -0.5px;
}
.bp-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}
.bp-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #475569;
}
.bp-meta-item svg {
    width: 16px;
    height: 16px;
    color: #0ea5e9;
    flex-shrink: 0;
}
.bp-author-avatar {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0ea5e9, #6366f1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 14px;
    font-weight: 700;
    flex-shrink: 0;
}
.bp-meta-divider {
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: #cbd5e1;
}

/* Featured Image */
.bp-featured-img {
    margin-top: -30px;
    position: relative;
    z-index: 2;
}
.bp-featured-img .container {
    max-width: 900px;
}
.bp-featured-img img {
    width: 100%;
    height: 420px;
    object-fit: cover;
    border-radius: 16px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.12);
}

/* Content Area */
.bp-content-section {
    padding: 50px 0 60px;
    background: #fff;
}
.bp-content-wrapper {
    max-width: 800px;
    margin: 0 auto;
}

/* Post Description */
.bp-description {
    font-size: 18px;
    font-weight: 500;
    color: #334155;
    line-height: 1.8;
    margin-bottom: 30px;
    padding-bottom: 30px;
    border-bottom: 1px solid #f1f5f9;
}

/* Post Content Typography */
.bp-content .ck-content {
    font-size: 16px;
    color: #374151;
    line-height: 1.9;
}
.bp-content .ck-content h1,
.bp-content .ck-content h2 {
    font-size: 26px;
    font-weight: 700;
    color: #0f172a;
    margin: 35px 0 15px;
    line-height: 1.3;
}
.bp-content .ck-content h3 {
    font-size: 22px;
    font-weight: 600;
    color: #1e293b;
    margin: 30px 0 12px;
}
.bp-content .ck-content h4 {
    font-size: 18px;
    font-weight: 600;
    color: #1e293b;
    margin: 25px 0 10px;
}
.bp-content .ck-content p {
    margin-bottom: 18px;
}
.bp-content .ck-content ul,
.bp-content .ck-content ol {
    margin-bottom: 18px;
    padding-left: 24px;
}
.bp-content .ck-content li {
    margin-bottom: 8px;
}
.bp-content .ck-content blockquote {
    border-left: 4px solid #0ea5e9;
    background: #f0f9ff;
    padding: 20px 24px;
    margin: 25px 0;
    border-radius: 0 10px 10px 0;
    font-style: italic;
    color: #334155;
}
.bp-content .ck-content img {
    border-radius: 12px;
    margin: 20px 0;
    max-width: 100%;
    height: auto;
}
.bp-content .ck-content a {
    color: #0ea5e9;
    text-decoration: underline;
    text-underline-offset: 3px;
}
.bp-content .ck-content a:hover {
    color: #0284c7;
}

/* Tags Section */
.bp-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 35px;
    padding-top: 25px;
    border-top: 1px solid #f1f5f9;
}
.bp-tag {
    display: inline-block;
    background: #f1f5f9;
    color: #475569;
    font-size: 13px;
    font-weight: 500;
    padding: 5px 14px;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.3s;
}
.bp-tag:hover {
    background: #0ea5e9;
    color: #fff;
    text-decoration: none;
}

/* Share Section */
.bp-share {
    margin-top: 35px;
    padding: 25px 30px;
    background: #f8fafc;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
}
.bp-share h4 {
    font-size: 16px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 15px;
}
.bp-share-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.bp-share-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background: #fff;
    border: 1px solid #e2e8f0;
    color: #475569;
    font-size: 16px;
    text-decoration: none;
    transition: all 0.3s;
}
.bp-share-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    text-decoration: none;
}
.bp-share-btn.facebook:hover { background: #1877F2; color: #fff; border-color: #1877F2; }
.bp-share-btn.twitter:hover { background: #1DA1F2; color: #fff; border-color: #1DA1F2; }
.bp-share-btn.linkedin:hover { background: #0A66C2; color: #fff; border-color: #0A66C2; }
.bp-share-btn.whatsapp:hover { background: #25D366; color: #fff; border-color: #25D366; }
.bp-share-btn.copy-link:hover { background: #0ea5e9; color: #fff; border-color: #0ea5e9; }

/* Back to Blog */
.bp-back {
    margin-top: 35px;
    text-align: center;
}
.bp-back a {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 600;
    color: #0ea5e9;
    text-decoration: none;
    padding: 12px 28px;
    border: 2px solid #0ea5e9;
    border-radius: 50px;
    transition: all 0.3s;
}
.bp-back a:hover {
    background: #0ea5e9;
    color: #fff;
    text-decoration: none;
}
.bp-back a svg {
    width: 16px;
    height: 16px;
    transition: transform 0.3s;
}
.bp-back a:hover svg {
    transform: translateX(-3px);
}

/* Comment Area */
.bp-comments {
    margin-top: 40px;
}

/* Responsive */
@media (max-width: 767px) {
    .bp-hero {
        padding: 90px 0 40px;
    }
    .bp-hero h1 {
        font-size: 24px;
    }
    .bp-meta {
        gap: 12px;
    }
    .bp-meta-item {
        font-size: 13px;
    }
    .bp-featured-img img {
        height: 220px;
        border-radius: 12px;
    }
    .bp-content-section {
        padding: 30px 0 40px;
    }
    .bp-description {
        font-size: 16px;
    }
    .bp-content .ck-content {
        font-size: 15px;
    }
    .bp-content .ck-content h1,
    .bp-content .ck-content h2 {
        font-size: 22px;
    }
    .bp-content .ck-content h3 {
        font-size: 19px;
    }
    .bp-share {
        padding: 20px;
    }
}
</style>


<section class="bp-hero">
    <div class="container" style="max-width: 900px;">
        
        <div class="bp-breadcrumb">
            <a href="<?php echo e(BaseHelper::getHomepageUrl()); ?>">Home</a>
            <span class="bp-sep">›</span>
            <a href="<?php echo e(url('/blog')); ?>">Blog</a>
            <span class="bp-sep">›</span>
            <span><?php echo e(Str::limit($post->name, 40)); ?></span>
        </div>

        <div class="bp-hero-content">
            
            <?php if($categories && $categories->count()): ?>
                <div class="bp-categories">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($category->url); ?>" class="bp-category-tag"><?php echo e($category->name); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            
            <h1><?php echo BaseHelper::clean($post->name); ?></h1>

            
            <div class="bp-meta">
                <div class="bp-meta-item">
                    <span class="bp-author-avatar"><?php echo e(strtoupper(substr($post->author->name ?? 'A', 0, 1))); ?></span>
                    <span><?php echo e($post->author->name ?? 'Admin'); ?></span>
                </div>
                <div class="bp-meta-divider"></div>
                <div class="bp-meta-item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                    <span><?php echo e(Theme::formatDate($post->created_at)); ?></span>
                </div>
                <div class="bp-meta-divider"></div>
                <div class="bp-meta-item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span><?php echo e(ceil(str_word_count(strip_tags($post->content)) / 200)); ?> min read</span>
                </div>
            </div>
        </div>
    </div>
</section>


<?php if($post->image): ?>
    <div class="bp-featured-img">
        <div class="container" style="max-width: 900px;">
            <img src="<?php echo e(RvMedia::getImageUrl($post->image, null, false, RvMedia::getDefaultImage())); ?>" alt="<?php echo e($post->name); ?>">
        </div>
    </div>
<?php endif; ?>


<section class="bp-content-section">
    <div class="container">
        <div class="bp-content-wrapper">
            
            <?php if($post->description): ?>
                <div class="bp-description">
                    <?php echo BaseHelper::clean($post->description); ?>

                </div>
            <?php endif; ?>

            
            <div class="bp-content">
                <div class="ck-content">
                    <?php echo BaseHelper::clean($post->content); ?>

                </div>
            </div>

            
            <?php if($tags && $tags->count()): ?>
                <div class="bp-tags">
                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($tag->url); ?>" class="bp-tag">#<?php echo e($tag->name); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            
            <div class="bp-share">
                <h4>Share this article</h4>
                <div class="bp-share-buttons">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode($post->url)); ?>" target="_blank" rel="noopener" class="bp-share-btn facebook" title="Share on Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode($post->url)); ?>&text=<?php echo e(urlencode($post->name)); ?>" target="_blank" rel="noopener" class="bp-share-btn twitter" title="Share on Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo e(urlencode($post->url)); ?>&title=<?php echo e(urlencode($post->name)); ?>" target="_blank" rel="noopener" class="bp-share-btn linkedin" title="Share on LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?text=<?php echo e(urlencode($post->name . ' ' . $post->url)); ?>" target="_blank" rel="noopener" class="bp-share-btn whatsapp" title="Share on WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="javascript:void(0);" onclick="navigator.clipboard.writeText('<?php echo e($post->url); ?>');this.title='Copied!';setTimeout(()=>this.title='Copy Link',2000);" class="bp-share-btn copy-link" title="Copy Link">
                        <i class="fas fa-link"></i>
                    </a>
                </div>
            </div>

            
            <div class="bp-back">
                <a href="<?php echo e(url('/blog')); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                    Back to Blog
                </a>
            </div>

            
            <div class="bp-comments">
                <?php echo apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $post); ?>

            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/post.blade.php ENDPATH**/ ?>