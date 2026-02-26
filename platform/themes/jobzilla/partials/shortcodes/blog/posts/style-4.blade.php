<style>
/* Recommended Blogs Section - Modern Carousel Design */
.recommended-blogs-section {
    padding: 80px 0;
    background: #ffffff;
}

.recommended-blogs-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.recommended-blogs-title {
    font-size: 2rem;
    font-weight: 800;
    color: #1e293b;
    margin: 0;
}

.recommended-blogs-view-all {
    background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
    color: #ffffff;
    padding: 0.75rem 2rem;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    border: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
}

.recommended-blogs-view-all:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
    color: #ffffff;
    text-decoration: none;
}

.blog-filters {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    border-bottom: 2px solid #e5e7eb;
    padding-bottom: 1rem;
}

.blog-filter-btn {
    background: transparent;
    border: none;
    color: #64748b;
    font-size: 0.95rem;
    font-weight: 500;
    padding: 0.5rem 0;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    border-bottom: 2px solid transparent;
    margin-bottom: -1rem;
}

.blog-filter-btn:hover {
    color: #2563eb;
}

.blog-filter-btn.active {
    color: #2563eb;
    border-bottom-color: #2563eb;
}

.blog-cards-carousel {
    position: relative;
    padding: 0 50px;
}

.blog-carousel-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 45px;
    height: 45px;
    background: #ffffff;
    border: 2px solid #e5e7eb;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.blog-carousel-nav:hover {
    background: #2563eb;
    border-color: #2563eb;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

.blog-carousel-nav.prev {
    left: 0;
}

.blog-carousel-nav.next {
    right: 0;
}

.blog-carousel-container {
    display: flex;
    gap: 1.5rem;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 1rem 0;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.blog-carousel-container::-webkit-scrollbar {
    display: none;
}

.blog-card-modern {
    background: #ffffff;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.4s ease;
    border: 1px solid #e5e7eb;
    min-width: 320px;
    flex-shrink: 0;
    position: relative;
}

.blog-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    border-color: rgba(37, 99, 235, 0.3);
}

.blog-category-badge {
    display: inline-block;
    background: rgba(37, 99, 235, 0.1);
    color: #2563eb;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
}

.blog-posted-date {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    font-size: 0.75rem;
    color: #94a3b8;
}

.blog-card-content {
    text-align: center;
    margin-top: 0.5rem;
}

.blog-author-logo {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    margin: 0 auto 1rem;
    object-fit: cover;
    background: #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: #94a3b8;
    font-size: 0.875rem;
}

.blog-author-name {
    font-size: 0.875rem;
    color: #64748b;
    margin-bottom: 0.5rem;
}

.blog-card-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.75rem;
    line-height: 1.4;
    min-height: 3.5rem;
}

.blog-card-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-card-title a:hover {
    color: #2563eb;
}

.blog-card-excerpt {
    font-size: 0.875rem;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.blog-action-btn {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
    border: none;
    border-radius: 50%;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 1rem auto 0;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    text-decoration: none;
}

.blog-action-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
    color: #ffffff;
}

@media (max-width: 991px) {
    .blog-cards-carousel {
        padding: 0 40px;
    }
    
    .blog-carousel-nav {
        width: 40px;
        height: 40px;
    }
    
    .blog-card-modern {
        min-width: 280px;
    }
}

@media (max-width: 767px) {
    .recommended-blogs-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .blog-cards-carousel {
        padding: 0 35px;
    }
    
    .blog-carousel-nav {
        width: 35px;
        height: 35px;
    }
    
    .blog-card-modern {
        min-width: 260px;
    }
}
</style>

<div class="recommended-blogs-section">
    <div class="container">
        <div class="recommended-blogs-header">
            <h2 class="recommended-blogs-title">
                        @if ($subtitle = $shortcode->subtitle)
                    {!! BaseHelper::clean($subtitle) !!}
                @else
                    {{ __('Recommended Blogs') }}
                @endif
            </h2>
            @if ($shortcode->button_action_url)
                <a href="{{ $shortcode->button_action_url }}" class="recommended-blogs-view-all">
                    {{ $shortcode->button_action_label ?: __('View ALL') }}
                </a>
            @endif
        </div>

        @php
            $categories = [];
            if (is_plugin_active('blog')) {
                try {
                    $allCategories = \Botble\Blog\Models\Category::query()
                        ->where('status', 'published')
                        ->withCount('posts')
                        ->having('posts_count', '>', 0)
                        ->orderBy('posts_count', 'desc')
                        ->limit(6)
                        ->get();
                    $categories = $allCategories->pluck('name', 'id')->toArray();
                } catch (\Exception $e) {
                    $categories = [];
                }
            }
        @endphp
        
        @if(count($categories) > 0)
            <div class="blog-filters">
                <button class="blog-filter-btn active" data-filter="all">All</button>
                @foreach($categories as $catId => $catName)
                    <button class="blog-filter-btn" data-filter="category-{{ $catId }}">{{ $catName }}</button>
                @endforeach
            </div>
        @endif
        
        <div class="blog-cards-carousel">
            <button class="blog-carousel-nav prev" onclick="scrollBlogCarousel(-1)">
                <i class="feather-chevron-left"></i>
            </button>
            <div class="blog-carousel-container" id="blogCarousel">
                    @foreach ($posts as $post)
                    @php
                        $postCategory = $post->categories->first();
                        $categoryClass = $postCategory ? 'category-' . $postCategory->id : '';
                        $authorInitials = '';
                        if ($post->author && $post->author->name) {
                            $nameParts = explode(' ', $post->author->name);
                            $authorInitials = strtoupper(substr($nameParts[0], 0, 1) . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : ''));
                        }
                    @endphp
                    <div class="blog-card-modern" data-category="{{ $categoryClass }}">
                        <span class="blog-category-badge">{{ $postCategory ? $postCategory->name : 'Blog' }}</span>
                        <span class="blog-posted-date">{{ $post->created_at->diffForHumans() }}</span>
                        <div class="blog-card-content">
                            @if($post->author && $post->author->avatar_url)
                                <img src="{{ $post->author->avatar_url }}" alt="{{ $post->author->name }}" class="blog-author-logo">
                        @else
                                <div class="blog-author-logo">{{ $authorInitials ?: 'A' }}</div>
                            @endif
                            <div class="blog-author-name">{{ $post->author->name ?? 'Admin' }}</div>
                            <h4 class="blog-card-title">
                                                <a href="{{ $post->url }}">{{ $post->name }}</a>
                                            </h4>
                            @if($post->description)
                                <p class="blog-card-excerpt">{{ $post->description }}</p>
                            @endif
                            <a href="{{ $post->url }}" class="blog-action-btn">
                                <i class="feather-arrow-right"></i>
                            </a>
                                </div>
                            </div>
                    @endforeach
            </div>
            <button class="blog-carousel-nav next" onclick="scrollBlogCarousel(1)">
                <i class="feather-chevron-right"></i>
            </button>
        </div>
    </div>
</div>

<script>
function scrollBlogCarousel(direction) {
    const carousel = document.getElementById('blogCarousel');
    if (carousel) {
        const cardWidth = carousel.querySelector('.blog-card-modern')?.offsetWidth || 320;
        const gap = 24; // 1.5rem gap
        const scrollAmount = (cardWidth + gap) * direction;
        carousel.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
        });
    }
}

// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.blog-filter-btn');
    const blogCards = document.querySelectorAll('.blog-card-modern');
    
    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            // Filter cards
            blogCards.forEach(card => {
                if (filter === 'all') {
                    card.style.display = 'block';
                } else {
                    const cardCategory = card.getAttribute('data-category');
                    if (cardCategory === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    });
});
</script>
