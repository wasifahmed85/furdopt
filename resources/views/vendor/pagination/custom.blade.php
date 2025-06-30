
@if ($paginator->hasPages())
<div class="pagination">
    <ul class="pagination-list">
        @if ($paginator->onFirstPage())
            <div class="pagination-btn pagination-prev" disabled>
                <i class="prev-icon"></i>
            </div>
        @else
            <div class="pagination-btn pagination-prev">
                <a href="{{ $paginator->previousPageUrl() }}" <i class="prev-icon"></i></a>
            </div>
        @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <div class="pagination-btn pagination-next">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"> <i class="next-icon"></i></a>
            </div>
        @else
            <div class="pagination-btn pagination-next disabled">
                <i class="next-icon"></i>
            </div>
        @endif
        </ul>
        </div>
@endif


