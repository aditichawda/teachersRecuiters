@php
    $menuItems = DashboardMenu::getAll('account');
    $currentUrl = url()->current();
    $isCreateJobPage = $currentUrl == route('public.account.jobs.create');
@endphp

<style>
.ps-postjob-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    margin: 0 12px 10px 12px;
    background: linear-gradient(135deg, #0073d1, #005bb5);
    color: #fff !important;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none !important;
    transition: all 0.2s;
    justify-content: center;
}
.ps-postjob-btn:hover {
    background: linear-gradient(135deg, #005bb5, #003f8a);
    color: #fff !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,115,209,0.3);
}
.ps-postjob-btn i {
    font-size: 16px;
}
</style>

{{-- Post Job Button --}}
<a href="{{ route('public.account.jobs.create') }}" class="ps-postjob-btn">
    <i class="fa fa-plus-circle"></i> {{ __('Post Job') }}
</a>
@if(optional(auth('account')->user())->isEmployer())
{{-- Admission Button --}}
<a href="{{ route('public.account.admission.edit') }}" class="ps-postjob-btn" style="background: linear-gradient(135deg, #059669, #047857); margin-top: 8px;">
    <i class="fa fa-graduation-cap"></i> {{ __('Admission') }}
</a>
@endif

<ul class="menu">
    @foreach ($menuItems as $item)
        @continue(! $item['name'])
        @php
            $employerOnlyIds = ['cms-account-wallet', 'cms-account-packages', 'cms-account-invoices'];
            if (in_array($item['id'] ?? '', $employerOnlyIds) && !optional(auth('account')->user())->isEmployer()) {
                continue;
            }
        @endphp
        <li>
            <a
                href="{{ $item['url']  }}"
                @class(['active' => $item['active']])
            >
                <x-core::icon :name="$item['icon']" />
                {{ trans($item['name']) }}
            </a>
        </li>
    @endforeach
</ul>
