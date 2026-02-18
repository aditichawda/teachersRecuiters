
<style>
/* ===== Style-1 List Cards ===== */
.job-card-modern {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 22px 24px;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 18px;
    transition: all .3s ease;
    position: relative;
    overflow: hidden;
}
.job-card-modern::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background: transparent;
    transition: all .3s;
    border-radius: 0 4px 4px 0;
}
.job-card-modern:hover {
    border-color: #bae6fd;
    box-shadow: 0 8px 25px rgba(0,115,209,.08);
    transform: translateY(-2px);
}
.job-card-modern:hover::before {
    background: #0073d1;
}
.job-card-modern .jcm-logo {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    overflow: hidden;
    border: 1px solid #e2e8f0;
}
.job-card-modern .jcm-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 6px;
}
.job-card-modern .jcm-info {
    flex: 1;
    min-width: 0;
}
.job-card-modern .jcm-title {
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 5px;
    display: block;
    text-decoration: none;
    transition: color .2s;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.job-card-modern .jcm-title:hover { color: #0073d1; }
.job-card-modern .jcm-meta {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
    margin-bottom: 6px;
}
.job-card-modern .jcm-meta span {
    font-size: 13px;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 4px;
}
.job-card-modern .jcm-meta span i { font-size: 13px; color: #94a3b8; }
.job-card-modern .jcm-meta a {
    font-size: 13px;
    color: #0073d1;
    text-decoration: none;
    font-weight: 500;
}
.job-card-modern .jcm-meta a:hover { color: #005ba1; }
.job-card-modern .jcm-tags {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
}
.job-card-modern .jcm-tag {
    font-size: 11px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 50px;
    background: #f0fdf4;
    color: #16a34a;
    border: 1px solid #bbf7d0;
}
.job-card-modern .jcm-right {
    text-align: right;
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 8px;
}
.job-card-modern .jcm-salary {
    font-size: 15px;
    font-weight: 700;
    color: #0073d1;
}
.job-card-modern .jcm-time {
    font-size: 12px;
    color: #94a3b8;
}
.job-card-modern .jcm-apply {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 7px 18px;
    background: #0073d1;
    color: #fff;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all .25s;
}
.job-card-modern .jcm-apply:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,115,209,.3);
    background: #005ba1;
    color: #fff;
}

/* ===== Style-2 Grid Cards ===== */
.job-grid-modern {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 24px;
    height: 100%;
    transition: all .3s ease;
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
}
.job-grid-modern:hover {
    border-color: #bae6fd;
    box-shadow: 0 12px 30px rgba(0,115,209,.1);
    transform: translateY(-4px);
}
.job-grid-modern .jgm-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
}
.job-grid-modern .jgm-logo {
    width: 52px;
    height: 52px;
    border-radius: 12px;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border: 1px solid #e2e8f0;
}
.job-grid-modern .jgm-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 6px;
}
.job-grid-modern .jgm-time {
    font-size: 12px;
    color: #94a3b8;
    font-weight: 500;
}
.job-grid-modern .jgm-tags {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    margin-bottom: 14px;
}
.job-grid-modern .jgm-tag {
    font-size: 11px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 50px;
    background: #f0fdf4;
    color: #16a34a;
    border: 1px solid #bbf7d0;
}
.job-grid-modern .jgm-title {
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 8px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-decoration: none;
    transition: color .2s;
}
.job-grid-modern .jgm-title:hover { color: #0073d1; }
.job-grid-modern .jgm-location {
    font-size: 13px;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 4px;
    margin-bottom: 6px;
}
.job-grid-modern .jgm-location i { color: #94a3b8; font-size: 13px; }
.job-grid-modern .jgm-company {
    font-size: 13px;
    color: #0073d1;
    text-decoration: none;
    font-weight: 500;
    margin-bottom: 16px;
    display: inline-block;
}
.job-grid-modern .jgm-company:hover { color: #005ba1; }
.job-grid-modern .jgm-bottom {
    margin-top: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 16px;
    border-top: 1px solid #f1f5f9;
}
.job-grid-modern .jgm-salary {
    font-size: 15px;
    font-weight: 700;
    color: #0073d1;
}
.job-grid-modern .jgm-view {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 6px 16px;
    background: #0073d1;
    color: #fff;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all .25s;
}
.job-grid-modern .jgm-view:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,115,209,.3);
    background: #005ba1;
    color: #fff;
}

/* ===== Responsive for Job Cards ===== */
@media(max-width: 991px) {
    .job-card-modern { padding: 16px 18px; gap: 14px; }
    .job-card-modern .jcm-right { display: none; }
    .job-card-modern .jcm-salary-mobile {
        display: block;
        font-size: 14px;
        font-weight: 700;
        color: #0073d1;
        margin-top: 4px;
    }
}
@media(min-width: 992px) {
    .job-card-modern .jcm-salary-mobile { display: none; }
}
@media(max-width: 767px) {
    .job-card-modern { flex-direction: column; align-items: flex-start; gap: 12px; }
    .job-card-modern .jcm-logo { width: 44px; height: 44px; }
    .job-card-modern .jcm-title { font-size: 15px; }
    .job-card-modern .jcm-meta { gap: 8px; }
    .job-grid-modern { padding: 18px; }
    .job-grid-modern .jgm-title { font-size: 15px; }
}
</style>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/jobs-card-styles.blade.php ENDPATH**/ ?>