@php
    Theme::set('pageTitle', __('Experiences'));
@endphp

@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'))

@section('content')
    <section class="job-seeker-education">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('public.account.experiences.create') }}" class="site-button">{{ __('Add experience') }}</a>
            </div>

            @forelse($experiences as $experience)
                <div class="row box-timeline">
                    <div class="col-md-3 timeline-year">
                        <span class="year">{{ $experience->started_at->format('Y/m') }} -
                            {{ $experience->ended_at ? $experience->ended_at->format('Y/m'): __('Now') }}
                        </span>
                    </div>
                    <div class="col-md-9 timeline-info">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="text-primary">{!! BaseHelper::clean($experience->company) !!}</h4>
                                @if ($position = $experience->position)
                                    <span class="text-secondary">{!! BaseHelper::clean($position) !!}</span>
                                @endif

                                @if ($description = $experience->description)
                                    <div class="description mt-2">
                                        {!! Str::limit($description, 200) !!}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-3 timeline-actions">
                                <a href="{{ route('public.account.experiences.edit', $experience->id) }}" class="btn-action"><i class="feather-edit"></i></a>
                                <form method="post" action="{{ route('public.account.experiences.destroy', $experience->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('{{ __('Are you sure you want to delete this item?') }}');" type="submit"  class="btn-action mx-2 btn btn-remove"><i class="feather-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>{{ __('No data available') }}</p>
            @endforelse
        </div>
    </section>
@endsection
