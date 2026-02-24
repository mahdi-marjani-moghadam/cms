@if ($paginator->hasPages())
    <nav role="navigation" class="">
        <ul class="pagination flex">
            {{-- Previous Page Link اصلاح شده --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="قبلی">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    @php
                        $prev = $paginator->currentPage() - 1;
                    @endphp
                    <a href="{{ $prev == 1 ? $paginator->path() : $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="قبلی">&lsaquo;</a>
                </li>
            @endif

            <?php
        $start = $paginator->currentPage() - 1; // show 1 link before current
        $end = $paginator->currentPage() + 1;   // show 1 link after current
        if ($start < 1) {
            $start = 1;
            $end += 1;
        }
        if ($end >= $paginator->lastPage()) {
            $end = $paginator->lastPage();
        }
                ?>

            {{-- لینک صفحه اول جدا --}}
            @if ($start > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->path() }}">1</a>
                </li>
                @if ($paginator->currentPage() != 4)
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                @endif
            @endif

            {{-- حلقه صفحات --}}
            @for ($i = $start; $i <= $end; $i++)
                <li class="page-item {{ $paginator->currentPage() == $i ? ' active' : '' }}">
                    <a class="page-link" href="{{ $i == 1 ? $paginator->path() : $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- لینک آخر --}}
            @if ($end < $paginator->lastPage())
                @if ($paginator->currentPage() + 3 != $paginator->lastPage())
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="بعدی">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="بعدی">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
