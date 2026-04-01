@if($transactions->isNotEmpty())
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ trans('plugins/job-board::dashboard.wallet_sl_no') }}</th>
                    <th>{{ trans('plugins/job-board::dashboard.wallet_date_of_transaction') }}</th>
                    <th>{{ trans('plugins/job-board::dashboard.wallet_type_of_transaction') }}</th>
                    <th>{{ __('User Type') }}</th>
                    <th>{{ __('User Details') }}</th>
                    <th>{{ __('Institution') }}</th>
                    <th>{{ __('Package') }}</th>
                    <th class="text-end">{{ trans('plugins/job-board::dashboard.wallet_amount_coins') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $index => $transaction)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $transaction->created_at->format('M d, Y H:i') }}</td>
                        <td>{!! BaseHelper::clean($transaction->getDescription()) !!}</td>
                        <td>
                            @if(isset($transaction->account_type) && $transaction->account_type)
                                <span class="badge bg-{{ $transaction->account_type === 'employer' ? 'primary' : 'info' }}">{{ ucfirst(str_replace('_', ' ', $transaction->account_type)) }}</span>
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            @if(isset($transaction->user_details) && $transaction->user_details && is_array($transaction->user_details))
                                <small class="d-block"><strong>{{ $transaction->user_details['name'] ?? '—' }}</strong></small>
                                <small class="text-muted">{{ $transaction->user_details['email'] ?? '' }}</small>
                                @if(!empty($transaction->user_details['phone']))
                                    <small class="d-block">{{ $transaction->user_details['phone'] }}</small>
                                @endif
                                @if(!empty($transaction->user_details['address']))
                                    <small class="d-block text-muted">{{ \Illuminate\Support\Str::limit($transaction->user_details['address'], 30) }}</small>
                                @endif
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ isset($transaction->institution_name) ? $transaction->institution_name : '—' }}</td>
                        <td>{{ isset($transaction->package_name) ? $transaction->package_name : '—' }}</td>
                        <td class="text-end">
                            @if($transaction->isCredit())
                                <span class="text-success">+{{ $transaction->credits }}</span>
                            @else
                                <span class="text-danger">-{{ $transaction->credits }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="mb-0 text-muted text-center">{{ trans('plugins/job-board::account.no_transactions') }}</p>
@endif
