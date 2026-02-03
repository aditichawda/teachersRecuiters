@php
    Theme::set('pageTitle', __('Educations'));
@endphp

@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'))

@section('content')
    <section class="job-seeker-education">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('public.account.educations.create') }}" class="site-button">{{ __('Add education') }}</a>
            </div>

            @forelse($educations as $education)
                <div class="row box-timeline">
                    <div class="col-md-3 timeline-year">
                        <span class="year">{{ $education->started_at->format('Y/m') }} -
                            {{ $education->ended_at ? $education->ended_at->format('Y/m'): __('Now') }}
                        </span>
                    </div>
                    <div class="col-md-9 timeline-info">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="text-primary">{!! BaseHelper::clean($education->school) !!}</h4>
                                @if ($specialized = $education->specialized)
                                    <span class="text-secondary">{!! BaseHelper::clean($specialized) !!}</span>
                                @endif

                                @if ($description = $education->description)
                                    <div class="description mt-2">
                                        {!! Str::limit($description, 200) !!}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-3 timeline-actions">
                                <a href="{{ route('public.account.educations.edit', $education->id) }}" class="btn-action"><i class="feather-edit"></i></a>
                                <form method="post" action="{{ route('public.account.educations.destroy', $education->id) }}">
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
