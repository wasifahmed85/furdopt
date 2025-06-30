<div class="pagination">
    @if ($paginator->hasPages())
    <ul class="pagination-list">
        @if ($paginator->onFirstPage())
        <li><a href="#" class="page-number prev" disabled>←</a></li>
    @else

        <li><a href="{{ $paginator->previousPageUrl() }}" wire:navigate class="page-number prev" disabled>←</a></li>
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
                    <li class="page-number current" aria-current="page" wire:navigate ><span>{{ $page }}</span></li>
                @else
                    <li class="page-number"><a href="{{ $url }}" wire:navigate>{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
        @endforeach

        @if ($paginator->hasMorePages())

        <li><a href="{{ $paginator->nextPageUrl() }}" wire:navigate class="page-number next">→</a></li>
    @else
    <li><a href="#" class="page-number next" disabled>→</a></li>
    @endif


    </ul>
    @endif
</div>





