@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- 前へ --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&lsaquo;</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">&lsaquo;</a></li>
            @endif

            {{-- ページ番号 --}}
            @php
                $maxLinks = 5;
                $half = floor($maxLinks / 2);

                $start = $paginator->currentPage() - $half;
                $end = $paginator->currentPage() + $half;

                if ($start < 1) {
                    $end += 1 - $start;
                    $start = 1;
                }

                if ($end > $paginator->lastPage()) {
                    $start -= $end - $paginator->lastPage();
                    $end = $paginator->lastPage();
                }

                if ($start < 1) $start = 1;
            @endphp

            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @endif
            @endfor

            {{-- 次へ --}}
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">&rsaquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">&rsaquo;</span></li>
            @endif
        </ul>
    </nav>
@endif
