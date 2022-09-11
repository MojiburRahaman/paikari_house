<div class="aiz-pagination aiz-pagination-center mt-4">
    <nav>
        <ul class="pagination">
            @if ($paginator->hasPages())

            @if ($paginator->onFirstPage())

            <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                <span class="page-link" aria-hidden="true">‹</span>
            </li>
            @else

            <li class="page-item " aria-disabled="true" aria-label="« Previous">
                <a href="{{$paginator->previousPageUrl()}}">
                    <span class="page-link" aria-hidden="true">‹</span>
                </a>
            </li>
            @endif

            @foreach ($elements as $element)

            @if (is_string($element))
            <li class="disabled"><span>{{ $element }}</span></li>
            @endif



            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
            @else
            <li class="page-item " aria-current="page">
                <a href="{{ $url }}">
                    <span class="page-link">{{ $page }}</span>
                </a>
            </li>
            @endif
            @endforeach
            @endif
            @endforeach


            &nbsp;
            <span>
                @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{$paginator->nextPageUrl()}}" rel="next" aria-label="Next »">›</a>
                </li>
                @else
                <li class="page-item disabled">
                    <a class="page-link" href="" rel="next" aria-label="Next »">›</a>
                </li>
            </span>
            @endif

            @endif
        </ul>
    </nav>
</div>