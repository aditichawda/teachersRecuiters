{{-- Modern Candidate Card Styles (Shared) --}}
<style>
/* ===== Grid Card ===== */
.cand-card-grid {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 28px 22px;
    text-align: center;
    transition: all .3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    overflow: hidden;
}
.cand-card-grid:hover {
    border-color: #bae6fd;
    box-shadow: 0 12px 30px rgba(14,165,233,.1);
    transform: translateY(-4px);
}
.cand-card-grid .cg-featured {
    position: absolute;
    top: 14px;
    right: 14px;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 3px 10px;
    border-radius: 50px;
    background: linear-gradient(135deg, #f59e0b, #fbbf24);
    color: #fff;
}
.cand-card-grid .cg-avatar {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid #e0f2fe;
    margin-bottom: 14px;
    flex-shrink: 0;
}
.cand-card-grid .cg-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.cand-card-grid .cg-name {
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
    text-decoration: none;
    margin-bottom: 4px;
    display: block;
    transition: color .2s;
}
.cand-card-grid .cg-name:hover { color: #0369a1; }
.cand-card-grid .cg-desc {
    font-size: 13px;
    color: #64748b;
    line-height: 1.5;
    margin-bottom: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.cand-card-grid .cg-location {
    font-size: 13px;
    color: #94a3b8;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
    margin-bottom: 16px;
}
.cand-card-grid .cg-location i { font-size: 13px; }
.cand-card-grid .cg-view-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 8px 22px;
    background: linear-gradient(135deg, #0369a1, #0ea5e9);
    color: #fff;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all .25s;
    margin-top: auto;
}
.cand-card-grid .cg-view-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(14,165,233,.3);
    color: #fff;
}

/* ===== List Card ===== */
.cand-card-list {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 20px 24px;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 18px;
    transition: all .3s ease;
    position: relative;
    overflow: hidden;
}
.cand-card-list::before {
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
.cand-card-list:hover {
    border-color: #bae6fd;
    box-shadow: 0 8px 25px rgba(14,165,233,.08);
    transform: translateY(-2px);
}
.cand-card-list:hover::before {
    background: linear-gradient(180deg, #0ea5e9, #0369a1);
}
.cand-card-list .cl-avatar {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid #e0f2fe;
    flex-shrink: 0;
}
.cand-card-list .cl-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.cand-card-list .cl-featured {
    position: absolute;
    top: 12px;
    right: 14px;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 3px 10px;
    border-radius: 50px;
    background: linear-gradient(135deg, #f59e0b, #fbbf24);
    color: #fff;
}
.cand-card-list .cl-info { flex: 1; min-width: 0; }
.cand-card-list .cl-name {
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
    text-decoration: none;
    display: block;
    margin-bottom: 3px;
    transition: color .2s;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.cand-card-list .cl-name:hover { color: #0369a1; }
.cand-card-list .cl-desc {
    font-size: 13px;
    color: #64748b;
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.cand-card-list .cl-location {
    font-size: 13px;
    color: #94a3b8;
    display: flex;
    align-items: center;
    gap: 4px;
}
.cand-card-list .cl-location i { font-size: 12px; }
.cand-card-list .cl-right { flex-shrink: 0; }
.cand-card-list .cl-view-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 8px 20px;
    background: linear-gradient(135deg, #0369a1, #0ea5e9);
    color: #fff;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all .25s;
}
.cand-card-list .cl-view-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(14,165,233,.3);
    color: #fff;
}

/* ===== Responsive ===== */
@media(max-width: 767px) {
    .cand-card-grid { padding: 20px 16px; }
    .cand-card-grid .cg-avatar { width: 60px; height: 60px; }
    .cand-card-list { flex-direction: column; align-items: flex-start; gap: 12px; padding: 16px 18px; }
    .cand-card-list .cl-avatar { width: 48px; height: 48px; }
    .cand-card-list .cl-right { width: 100%; }
    .cand-card-list .cl-view-btn { width: 100%; justify-content: center; }
}
</style>
