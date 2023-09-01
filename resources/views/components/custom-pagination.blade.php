@props(['paginator', 'paginationId'])

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-start text-sm gap-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="text-gray-500" aria-disabled="true"><i class="fa-solid fa-circle-arrow-left text-md"></i></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="text-amber-600 hover:text-amber-700"><i class="fa-solid fa-circle-arrow-left"></i></a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="text-amber-600 hover:text-amber-700"><i class="fa-solid fa-circle-arrow-right"></i></a>
        @else
            <span class="text-gray-500" aria-disabled="true"><i class="fa-solid fa-circle-arrow-right"></i></span>
        @endif
    </nav>
@endif