@php
    $account = auth('account')->user();
    $isJobSeeker = $account && $account->isJobSeeker();
    $jobSeekerMenuIds = [
        'cms-account-dashboard',
        'cms-account-packages',
        'cms-account-wallet',
        'cms-account-invoices',
        'cms-account-settings',
        'cms-account-change-password',
    ];
    $menuItems = collect(DashboardMenu::getAll('account'))->filter(function ($item) use ($isJobSeeker, $jobSeekerMenuIds) {
        if (empty($item['name'])) {
            return false;
        }
        if ($isJobSeeker) {
            return in_array($item['id'] ?? '', $jobSeekerMenuIds);
        }
        return true;
    });
@endphp
<ul class="menu">
    @foreach ($menuItems as $item)
        <li>
            @php
                $url = $item['url'] ?? '#';
                if ($isJobSeeker && ($item['id'] ?? '') === 'cms-account-settings' && \Illuminate\Support\Facades\Route::has('public.account.settings')) {
                    $url = route('public.account.settings');
                }
            @endphp
            <a
                href="{{ $url }}"
                @class(['active' => $item['active'] ?? false])
            >
                <x-core::icon :name="$item['icon'] ?? 'ti ti-circle'" />
                {{ trans($item['name']) }}
            </a>
        </li>
    @endforeach
</ul>
