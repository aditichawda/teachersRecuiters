{!! Theme::partial('header') !!}

<style>
/* Blog Page Responsive */
.blog-layout {
    padding: 60px 0;
}
.blog-sidebar {
    margin-top: 30px;
}
@media (max-width: 991px) {
    .blog-layout {
        padding: 50px 0;
    }
    .blog-sidebar {
        margin-top: 40px;
    }
}
@media (max-width: 767px) {
    .blog-layout {
        padding: 40px 0;
    }
    .blog-post {
        margin-bottom: 30px;
    }
    .blog-post img {
        width: 100%;
        height: auto;
    }
    .blog-post-title {
        font-size: 20px;
    }
    .blog-post-meta {
        font-size: 13px;
    }
}
@media (max-width: 575px) {
    .blog-layout {
        padding: 30px 0;
    }
    .blog-post-title {
        font-size: 18px;
    }
}
</style>

{!! Theme::content() !!}

{!! Theme::partial('footer') !!}
