@if ($paginator->hasPages())
    <ul class="page-numbers nav-pagination links text-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li><span aria-current="page" class="page-number current"><i class="icon-angle-left"></i></span></li>
        @else
            <li><a class="page-number" href="{{ $paginator->previousPageUrl() }}"><i class="icon-angle-left"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li><span class="page-number">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><span aria-current="page" class="page-number current">{{ $page }}</span></li>
                    @else
                        <li><a class="page-number" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a class="next page-number" href="{{ $paginator->nextPageUrl() }}"><i class="icon-angle-right"></i></a></li>
        @else
            <li><span aria-current="page" class="page-number current"><i class="icon-angle-right"></i></span></li>
        @endif
    </ul>
@endif
