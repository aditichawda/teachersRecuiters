@extends(JobBoardHelper::viewPath('dashboard.layouts.master'))

@section('content')
@php
    $maxWords = 125;
    $maxContent = (int) setting('admission_about_school_max_length', 1300);
@endphp
<style>
.adm-edit-card { background: #fff; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,.06); border: 1px solid #e8ecf1; padding: 28px; margin-bottom: 24px; }
.adm-form-toggle { cursor: pointer; padding: 12px 16px; background: #f8fafc; border-radius: 10px; margin-bottom: 16px; display: flex; align-items: center; justify-content: space-between; border: 1px solid #e2e8f0; }
.adm-form-toggle:hover { background: #f1f5f9; }
.adm-form-toggle i { transition: transform 0.2s; }
.adm-form-toggle.collapsed i.fa-chevron-down { transform: rotate(-90deg); }
.adm-form-content { display: none; padding-top: 16px; }
.adm-form-content.show { display: block; }
.adm-edit-card h4 { font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 8px; }
.adm-edit-card .form-label { font-weight: 600; color: #334155; margin-bottom: 6px; }
.adm-edit-card .form-control, .adm-edit-card .form-select { border-radius: 10px; border: 1px solid #e2e8f0; padding: 10px 14px; }
.adm-edit-card .btn-primary { background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%); border: none; border-radius: 10px; padding: 10px 24px; font-weight: 600; }
.adm-edit-card .btn-primary:hover { background: linear-gradient(135deg, #005bb5 0%, #004a94 100%); }
.adm-field-error { color: #dc3545 !important; font-size: 0.875rem; }
.adm-word-count-over { color: #dc3545 !important; font-size: 0.875rem; }

/* Enquiry Card - col-12 list, theme colors */
.adm-enquiry-card { 
    border: none !important; 
    border-radius: 12px !important; 
    box-shadow: 0 2px 10px rgba(0,0,0,.06) !important; 
    overflow: hidden;
    transition: all 0.25s ease;
}
.adm-enquiry-card:hover { 
    box-shadow: 0 8px 24px rgba(0, 115, 209, .14) !important; 
    transform: translateY(-2px);
    border-left: 3px solid #0073d1 !important;
}
.adm-enquiry-card .adm-card-inner { padding: 14px 18px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; }
.adm-enquiry-card .adm-left { display: flex; align-items: center; gap: 14px; flex: 1; min-width: 0; }
.adm-enquiry-card .adm-avatar { width: 42px; height: 42px; border-radius: 10px; background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%); color: #fff; font-weight: 700; font-size: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.adm-enquiry-card .adm-name { font-size: 1rem; font-weight: 700; color: #0f172a; }
.adm-enquiry-card .adm-meta { font-size: 0.8rem; color: #64748b; margin-top: 2px; }
.adm-enquiry-card .adm-info-wrap { display: flex; align-items: center; gap: 20px; flex-wrap: wrap; }
.adm-enquiry-card .adm-info-item { font-size: 0.85rem; color: #475569; display: flex; align-items: center; gap: 6px; }
.adm-enquiry-card .adm-info-item i { color: #0073d1; font-size: 12px; }
.adm-enquiry-card .adm-cta-wrap { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }
.adm-enquiry-card .adm-date { font-size: 0.75rem; color: #64748b; background: #f1f5f9; padding: 4px 10px; border-radius: 8px; }
.adm-enquiry-card .adm-cta { display: inline-flex; align-items: center; gap: 6px; font-weight: 600; font-size: 0.85rem; color: #0073d1; padding: 6px 14px; border-radius: 8px; background: #e8f4fc; transition: all 0.2s; }
.adm-enquiry-card:hover .adm-cta { background: #0073d1; color: #fff; }
.adm-enquiry-card .adm-cta i { transition: transform 0.2s; font-size: 11px; }
.adm-enquiry-card:hover .adm-cta i { transform: translateX(2px); }

/* Filter bar - compact, less space */
.adm-filter-wrap { width: 100%; }
.adm-filter-heading { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; margin-bottom: 6px; display: flex; align-items: center; gap: 4px; }
.adm-filter-heading i { font-size: 0.8rem; color: #0073d1; }
.adm-filter-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 14px; box-shadow: 0 1px 2px rgba(0,0,0,.04); border-left: 3px solid #0073d1; }
.adm-filter-form .adm-filter-row { display: flex; flex-wrap: wrap; align-items: flex-end; gap: 10px; }
.adm-filter-form .adm-filter-group { display: flex; flex-direction: column; gap: 4px; flex: 0 0 auto; }
.adm-filter-form .adm-filter-group label { font-size: 0.7rem; font-weight: 600; color: #475569; margin: 0; letter-spacing: 0.02em; }
.adm-filter-form .adm-date-input,
.adm-filter-form .adm-sort-select { height: 36px; border-radius: 6px; border: 1px solid #e2e8f0; padding: 0 10px; font-size: 0.85rem; background: #fff; width: 100%; min-width: 130px; max-width: 145px; color: #334155; transition: border-color .15s, box-shadow .15s; }
.adm-filter-form .adm-date-input:hover,
.adm-filter-form .adm-sort-select:hover { border-color: #cbd5e1; }
.adm-filter-form .adm-date-input:focus,
.adm-filter-form .adm-sort-select:focus { border-color: #0073d1; outline: none; box-shadow: 0 0 0 2px rgba(0,115,209,.12); }
.adm-filter-form .adm-filter-actions { display: flex; flex-direction: column; gap: 4px; flex: 0 0 auto; }
.adm-filter-form .adm-filter-actions .adm-actions-label { font-size: 0.7rem; font-weight: 600; color: #475569; margin: 0; visibility: hidden; }
.adm-filter-form .adm-btn-group { display: flex; align-items: center; gap: 6px; }
.adm-filter-form .btn-apply { height: 36px; padding: 0 16px; border-radius: 6px; font-weight: 600; font-size: 0.8rem; background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%); border: none; color: #fff; cursor: pointer; transition: all 0.2s; white-space: nowrap; box-shadow: 0 1px 2px rgba(0,115,209,.2); }
.adm-filter-form .btn-apply:hover { background: linear-gradient(135deg, #005bb5 0%, #004a94 100%); color: #fff; box-shadow: 0 2px 4px rgba(0,115,209,.3); }
.adm-filter-form .btn-reset { height: 36px; padding: 0 14px; border-radius: 6px; font-weight: 500; font-size: 0.8rem; background: #fff; border: 1px solid #e2e8f0; color: #64748b; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s; white-space: nowrap; }
.adm-filter-form .btn-reset:hover { border-color: #0073d1; color: #0073d1; background: #f0f9ff; }
/* Enquiry header - row 1 */
.adm-enquiry-header .adm-enquiry-title { font-size: 1.15rem; font-weight: 700; color: #0f172a; margin-bottom: 0.25rem; }
.adm-enquiry-header .adm-enquiry-subtitle { font-size: 0.85rem; color: #64748b; line-height: 1.4; }
@media (max-width: 768px) {
    .adm-filter-form .adm-filter-row { flex-direction: column; align-items: stretch; gap: 10px; }
    .adm-filter-form .adm-date-input, .adm-filter-form .adm-sort-select { min-width: 100%; max-width: none; }
    .adm-filter-form .adm-btn-group { justify-content: flex-start; }
}
</style>

@if(session('success_msg'))
    <div class="alert alert-success">{{ session('success_msg') }}</div>
@endif
@if(session('error_msg'))
    <div class="alert alert-danger">{{ session('error_msg') }}</div>
@endif

<div class="col-12">
{{-- Form (collapsible, hidden by default) --}}
<div class="adm-edit-card">
    <div class="adm-form-toggle collapsed" onclick="document.getElementById('adm-form-content').classList.toggle('show'); this.classList.toggle('collapsed');" role="button">
        <span><i class="fa fa-edit me-2" style="color: #0073d1;"></i> {{ __('Add About School / Institution') }}</span>
        <i class="fa fa-chevron-down text-muted"></i>
    </div>
    <div id="adm-form-content" class="adm-form-content">
        <form method="POST" action="{{ route('public.account.admission.update') }}" id="adm-edit-form">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" title="{{ __('Enter details related to admission in your school/institution') }}">
                    {{ __('About School / Institution') }}
                    <i class="fa fa-info-circle text-muted ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Enter details related to admission in your school/institution') }}" aria-label="{{ __('Enter details related to admission in your school/institution') }}"></i>
                </label>
                <textarea name="content" id="adm-about-school-ta" class="form-control adm-about-school" rows="5" maxlength="{{ $maxContent }}" placeholder="{{ __('Enter details related to admission in your school/institution') }}" title="{{ __('Enter details related to admission in your school/institution') }}" data-max-words="{{ $maxWords }}" data-msg-exceed="{{ __('The about school content must not exceed :max words.', ['max' => $maxWords]) }}">{{ old('content', $admission->content ?? '') }}</textarea>
                @error('content')
                    <div class="adm-field-error text-danger small mt-1">{{ $message }}</div>
                @enderror
                <div id="adm-live-word-error" class="adm-word-count-over mt-1" style="display: none;"></div>
                <small class="text-muted adm-word-count">{{ __('Max') }} {{ $maxWords }} {{ __('words') }}. <span class="adm-words" id="adm-word-display">0 / {{ $maxWords }} {{ __('words') }}</span></small>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">{{ __('Admission Deadline') }} <span class="text-danger">*</span></label>
                    <input type="date" name="admission_deadline" class="form-control" value="{{ old('admission_deadline', $admission->admission_deadline?->format('Y-m-d') ?? '') }}" required>
                    @error('admission_deadline')
                        <div class="adm-field-error text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('Status') }}</label>
                    <select name="status" class="form-select">
                        <option value="published" {{ ($admission->status ?? 'published') === 'published' ? 'selected' : '' }}>{{ __('Published') }}</option>
                        <option value="draft" {{ ($admission->status ?? '') === 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="adm-save-btn">{{ __('Save') }}</button>
        </form>
    </div>
</div>

{{-- Enquiries List: Row 1 = title + subtitle, Row 2 = filter --}}
<div class="adm-edit-card" id="admission-enquiries-section">
    {{-- Row 1: Title then Subtitle --}}
    <div class="row adm-enquiry-header mb-2">
        <div class="col-12">
            <h4 class="adm-enquiry-title mb-2"><i class="fa fa-inbox me-2" style="color: #0073d1;"></i> {{ __('Admission Enquiries') }}</h4>
            @if(isset($enquiries) && $enquiries->isNotEmpty())
            <p class="adm-enquiry-subtitle text-muted mb-0">{{ __('Enquiries submitted from the admission form. Click a card to view full details.') }}</p>
            @endif
        </div>
    </div>
    {{-- Row 2: Filter --}}
    @if(isset($enquiries) && $enquiries->isNotEmpty())
    <div class="row mb-3">
        <div class="col-12 mt-2">
            <div class="adm-filter-wrap">
                <p class="adm-filter-heading mb-3"><i class="fa fa-filter"></i> {{ __('Filters') }}</p>
                <div class="adm-filter-card">
                    <form method="get" action="{{ request()->url() }}" id="adm-filter-form" class="adm-filter-form">
                        <input type="hidden" name="sort" id="adm-sort-hidden" value="{{ request('sort', 'newest') }}">
                        <div class="adm-filter-row">
                            <div class="adm-filter-group">
                                <label for="adm-from-date">{{ __('From date') }}</label>
                                <input type="date" id="adm-from-date" name="from_date" class="adm-date-input" value="{{ request('from_date') }}" aria-label="{{ __('From date') }}">
                            </div>
                            <div class="adm-filter-group">
                                <label for="adm-to-date">{{ __('To date') }}</label>
                                <input type="date" id="adm-to-date" name="to_date" class="adm-date-input" value="{{ request('to_date') }}" aria-label="{{ __('To date') }}">
                            </div>
                            <div class="adm-filter-group">
                                <label for="adm-sort-filter">{{ __('Sort by') }}</label>
                                <select id="adm-sort-filter" name="sort" class="adm-sort-select" aria-label="{{ __('Sort by date') }}">
                                    <option value="newest" {{ (request('sort', 'newest') === 'newest') ? 'selected' : '' }}>{{ __('Newest first') }}</option>
                                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>{{ __('Oldest first') }}</option>
                                </select>
                            </div>
                            <div class="adm-filter-actions">
                                <span class="adm-actions-label" aria-hidden="true">{{ __('Actions') }}</span>
                                <div class="adm-btn-group">
                                    <button type="submit" class="btn-apply">{{ __('Apply') }}</button>
                                    <a href="{{ request()->url() }}" class="btn-reset">{{ __('Reset') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
@if(isset($enquiries) && $enquiries->isNotEmpty())
    <div class="row g-2">
        @foreach($enquiries as $eq)
        <div class="col-12">
            <a href="{{ route('public.account.admission.enquiry.show', $eq->id) }}" class="text-decoration-none text-dark d-block">
                <div class="card adm-enquiry-card">
                    <div class="adm-card-inner">
                        <div class="adm-left">
                            <div class="adm-avatar">{{ strtoupper(substr($eq->student_name, 0, 1)) }}</div>
                            <div class="min-w-0">
                                <div class="adm-name">{{ $eq->student_name }}</div>
                                <div class="adm-meta">
                                    @if($eq->company){{ $eq->company->name }} · @endif{{ $eq->admission_for_standard }}
                                </div>
                              
                                <div class="adm-info-wrap mt-1">
                                    <span class="adm-info-item"><i class="fa fa-phone"></i> {{ $eq->contact_number }}</span>
                                    @if($eq->email)
                                    <span class="adm-info-item"><i class="fa fa-envelope"></i> {{ Str::limit($eq->email, 30) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="adm-cta-wrap">
                            <span class="adm-date">{{ $eq->created_at->format('M d, Y') }}</span>
                            <span class="adm-cta">{{ __('View details') }} <i class="fa fa-arrow-right"></i></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class="mt-3">{{ $enquiries->links() }}</div>
@else
    <p class="text-muted mb-0">{{ __('No enquiries yet. They will appear here when someone submits the admission form on your institution page.') }}</p>
@endif
</div>
</div>
@push('footer')
<script>
(function(){
    function countWords(s){ var t=s.replace(/<[^>]*>/g,'').trim(); return t?t.split(/\s+/).length:0; }
    var ta=document.getElementById('adm-about-school-ta')||document.querySelector('.adm-about-school');
    var disp=document.getElementById('adm-word-display');
    var liveErr=document.getElementById('adm-live-word-error');
    var maxWords=parseInt(ta&&ta.dataset.maxWords||125,10);
    var msgExceed=(ta&&ta.getAttribute('data-msg-exceed'))||'The about school content must not exceed '+maxWords+' words.';
    function update(){
        if(!ta||!disp)return;
        var n=countWords(ta.value);
        disp.textContent=n+' / '+maxWords+' {{ __('words') }}';
        disp.className='adm-words'+(n>maxWords?' text-danger':'');
        if(liveErr){
            if(n>maxWords){ liveErr.style.display='block'; liveErr.textContent=msgExceed; }
            else { liveErr.style.display='none'; liveErr.textContent=''; }
        }
    }
    if(ta&&disp){ update(); ta.addEventListener('input',update); ta.addEventListener('paste',function(){ setTimeout(update,10); }); }

    var admForm = document.getElementById('adm-edit-form');
    var saveBtn = document.getElementById('adm-save-btn');
    if (admForm && saveBtn) {
        admForm.addEventListener('submit', function() {
            saveBtn.disabled = true;
            saveBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>{{ __("Saving...") }}';
        });
    }

    var filterForm = document.getElementById('adm-filter-form');
    if (filterForm) {
        var sortFilter = document.getElementById('adm-sort-filter');
        if (sortFilter) sortFilter.addEventListener('change', function() { filterForm.submit(); });
    }
})();
</script>
@endpush
@endsection
