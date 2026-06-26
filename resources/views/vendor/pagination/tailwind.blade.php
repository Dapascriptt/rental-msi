{{-- Light Tailwind Pagination (Custom UI Match Admin Panel) --}}

@if ($paginator->hasPages())
    <nav class="flex items-center justify-between px-0 py-3 text-xs font-bold uppercase tracking-widest text-gray-500">

        {{-- PREVIOUS --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 border border-gray-200 bg-gray-50 text-gray-400 rounded-md cursor-not-allowed">
                ‹ Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="px-4 py-2 border border-gray-300 bg-slate-50 text-gray-700 hover:text-yellow-600 hover:bg-yellow-50 hover:border-yellow-400 transition rounded-md shadow-sm">
                ‹ Previous
            </a>
        @endif

        {{-- PAGINATION NUMBERS --}}
        <div class="hidden sm:flex items-center gap-2">

            @foreach ($elements as $element)

                {{-- DOTS --}}
                @if (is_string($element))
                    <span class="px-3 py-2 text-gray-400">...</span>
                @endif

                {{-- PAGES --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-2 border border-yellow-400 bg-yellow-50 text-yellow-700 rounded-md shadow-sm">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="px-3 py-2 border border-gray-300 bg-slate-50 text-gray-600 hover:text-yellow-600 hover:bg-yellow-50 hover:border-yellow-400 transition rounded-md shadow-sm">
                                {{ $page }}
                            </a>
                        @endif

                    @endforeach
                @endif

            @endforeach

        </div>

        {{-- NEXT --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="px-4 py-2 border border-gray-300 bg-slate-50 text-gray-700 hover:text-yellow-600 hover:bg-yellow-50 hover:border-yellow-400 transition rounded-md shadow-sm">
                Next ›
            </a>
        @else
            <span class="px-4 py-2 border border-gray-200 bg-gray-50 text-gray-400 rounded-md cursor-not-allowed">
                Next ›
            </span>
        @endif

    </nav>
@endif