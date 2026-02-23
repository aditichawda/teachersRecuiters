@extends(JobBoardHelper::viewPath('dashboard.layouts.master'))

@section('content')
@php
    $maxWords = 250;
    $maxContent = (int) setting('admission_about_school_max_length', 1750);
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
        <span><i class="fa fa-edit me-2" style="color: #0073d1;"></i> {{ __('Edit About School / Institution') }}</span>
        <i class="fa fa-chevron-down text-muted"></i>
    </div>
    <div id="adm-form-content" class="adm-form-content">
        <form method="POST" action="{{ route('public.account.admission.update') }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" title="{{ __('Enter details related to admission in your school/institution') }}">
                    {{ __('About School / Institution') }}
                    <i class="fa fa-info-circle text-muted ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Enter details related to admission in your school/institution') }}" aria-label="{{ __('Enter details related to admission in your school/institution') }}"></i>
                </label>
                <textarea name="content" class="form-control adm-about-school" rows="5" maxlength="{{ $maxContent }}" placeholder="{{ __('Enter details related to admission in your school/institution') }}" title="{{ __('Enter details related to admission in your school/institution') }}" data-max-words="{{ $maxWords }}">{{ old('content', $admission->content ?? '') }}</textarea>
                <small class="text-muted adm-word-count">{{ __('Max') }} {{ $maxWords }} {{ __('words') }}. <span class="adm-words" id="adm-word-display">0 / {{ $maxWords }} {{ __('words') }}</span></small>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">{{ __('Admission Deadline') }}</label>
                    <input type="date" name="admission_deadline" class="form-control" value="{{ old('admission_deadline', $admission->admission_deadline?->format('Y-m-d') ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('Status') }}</label>
                    <select name="status" class="form-select">
                        <option value="published" {{ ($admission->status ?? 'published') === 'published' ? 'selected' : '' }}>{{ __('Published') }}</option>
                        <option value="draft" {{ ($admission->status ?? '') === 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </form>
    </div>
</div>

{{-- Enquiries List --}}
<div class="adm-edit-card" id="admission-enquiries-section">
    <h4><i class="fa fa-inbox me-2" style="color: #0073d1;"></i> {{ __('Admission Enquiries') }}</h4>
@if(isset($enquiries) && $enquiries->isNotEmpty())
    <p class="text-muted small mb-4" style="font-size: 0.9rem;">{{ __('Enquiries submitted from the admission form. Click a card to view full details.') }}</p>
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
    function countWords(s){ var t=s.trim(); return t?t.split(/\s+/).length:0; }
    var ta=document.querySelector('.adm-about-school');
    var disp=document.getElementById('adm-word-display');
    var maxWords=parseInt(ta&&ta.dataset.maxWords||250,10);
    function update(){ if(!ta||!disp)return; var n=countWords(ta.value); disp.textContent=n+' / '+maxWords+' {{ __('words') }}'; disp.className='adm-words'+(n>maxWords?' text-danger':''); }
    if(ta&&disp){ update(); ta.addEventListener('input',update); ta.addEventListener('paste',function(){ setTimeout(update,10); }); }
})();
</script>
@endpush
@endsection
