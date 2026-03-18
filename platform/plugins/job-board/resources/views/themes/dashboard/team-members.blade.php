@extends(JobBoardHelper::viewPath('dashboard.layouts.master'))

@section('content')
<div class="team-members-page">
    <x-core::card>
        <x-core::card.header>
            <x-core::card.title>
                <x-core::icon name="ti ti-users-group" class="me-2" />
                {{ __('Staff / Team Members') }}
            </x-core::card.title>
            <p class="text-muted small mb-0 mt-1">
                {{ __('Staff accounts created via Multiple Login (Wallet). They can log in with their own email and password.') }}
            </p>
        </x-core::card.header>
        <x-core::card.body>
            @if($staff->isEmpty())
                <div class="text-center py-5">
                    <x-core::icon name="ti ti-users-group" class="text-muted" style="font-size: 3rem;" />
                    <p class="text-muted mt-3 mb-2">{{ __('No staff members yet.') }}</p>
                    <p class="small text-muted">{{ __('Add staff from Wallet → Use credits for Multiple Login (250 credits per staff).') }}</p>
                    <a href="{{ route('public.account.wallet') }}" class="btn btn-primary btn-sm mt-2">
                        <x-core::icon name="ti ti-wallet" class="me-1" />
                        {{ __('Go to Wallet') }}
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Role') }}</th>
                                <th>{{ __('Added on') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($staff as $index => $member)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ trim($member->first_name . ' ' . $member->last_name) ?: '—' }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->sub_account_role ?: '—' }}</td>
                                    <td>{{ $member->created_at ? $member->created_at->format('M d, Y') : '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="small text-muted mt-3 mb-0">
                    {{ __('To add more staff, use Wallet → Multiple Login (250 credits per staff).') }}
                    <a href="{{ route('public.account.wallet') }}">{{ __('Wallet') }}</a>
                </p>
            @endif
        </x-core::card.body>
    </x-core::card>
</div>
@stop
