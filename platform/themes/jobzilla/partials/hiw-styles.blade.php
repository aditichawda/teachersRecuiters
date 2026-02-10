{{-- Shared HIW Styles for Terms, How It Works, About Us pages --}}
<style>
.hiw-label{display:inline-block;background:linear-gradient(135deg,rgba(25,103,210,.1) 0%,rgba(25,103,210,.05) 100%);color:var(--primary-color,#1967d2);font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;padding:6px 18px;border-radius:50px;margin-bottom:15px;border:1px solid rgba(25,103,210,.15)}
.hiw-section-header{text-align:center;margin-bottom:50px}
.hiw-section-title{font-size:36px;font-weight:800;color:#1e293b;margin-top:10px;line-height:1.3}
.hiw-hero-section{padding:80px 0 60px;background:linear-gradient(135deg,#f0f5ff 0%,#f8fafc 50%,#eef2ff 100%);position:relative;overflow:hidden}
.hiw-hero-section::before{content:'';position:absolute;top:-100px;right:-100px;width:400px;height:400px;background:radial-gradient(circle,rgba(25,103,210,.06) 0%,transparent 70%);border-radius:50%;pointer-events:none}
.hiw-hero-content{padding-right:30px}
.hiw-hero-title{font-size:42px;font-weight:800;color:#0f172a;line-height:1.2;margin-bottom:20px;margin-top:10px}
.hiw-hero-desc{font-size:16px;color:#475569;line-height:1.8;margin-bottom:15px}
.hiw-hero-highlights{list-style:none;padding:0;margin:25px 0 0}
.hiw-hero-highlights li{font-size:15px;color:#334155;padding:8px 0;display:flex;align-items:center;gap:10px}
.hiw-hero-highlights li i{color:#22c55e;font-size:18px;flex-shrink:0}
.hiw-hero-image,.hiw-hero-images{text-align:center}
.hiw-hero-image img,.hiw-hero-images img{max-width:100%;border-radius:16px;box-shadow:0 25px 60px rgba(0,0,0,.08)}
.hiw-info-boxes-section{padding:70px 0;background:#fff}
.hiw-info-box{background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:35px 30px;height:100%;transition:all .3s;box-shadow:0 4px 15px rgba(0,0,0,.04)}
.hiw-info-box:hover{border-color:var(--primary-color,#1967d2);box-shadow:0 8px 30px rgba(25,103,210,.1);transform:translateY(-4px)}
.hiw-info-title{font-size:20px;font-weight:700;color:#1e293b;margin-bottom:20px;display:flex;align-items:center;gap:10px}
.hiw-info-title i{color:var(--primary-color,#1967d2);font-size:22px}
.hiw-info-list{list-style:none;padding:0;margin:0}
.hiw-info-list li{font-size:15px;color:#475569;line-height:1.7;padding:10px 0 10px 28px;position:relative;border-bottom:1px solid #f1f5f9}
.hiw-info-list li:last-child{border-bottom:none}
.hiw-info-list li::before{content:'';position:absolute;left:0;top:18px;width:8px;height:8px;background:var(--primary-color,#1967d2);border-radius:50%;opacity:.6}
.hiw-process-section{padding:70px 0;background:#f8fafc}
.hiw-step-card{background:#fff;border-radius:16px;padding:35px 30px;text-align:center;height:100%;border:1px solid #e2e8f0;transition:all .3s;position:relative;box-shadow:0 4px 15px rgba(0,0,0,.04)}
.hiw-step-card:hover{transform:translateY(-6px);box-shadow:0 12px 35px rgba(25,103,210,.12);border-color:var(--primary-color,#1967d2)}
.hiw-step-number{display:inline-flex;align-items:center;justify-content:center;width:56px;height:56px;background:linear-gradient(135deg,var(--primary-color,#1967d2) 0%,#3b82f6 100%);color:#fff;font-size:22px;font-weight:800;border-radius:16px;margin-bottom:20px;box-shadow:0 8px 20px rgba(25,103,210,.25)}
.hiw-step-title{font-size:18px;font-weight:700;color:#1e293b;margin-bottom:12px}
.hiw-step-desc{font-size:14px;color:#64748b;line-height:1.7;margin-bottom:0}
.hiw-alternating-section{padding:70px 0;background:#fff}
.hiw-alt-row{margin-bottom:60px}
.hiw-alt-row:last-child{margin-bottom:0}
.hiw-alt-image img{width:100%;border-radius:16px;box-shadow:0 20px 50px rgba(0,0,0,.08)}
.hiw-alt-content{padding:20px 0}
.hiw-alt-title{font-size:30px;font-weight:800;color:#1e293b;margin-bottom:15px;margin-top:10px;line-height:1.3}
.hiw-alt-content>p{font-size:15px;color:#475569;line-height:1.8;margin-bottom:20px}
.hiw-alt-list{list-style:none;padding:0;margin:0 0 25px}
.hiw-alt-list li{font-size:15px;color:#334155;padding:8px 0;display:flex;align-items:center;gap:10px}
.hiw-alt-list li i{color:#22c55e;font-size:16px;flex-shrink:0}
.hiw-btn-primary{display:inline-block;background:linear-gradient(135deg,var(--primary-color,#1967d2) 0%,#3b82f6 100%);color:#fff!important;padding:14px 32px;border-radius:10px;font-size:15px;font-weight:600;text-decoration:none;transition:all .3s;box-shadow:0 4px 15px rgba(25,103,210,.3)}
.hiw-btn-primary:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(25,103,210,.4);color:#fff!important}
.hiw-features-section{padding:70px 0;background:#f8fafc}
.hiw-feature-card{background:#fff;border-radius:16px;padding:35px 30px;text-align:center;height:100%;border:1px solid #e2e8f0;border-top:4px solid #e2e8f0;transition:all .3s;box-shadow:0 4px 15px rgba(0,0,0,.04)}
.hiw-feature-card:hover{transform:translateY(-6px);box-shadow:0 12px 35px rgba(0,0,0,.1)}
.hiw-feature-card.hiw-feature-blue{border-top-color:#3b82f6}
.hiw-feature-card.hiw-feature-green{border-top-color:#22c55e}
.hiw-feature-card.hiw-feature-purple{border-top-color:#8b5cf6}
.hiw-feature-icon{display:inline-flex;align-items:center;justify-content:center;width:64px;height:64px;border-radius:16px;margin-bottom:20px;font-size:26px;color:#fff}
.hiw-feature-blue .hiw-feature-icon{background:linear-gradient(135deg,#2563eb 0%,#3b82f6 100%);box-shadow:0 8px 20px rgba(59,130,246,.3)}
.hiw-feature-green .hiw-feature-icon{background:linear-gradient(135deg,#16a34a 0%,#22c55e 100%);box-shadow:0 8px 20px rgba(34,197,94,.3)}
.hiw-feature-purple .hiw-feature-icon{background:linear-gradient(135deg,#7c3aed 0%,#8b5cf6 100%);box-shadow:0 8px 20px rgba(139,92,246,.3)}
.hiw-feature-card h4{font-size:18px;font-weight:700;color:#1e293b;margin-bottom:12px}
.hiw-feature-card p{font-size:14px;color:#64748b;line-height:1.7;margin-bottom:0}
.hiw-stats-section{padding:70px 0;background:linear-gradient(135deg,#0f172a 0%,#1e293b 100%);position:relative;overflow:hidden}
.hiw-stats-header{text-align:center;margin-bottom:50px}
.hiw-stats-header h2{font-size:34px;font-weight:800;color:#fff;margin-bottom:10px}
.hiw-stats-header p{font-size:16px;color:#94a3b8}
.hiw-stat-item{text-align:center;padding:25px 15px}
.hiw-stat-number{display:block;font-size:42px;font-weight:800;color:#fff;margin-bottom:8px;line-height:1.2}
.hiw-stat-label{display:block;font-size:14px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:.5px}
.hiw-cta-section{padding:80px 0;background:linear-gradient(135deg,var(--primary-color,#1967d2) 0%,#3b82f6 100%);position:relative;overflow:hidden}
.hiw-cta-section::before{content:'';position:absolute;top:-50%;right:-10%;width:500px;height:500px;background:rgba(255,255,255,.05);border-radius:50%;pointer-events:none}
.hiw-cta-content{text-align:center;position:relative;z-index:1}
.hiw-cta-content h2{font-size:36px;font-weight:800;color:#fff;margin-bottom:15px}
.hiw-cta-content p{font-size:17px;color:rgba(255,255,255,.85);margin-bottom:30px;max-width:600px;margin-left:auto;margin-right:auto}
.hiw-cta-buttons{display:flex;justify-content:center;gap:15px;flex-wrap:wrap}
.hiw-btn-white{display:inline-block;background:#fff;color:var(--primary-color,#1967d2)!important;padding:14px 32px;border-radius:10px;font-size:15px;font-weight:700;text-decoration:none;transition:all .3s;box-shadow:0 4px 15px rgba(0,0,0,.15)}
.hiw-btn-white:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(0,0,0,.2);color:var(--primary-color,#1967d2)!important}
.hiw-btn-outline{display:inline-block;background:transparent;color:#fff!important;padding:14px 32px;border-radius:10px;font-size:15px;font-weight:600;text-decoration:none;border:2px solid rgba(255,255,255,.4);transition:all .3s}
.hiw-btn-outline:hover{background:rgba(255,255,255,.1);border-color:#fff;color:#fff!important;transform:translateY(-2px)}
/* About specific */
.about-mv-card{background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:35px 30px;height:100%;transition:all .3s;box-shadow:0 4px 15px rgba(0,0,0,.04)}
.about-mv-card:hover{box-shadow:0 8px 30px rgba(25,103,210,.1);transform:translateY(-4px)}
.about-mv-icon{display:inline-flex;align-items:center;justify-content:center;width:48px;height:48px;background:linear-gradient(135deg,var(--primary-color,#1967d2) 0%,#3b82f6 100%);color:#fff;border-radius:12px;font-size:20px;flex-shrink:0}
.about-mv-card-title{font-size:20px;font-weight:700;color:#1e293b;margin-bottom:15px;display:flex;align-items:center}
.about-mv-card-desc{font-size:15px;color:#475569;line-height:1.8;margin-bottom:0}
/* Terms specific */
.terms-detail-section{padding:70px 0;background:#fff}
.terms-detail-card{background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:30px;margin-bottom:20px;transition:all .3s;box-shadow:0 2px 10px rgba(0,0,0,.03)}
.terms-detail-card:hover{border-color:var(--primary-color,#1967d2);box-shadow:0 6px 20px rgba(25,103,210,.08)}
.terms-detail-card h4{font-size:18px;font-weight:700;color:#1e293b;margin-bottom:15px;display:flex;align-items:center;gap:10px}
.terms-detail-card h4 i{color:var(--primary-color,#1967d2);font-size:20px}
.terms-detail-card p,.terms-detail-card li{font-size:15px;color:#475569;line-height:1.8}
.terms-detail-card ul{padding-left:0;list-style:none}
.terms-detail-card ul li{padding:6px 0 6px 24px;position:relative}
.terms-detail-card ul li::before{content:'';position:absolute;left:0;top:14px;width:6px;height:6px;background:var(--primary-color,#1967d2);border-radius:50%;opacity:.5}
.terms-toc{background:#f8fafc;border:1px solid #e2e8f0;border-radius:16px;padding:30px;position:sticky;top:100px}
.terms-toc h5{font-size:16px;font-weight:700;color:#1e293b;margin-bottom:15px;padding-bottom:12px;border-bottom:2px solid #e2e8f0}
.terms-toc ul{list-style:none;padding:0;margin:0}
.terms-toc ul li{margin-bottom:8px}
.terms-toc ul li a{color:#475569;font-size:14px;text-decoration:none;padding:6px 12px;display:block;border-radius:8px;transition:all .2s}
.terms-toc ul li a:hover{background:var(--primary-color,#1967d2);color:#fff}
@media(max-width:991px){.hiw-hero-title{font-size:32px}.hiw-hero-content{padding-right:0;margin-bottom:30px}.hiw-section-title{font-size:28px}.hiw-alt-title{font-size:24px}.hiw-cta-content h2{font-size:28px}.hiw-stats-header h2{font-size:26px}.hiw-stat-number{font-size:32px}}
@media(max-width:767px){.hiw-hero-section{padding:50px 0 40px}.hiw-hero-title{font-size:26px}.hiw-info-boxes-section,.hiw-process-section,.hiw-alternating-section,.hiw-features-section,.hiw-stats-section,.hiw-cta-section,.terms-detail-section{padding:50px 0}.hiw-alt-row{margin-bottom:40px}.hiw-section-title{font-size:24px}.hiw-cta-content h2{font-size:24px}.hiw-stat-number{font-size:28px}.hiw-stat-label{font-size:12px}}
</style>
