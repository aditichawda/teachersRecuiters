{{-- Modern Company Card Styles (Shared) --}}
<style>
/* ===== Grid Card ===== */
.company-card-grid {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 0;
    transition: all .3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
}
.company-card-grid:hover {
    border-color: #bae6fd;
    box-shadow: 0 12px 30px rgba(0,115,209,.12);
    transform: translateY(-4px);
}
.company-card-grid .ccg-featured {
    position: absolute;
    top: 14px;
    right: 14px;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 3px 10px;
    border-radius: 50px;
    background: #ef3800;
    color: #fff;
    z-index: 2;
}
.company-card-grid .ccg-verified {
    position: absolute;
    top: 14px;
    left: 14px;
    font-size: 10px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 50px;
    background: linear-gradient(135deg, #059669, #34d399);
    color: #fff;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 3px;
}
.company-card-grid .ccg-top {
    background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
    padding: 28px 22px 18px;
    text-align: center;
    border-bottom: 1px solid #e2e8f0;
}
.company-card-grid .ccg-logo {
    width: 72px;
    height: 72px;
    border-radius: 16px;
    background: #fff;
    border: 2px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    margin: 0 auto 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
}
.company-card-grid .ccg-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 8px;
}
.company-card-grid .ccg-name {
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
    text-decoration: none;
    margin-bottom: 4px;
    display: block;
    transition: color .2s;
}
.company-card-grid .ccg-name:hover { color: #0073d1; }
.company-card-grid .ccg-type {
    display: inline-block;
    font-size: 11px;
    font-weight: 600;
    color: #0073d1;
    background: #e0f2fe;
    padding: 2px 10px;
    border-radius: 20px;
    text-transform: capitalize;
}
.company-card-grid .ccg-body {
    padding: 16px 22px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.company-card-grid .ccg-desc {
    font-size: 13px;
    color: #64748b;
    line-height: 1.5;
    margin-bottom: 14px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.company-card-grid .ccg-details {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 16px;
}
.company-card-grid .ccg-detail {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: #475569;
}
.company-card-grid .ccg-detail i {
    width: 28px;
    height: 28px;
    border-radius: 8px;
    background: #f0f9ff;
    color: #0073d1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    flex-shrink: 0;
}
.company-card-grid .ccg-detail span { color: #1e293b; font-weight: 500; }
.company-card-grid .ccg-footer {
    padding: 14px 22px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}
.company-card-grid .ccg-jobs-count {
    font-size: 13px;
    color: #0073d1;
    font-weight: 600;
}
.company-card-grid .ccg-view-btn {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 7px 16px;
    background: #0073d1;
    color: #fff;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all .25s;
}
.company-card-grid .ccg-view-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,115,209,.3);
    background: #005ba1;
    color: #fff;
}

/* ===== List Card ===== */
.company-card-list {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 22px 24px;
    margin-bottom: 16px;
    display: flex;
    align-items: flex-start;
    gap: 20px;
    transition: all .3s ease;
    position: relative;
    overflow: hidden;
}
.company-card-list::before {
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
.company-card-list:hover {
    border-color: #bae6fd;
    box-shadow: 0 8px 25px rgba(0,115,209,.08);
    transform: translateY(-2px);
}
.company-card-list:hover::before {
    background: #0073d1;
}
.company-card-list .ccl-featured-inline {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 2px 8px;
    border-radius: 20px;
    background: #ef3800;
    color: #fff;
}
.company-card-list .ccl-logo {
    width: 64px;
    height: 64px;
    border-radius: 14px;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    flex-shrink: 0;
}
.company-card-list .ccl-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 6px;
}
.company-card-list .ccl-info { flex: 1; min-width: 0; }
.company-card-list .ccl-name-row {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 4px;
    flex-wrap: wrap;
}
.company-card-list .ccl-name {
    font-size: 17px;
    font-weight: 700;
    color: #1e293b;
    text-decoration: none;
    transition: color .2s;
}
.company-card-list .ccl-name:hover { color: #0073d1; }
.company-card-list .ccl-type {
    display: inline-block;
    font-size: 10px;
    font-weight: 600;
    color: #0073d1;
    background: #e0f2fe;
    padding: 2px 8px;
    border-radius: 20px;
    text-transform: capitalize;
}
.company-card-list .ccl-verified {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    font-size: 10px;
    font-weight: 600;
    color: #059669;
    background: #ecfdf5;
    padding: 2px 8px;
    border-radius: 20px;
}
.company-card-list .ccl-desc {
    font-size: 13px;
    color: #64748b;
    margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.company-card-list .ccl-meta {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}
.company-card-list .ccl-meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 13px;
    color: #475569;
}
.company-card-list .ccl-meta-item i {
    color: #0073d1;
    font-size: 13px;
}
.company-card-list .ccl-right {
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 8px;
}
.company-card-list .ccl-jobs-count {
    font-size: 13px;
    color: #0073d1;
    font-weight: 600;
    background: #f0f9ff;
    padding: 4px 12px;
    border-radius: 20px;
}
.company-card-list .ccl-view-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 8px 20px;
    background: #0073d1;
    color: #fff;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all .25s;
}
.company-card-list .ccl-view-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,115,209,.3);
    background: #005ba1;
    color: #fff;
}

/* ===== Responsive ===== */
@media(max-width: 991px) {
    .company-card-grid .ccg-top { padding: 22px 18px 14px; }
    .company-card-grid .ccg-body { padding: 14px 18px; }
    .company-card-grid .ccg-footer { padding: 12px 18px; }
}
@media(max-width: 767px) {
    .company-card-grid .ccg-logo { width: 56px; height: 56px; }
    .company-card-list {
        flex-direction: column;
        align-items: flex-start;
        gap: 14px;
        padding: 18px;
    }
    .company-card-list .ccl-logo { width: 50px; height: 50px; }
    .company-card-list .ccl-right { width: 100%; flex-direction: row; justify-content: space-between; align-items: center; }
    .company-card-list .ccl-meta { gap: 10px; }
}
</style>
