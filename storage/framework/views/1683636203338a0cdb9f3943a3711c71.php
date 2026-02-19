
<style>
/* ===== Blog Page Styles ===== */
.blog-hero {
    padding: 120px 0 60px;
    background: linear-gradient(180deg, #f0f9ff 0%, #e0f2fe 30%, #bae6fd 60%, #38bdf8 100%);
    position: relative;
    overflow: hidden;
    text-align: center;
}
.blog-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(14,165,233,0.1) 0%, transparent 70%);
    border-radius: 50%;
}
.blog-hero::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(99,102,241,0.08) 0%, transparent 70%);
    border-radius: 50%;
}
.blog-hero h1 {
    font-size: 42px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 15px;
    position: relative;
    z-index: 1;
    letter-spacing: -0.5px;
}
.blog-hero p {
    font-size: 17px;
    color: #334155;
    max-width: 550px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
    line-height: 1.7;
}
.blog-hero .hero-badge {
    display: inline-block;
    background: rgba(14,165,233,0.12);
    border: 1px solid rgba(14,165,233,0.25);
    color: #0369a1;
    font-size: 13px;
    font-weight: 600;
    padding: 6px 18px;
    border-radius: 50px;
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
    letter-spacing: 1px;
    text-transform: uppercase;
}

/* Blog Grid Section */
.blog-grid-section {
    padding: 70px 0 80px;
    background: #f8fafc;
}

/* Blog Cards Grid */
.blog-cards-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

/* Blog Card */
.blog-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    display: flex;
    flex-direction: column;
}
.blog-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}

/* Card Image */
.blog-card-img {
    position: relative;
    overflow: hidden;
    height: 220px;
}
.blog-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}
.blog-card:hover .blog-card-img img {
    transform: scale(1.08);
}
.blog-card-img .img-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(180deg, transparent 40%, rgba(0,0,0,0.5) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
}
.blog-card:hover .img-overlay {
    opacity: 1;
}

/* Date Badge */
.blog-card-date {
    position: absolute;
    top: 15px;
    left: 15px;
    background: #0ea5e9;
    color: #fff;
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    z-index: 2;
    letter-spacing: 0.3px;
}

/* Category Badge */
.blog-card-category {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255,255,255,0.92);
    color: #1e293b;
    padding: 5px 12px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    z-index: 2;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Card Body */
.blog-card-body {
    padding: 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.blog-card-meta {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 12px;
}
.blog-card-meta .author-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0ea5e9, #6366f1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    flex-shrink: 0;
}
.blog-card-meta .author-name {
    font-size: 13px;
    color: #64748b;
    font-weight: 500;
}
.blog-card-title {
    font-size: 18px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 10px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.blog-card-title a {
    color: #1e293b;
    text-decoration: none;
    transition: color 0.3s;
}
.blog-card-title a:hover {
    color: #0ea5e9;
}
.blog-card-excerpt {
    font-size: 14px;
    color: #64748b;
    line-height: 1.7;
    margin-bottom: 20px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex: 1;
}

/* Read More Link */
.blog-card-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 600;
    color: #0ea5e9;
    text-decoration: none;
    transition: all 0.3s;
}
.blog-card-link:hover {
    color: #0284c7;
    gap: 12px;
}
.blog-card-link svg {
    width: 16px;
    height: 16px;
    transition: transform 0.3s;
}
.blog-card-link:hover svg {
    transform: translateX(3px);
}

/* Featured Post (first post) */
.blog-featured {
    grid-column: 1 / -1;
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    border-radius: 20px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
}
.blog-featured:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.14);
}
.blog-featured .blog-card-img {
    height: 100%;
    min-height: 350px;
}
.blog-featured .blog-card-body {
    padding: 40px;
    justify-content: center;
}
.blog-featured .blog-card-title {
    font-size: 26px;
    -webkit-line-clamp: 3;
}
.blog-featured .blog-card-excerpt {
    font-size: 15px;
    -webkit-line-clamp: 4;
}
.blog-featured .featured-label {
    display: inline-block;
    background: linear-gradient(135deg, #0ea5e9, #6366f1);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 14px;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 15px;
}

/* Blog Pagination */
.blog-pagination {
    text-align: center;
    margin-top: 50px;
}
.blog-pagination .pagination-outer {
    display: inline-block;
}
.blog-pagination .pagination {
    display: flex;
    gap: 8px;
    list-style: none;
    padding: 0;
    margin: 0;
    justify-content: center;
}
.blog-pagination .pagination li a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background: #fff;
    color: #475569;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    border: 1px solid #e2e8f0;
    transition: all 0.3s;
}
.blog-pagination .pagination li a:hover {
    background: #0ea5e9;
    color: #fff;
    border-color: #0ea5e9;
}
.blog-pagination .pagination li.active a {
    background: #0ea5e9;
    color: #fff;
    border-color: #0ea5e9;
    box-shadow: 0 4px 12px rgba(14,165,233,0.3);
}
.blog-pagination .pagination li.disabled a {
    opacity: 0.4;
    cursor: not-allowed;
}

/* No Posts */
.blog-no-posts {
    text-align: center;
    padding: 80px 20px;
    grid-column: 1 / -1;
}
.blog-no-posts svg {
    width: 80px;
    height: 80px;
    color: #cbd5e1;
    margin-bottom: 20px;
}
.blog-no-posts h3 {
    font-size: 22px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 8px;
}
.blog-no-posts p {
    font-size: 15px;
    color: #94a3b8;
}

/* Responsive */
@media (max-width: 1024px) {
    .blog-cards-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
    }
    .blog-featured {
        grid-template-columns: 1fr;
    }
    .blog-featured .blog-card-img {
        min-height: 260px;
    }
    .blog-featured .blog-card-body {
        padding: 28px;
    }
    .blog-featured .blog-card-title {
        font-size: 22px;
    }
}
@media (max-width: 767px) {
    .blog-hero {
        padding: 90px 0 40px;
    }
    .blog-hero h1 {
        font-size: 28px;
    }
    .blog-hero p {
        font-size: 14px;
    }
    .blog-grid-section {
        padding: 40px 0 50px;
    }
    .blog-cards-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    .blog-card-img {
        height: 200px;
    }
    .blog-card-body {
        padding: 18px;
    }
    .blog-card-title {
        font-size: 16px;
    }
    .blog-featured .blog-card-img {
        min-height: 200px;
    }
    .blog-featured .blog-card-body {
        padding: 22px;
    }
    .blog-featured .blog-card-title {
        font-size: 20px;
    }
    .blog-pagination .pagination li a {
        width: 36px;
        height: 36px;
        font-size: 13px;
    }
}
</style>


<section class="blog-hero">
    <div class="container">
        <span class="hero-badge">📝 Our Blog</span>
        <h1>Insights & Resources</h1>
        <p>Stay updated with the latest tips, trends and news in education recruitment and career development.</p>
    </div>
</section>


<section class="blog-grid-section">
    <div class="container">
        <?php if($posts->count() > 0): ?>
            <div class="blog-cards-grid">
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($index === 0 && $posts->currentPage() === 1): ?>
                        
                        <article class="blog-card blog-featured">
                            <div class="blog-card-img">
                                <a href="<?php echo e($post->url); ?>">
                                    <img src="<?php echo e(RvMedia::getImageUrl($post->image, null, false, RvMedia::getDefaultImage())); ?>" alt="<?php echo e($post->name); ?>">
                                    <div class="img-overlay"></div>
                                </a>
                                <span class="blog-card-date"><?php echo e(Theme::formatDate($post->created_at)); ?></span>
                                <?php if($post->categories->count()): ?>
                                    <span class="blog-card-category"><?php echo e($post->categories->first()->name); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="blog-card-body">
                                <span class="featured-label">⭐ Featured</span>
                                <div class="blog-card-meta">
                                    <span class="author-avatar"><?php echo e(strtoupper(substr($post->author->name ?? 'A', 0, 1))); ?></span>
                                    <span class="author-name"><?php echo e($post->author->name ?? 'Admin'); ?></span>
                                </div>
                                <h2 class="blog-card-title">
                                    <a href="<?php echo e($post->url); ?>"><?php echo BaseHelper::clean($post->name); ?></a>
                                </h2>
                                <p class="blog-card-excerpt"><?php echo Str::limit(BaseHelper::clean($post->description), 200); ?></p>
                                <a href="<?php echo e($post->url); ?>" class="blog-card-link">
                                    Read Full Article
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                                </a>
                            </div>
                        </article>
                    <?php else: ?>
                        
                        <article class="blog-card">
                            <div class="blog-card-img">
                                <a href="<?php echo e($post->url); ?>">
                                    <img src="<?php echo e(RvMedia::getImageUrl($post->image, null, false, RvMedia::getDefaultImage())); ?>" alt="<?php echo e($post->name); ?>">
                                    <div class="img-overlay"></div>
                                </a>
                                <span class="blog-card-date"><?php echo e(Theme::formatDate($post->created_at)); ?></span>
                                <?php if($post->categories->count()): ?>
                                    <span class="blog-card-category"><?php echo e($post->categories->first()->name); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="blog-card-body">
                                <div class="blog-card-meta">
                                    <span class="author-avatar"><?php echo e(strtoupper(substr($post->author->name ?? 'A', 0, 1))); ?></span>
                                    <span class="author-name"><?php echo e($post->author->name ?? 'Admin'); ?></span>
                                </div>
                                <h3 class="blog-card-title">
                                    <a href="<?php echo e($post->url); ?>"><?php echo BaseHelper::clean($post->name); ?></a>
                                </h3>
                                <p class="blog-card-excerpt"><?php echo Str::limit(BaseHelper::clean($post->description), 120); ?></p>
                                <a href="<?php echo e($post->url); ?>" class="blog-card-link">
                                    Read More
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                                </a>
                            </div>
                        </article>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="blog-pagination">
<?php echo $posts->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')); ?>

            </div>
        <?php else: ?>
            <div class="blog-cards-grid">
                <div class="blog-no-posts">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" /></svg>
                    <h3>No Posts Yet</h3>
                    <p>Check back soon for the latest articles and insights.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/loop.blade.php ENDPATH**/ ?>