{{-- Terms & Conditions - Simple Clean Layout (Admin Editable) --}}
<style>
.tc-section {
    padding: 100px 0 60px;
    background: #fff;
}
.tc-header {
    text-align: center;
    margin-bottom: 45px;
}
.tc-header h1 {
    font-size: 32px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 10px;
}
.tc-header p {
    font-size: 14px;
    color: #94a3b8;
}
.tc-content {
    /* max-width: 800px; */
    margin: 0 auto;
}
.tc-content h2 {
    font-size: 20px;
    font-weight: 600;
    color: #1e293b;
    margin: 35px 0 12px;
    padding-bottom: 8px;
    border-bottom: 1px solid #f1f5f9;
}
.tc-content h2:first-of-type {
    margin-top: 0;
}
.tc-content h3 {
    font-size: 17px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 10px;
}
.tc-content p {
    font-size: 15px;
    color: #475569;
    line-height: 1.8;
    margin-bottom: 12px;
}
.tc-content ul {
    padding-left: 20px;
    margin-bottom: 15px;
}
.tc-content ul li {
    font-size: 15px;
    color: #475569;
    line-height: 1.8;
    margin-bottom: 5px;
}
.tc-content .tc-contact {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 25px 30px;
    margin-top: 35px;
}
.tc-content .tc-contact h3 {
    font-size: 17px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 10px;
}
.tc-content .tc-contact p {
    margin-bottom: 5px;
}
@media (max-width: 767px) {
    .tc-section { padding: 70px 0 40px; }
    .tc-header h1 { font-size: 28px; }
    .tc-content h2 { font-size: 18px; margin-top: 25px; }
    .tc-content p, .tc-content ul li { font-size: 14px; }
    .tc-content .tc-contact { padding: 20px; }
    .tc-content .tc-contact h3 { font-size: 16px; }
}
@media(max-width: 480px) {
    .tc-section { padding: 70px 10px 30px; }
    .tc-header h1 { font-size: 22px; }
    .tc-content h2 { font-size: 16px; }
    .tc-content p, .tc-content ul li { font-size: 13px; }
    .tc-content ul { padding-left: 16px; }
    .tc-content .tc-contact { padding: 15px; }
}
</style>

<section class="tc-section">
    <div class="container">
        <div class="tc-header">
            <h1>{{ $page->name ?? 'Terms & Conditions' }}</h1>
            @if($page->getMetaData('subtitle', true))
                <p>{{ $page->getMetaData('subtitle', true) }}</p>
            @else
                <p>Last Updated: {{ $page->updated_at ? $page->updated_at->format('F d, Y') : 'February 10, 2026' }}</p>
            @endif
        </div>

        <div class="tc-content">
            {!! BaseHelper::clean($page->content) !!}
        </div>
    </div>
</section>
