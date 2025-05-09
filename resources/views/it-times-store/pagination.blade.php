<!-- pagination -->
<nav class="flex justify-center my-5 bg-white dark:bg-background-dark border border-gray-300 drop-shadow-sm py-4 rounded-lg items-center gap-x-1"
    aria-label="Pagination">
    @if ($paginator->hasPages())
        @if ($paginator->onFirstPage())
            <span
                class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
                aria-label="Previous" disabled="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="shrink-0 size-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
                <span>قبلی</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg  hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
                aria-label="Previous" disabled="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="shrink-0 size-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
                <span>قبلی</span>
            </a>
        @endif


        <div class="flex items-center gap-x-1">

            @php
                $start = $paginator->currentPage() - 1; // show 3 pagination links before current
                $end = $paginator->currentPage() + 1; // show 3 pagination links after current
                if ($start < 1) {
                    $start = 1; // reset start to 1
                    $end += 1;
                }
                if ($end >= $paginator->lastPage()) {
                    $end = $paginator->lastPage();
                } // reset end to last page
            @endphp

            @if ($start > 1)
                <a href="{{ $paginator->url(1) }}" class="min-h-9.5 min-w-9.5 flex justify-center items-center
                                                                    {{ $paginator->currentPage() == 1 ? ' bg-gray-200' : '' }} text-gray-800 py-2 px-3 text-sm rounded-lg
                                                                    focus:outline-hidden focus:bg-gray-300 disabled:opacity-50
                                                                    disabled:pointer-events-none dark:bg-neutral-600 dark:text-white
                                                                    dark:focus:bg-neutral-500" aria-current="page">1</a>
                @if ($paginator->currentPage() >= 4 )
                    {{-- "Three Dots" Separator --}}
                    <span class="min-h-9.5 min-w-9.5 flex justify-center items-center
                                                                                text-gray-800 py-2 px-3 text-sm rounded-lg
                                                                                focus:outline-hidden disabled:opacity-50
                                                                                disabled:pointer-events-none dark:bg-neutral-600
                                                                                dark:text-white ">...</span>
                @endif
            @endif

            @for ($i = $start; $i <= $end; $i++)
                <a href="{{ $paginator->url($i) }}" class=" {{ $paginator->currentPage() == $i ? ' bg-gray-200' : '' }} min-h-9.5 min-w-9.5 flex justify-center items-center
                                                                    text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg
                                                                    focus:outline-hidden focus:bg-gray-100 disabled:opacity-50
                                                                    disabled:pointer-events-none dark:text-white dark:hover:bg-white/10
                                                                    dark:focus:bg-white/10">{{ $i }}</a>
            @endfor

            @if ($end < $paginator->lastPage())
                @if ($paginator->lastPage() > 4 && $paginator->currentPage() + 1 != $paginator->lastPage() - 1 )
                    {{-- "Three Dots" Separator --}}
                    <span class="min-h-9.5 min-w-9.5 flex justify-center items-center
                                                                                text-gray-800 py-2 px-3 text-sm rounded-lg
                                                                                focus:outline-hidden disabled:opacity-50
                                                                                disabled:pointer-events-none dark:bg-neutral-600
                                                                                dark:text-white ">...</span>
                @endif
                <a class="min-h-9.5 min-w-9.5 flex justify-center items-center
                                                                    {{ $paginator->currentPage() == $paginator->lastPage() ? ' bg-gray-200' : '' }} text-gray-800 py-2 px-3 text-sm rounded-lg
                                                                    focus:outline-hidden focus:bg-gray-300 disabled:opacity-50
                                                                    disabled:pointer-events-none dark:bg-neutral-600 dark:text-white
                                                                    dark:focus:bg-neutral-500"
                    href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
            @endif

        </div>


        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
                aria-label="Next">
                <span>بعدی</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="shrink-0 size-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </a>
        @else
            <span
                class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
                aria-label="Next" disabled="">
                <span>بعدی</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="shrink-0 size-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </span>
        @endif



    @endif
    <div class="absolute left-10">
        تعداد کل: {{ $paginator->total() }}
    </div>
</nav>
