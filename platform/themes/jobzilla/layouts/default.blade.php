{!! Theme::partial('header') !!}

<style>
/* Global Responsive Styles for All Pages */
/* Container Responsive */
.container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}
@media (max-width: 1199px) {
    .container {
        max-width: 960px;
        padding: 0 15px;
    }
}
@media (max-width: 991px) {
    .container {
        max-width: 720px;
        padding: 0 15px;
    }
}
@media (max-width: 767px) {
    .container {
        max-width: 540px;
        padding: 0 15px;
    }
}
@media (max-width: 575px) {
    .container {
        max-width: 100%;
        padding: 0 10px;
    }
}

/* Row and Column Responsive */
.row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}
/* [class*="col-"] {
    padding: 0 15px;
} */
@media (max-width: 767px) {
    [class*="col-lg-"], [class*="col-md-"], [class*="col-xl-"] {
        flex: 0 0 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }
}

/* Jobs Page Responsive */
@media (max-width: 991px) {
    .jobs-sidebar-modern {
        position: fixed;
        top: 0;
        left: -100%;
        width: 300px;
        height: 100vh;
        background: #fff;
        z-index: 9999;
        transition: left 0.3s ease;
        overflow-y: auto;
    }
    .jobs-sidebar-modern.active {
        left: 0;
    }
    .jobs-list-content {
        width: 100%;
    }
}
@media (max-width: 767px) {
    .jobs-sidebar-modern {
        width: 100%;
    }
    .job-card, .hpage-6-featured-block {
        margin-bottom: 20px;
    }
}

/* Companies Page Responsive */
@media (max-width: 991px) {
    .company-sidebar {
        position: fixed;
        top: 0;
        left: -100%;
        width: 300px;
        height: 100vh;
        background: #fff;
        z-index: 9999;
        transition: left 0.3s ease;
        overflow-y: auto;
    }
    .company-sidebar.active {
        left: 0;
    }
}
@media (max-width: 767px) {
    .company-sidebar {
        width: 100%;
    }
}

/* Blog Page Responsive */
@media (max-width: 991px) {
    .blog-sidebar {
        margin-top: 30px;
    }
}
@media (max-width: 767px) {
    .blog-post {
        margin-bottom: 30px;
    }
    .blog-post img {
        width: 100%;
        height: auto;
    }
}

/* Contact Page Responsive */
@media (max-width: 767px) {
    .contact-form-outer, .contact-info-outer {
        margin-bottom: 30px;
    }
    .contact-form input, .contact-form textarea {
        width: 100%;
    }
}

/* Dashboard Responsive */
@media (max-width: 991px) {
    .dashboard-sidebar {
        position: fixed;
        left: -100%;
        transition: left 0.3s ease;
    }
    .dashboard-sidebar.active {
        left: 0;
    }
    .dashboard-content {
        width: 100%;
    }
}
@media (max-width: 767px) {
    .dashboard-table {
        overflow-x: auto;
    }
    .dashboard-card {
        margin-bottom: 20px;
    }
}

/* For Teachers / For Schools Pages Responsive */
@media (max-width: 767px) {
    .for-teachers-section, .for-schools-section {
        padding: 40px 0;
    }
    .for-teachers-card, .for-schools-card {
        margin-bottom: 20px;
    }
}

/* FAQ Page - Already has responsive, ensuring it works */
@media (max-width: 480px) {
    .faq-tabs {
        flex-direction: column;
        align-items: stretch;
    }
    .faq-tab-btn {
        width: 100%;
    }
}

/* Privacy & Terms Pages - Already responsive, enhancing */
@media (max-width: 575px) {
    .pp-content, .tc-content {
        font-size: 14px;
    }
    .pp-content h2, .tc-content h2 {
        font-size: 18px;
    }
}

/* Fraud Alert Page Responsive */
@media (max-width: 767px) {
    .fraud-hero {
        padding: 60px 0 40px;
    }
    .fraud-hero h1 {
        font-size: 24px;
    }
    .fraud-warning-box {
        padding: 20px;
    }
}

/* General Page Content Responsive */
.page-content-wrapper {
    width: 100%;
    overflow-x: hidden;
}
.ck-content {
    max-width: 100%;
    overflow-x: auto;
    word-wrap: break-word;
}
.ck-content img {
    max-width: 100%;
    height: auto;
}
.ck-content table {
    width: 100%;
    overflow-x: auto;
    display: block;
}

/* Section Padding Responsive */
.section-full {
    padding: 60px 0;
}
@media (max-width: 991px) {
    .section-full {
        padding: 40px 0;
    }
}
@media (max-width: 767px) {
    .section-full {
        padding: 30px 0;
    }
}

/* Buttons Responsive */
@media (max-width: 767px) {
    .site-button, .hiw-btn-primary, .hiw-btn-white, .hiw-btn-outline {
        width: 100%;
        max-width: 100%;
        display: block;
        text-align: center;
        margin-bottom: 10px;
    }
}

/* Images Responsive */
img {
    max-width: 100%;
    height: auto;
}

/* Tables Responsive */
@media (max-width: 767px) {
    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
}
</style>

{!! Theme::content() !!}

{!! Theme::partial('footer') !!}
