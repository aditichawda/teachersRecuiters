@if($company->jobs_count === 1)
    {{ __(':count Job Opening ', ['count' => $company->jobs_count]) }}
@elseif($company->jobs_count > 1)
    {{ __(':count Job Openings', ['count' => $company->jobs_count]) }}
@else
    {{ __('No Job Openings') }}
@endif
