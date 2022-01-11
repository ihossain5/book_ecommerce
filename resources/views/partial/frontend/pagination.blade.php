@if ($paginator->hasPages())
    <!-- pagination -->
    <div class="container">
        <nav aria-label="Page navigation " class="pagination_tabs">
            <ul class="pagination justify-content-center justify-content-lg-end">
                @if ($paginator->onFirstPage())
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only"></span>
                        </a>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only"></span>
                        </a>
                    </li>
                @endif

                @foreach ($elements as $element)
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item"><a class="page-link" href="">{{ $page }}</a></li>
                            @else

                                <li class="page-item"><a class="page-link"
                                        href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach



                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next"  aria-label="@lang('pagination.next')">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only"></span>
                        </a>
                    </li>
                    @else 
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0)" aria-label="Next"  aria-label="@lang('pagination.next')">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only"></span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

@endif


