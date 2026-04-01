@foreach ($categories->chunk(ceil($categories->count() / 3)) as $chunks)
    <div class="col-lg-4">
        <div class="card job-Categories-box bg-light border-0">
            <div class="card-body p-4">
                <ul class="list-unstyled job-Categories-list mb-0">
                    @foreach ($chunks as $category)
                        <li>
                            <a
                                class="primary-link"
                                href="{{ $category->url }}"
                            >
                                <span>{{ $category->name }}</span>

                                @if (($shortcode->show_jobs_count ?? 'yes') == 'yes')
                                    <span class="badge bg-soft-info float-end">{{ number_format($category->active_jobs_count) }}</span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endforeach
