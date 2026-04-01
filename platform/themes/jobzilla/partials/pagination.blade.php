@if ($paginator->hasPages())
    <div class="pagination-outer">
        <div class="pagination-style1">
            <ul class="clearfix pagination">
                @if ($paginator->onFirstPage())
                    <li class="prev disabled">
                        <a href="javascript:;" class="disabled">
                            <span>
                                <i class="fa fa-angle-left"></i>
                            </span>
                        </a>
                    </li>
                @else
                    <li class="prev">
                        <a href="{{ $paginator->previousPageUrl() }}">
                            <span>
                                <i class="fa fa-angle-left"></i>
                            </span>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled"><a href="javascript:;">{{ $element }}</a></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active" aria-current="page">
                                    <a class="pagination-button" href="javascript:;" data-page="{{ $page }}">{{ $page }}</a>
                                </li>
                            @else
                                <li><a class="pagination-button" href="{{ $url }}" data-page="{{ $page }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if ($paginator->hasMorePages())
                    <li class="next">
                        <a href="{{ $paginator->nextPageUrl() }}">
                            <span>
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                @else
                    <li class="next disabled">
                        <a href="javascript:;">
                            <span>
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endif
