@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
    {{-- Mobile view --}}
    <div class="flex justify-between flex-1 sm:hidden">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
        <span
            class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md cursor-default dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
            {!! __('Previous') !!}
        </span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}"
            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 dark:text-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:hover:text-white">
            {!! __('Previous') !!}
        </a>
        @endif

        {{-- Next --}}
        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
            class="ml-3 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 dark:text-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:hover:text-white">
            {!! __('Next') !!}
        </a>
        @else
        <span
            class="ml-3 px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md cursor-default dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
            {!! __('Next') !!}
        </span>
        @endif
    </div>

    {{-- Desktop view --}}
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-gray-700 dark:text-gray-400">
                {!! __('Showing') !!}
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                {!! __('of') !!}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
        </div>

        <div>
            <span class="relative z-0 inline-flex rounded-md shadow-sm rtl:flex-row-reverse">
                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                <span
                    class="inline-flex items-center px-2 py-2 text-sm text-gray-500 bg-white border border-gray-300 rounded-l-md dark:bg-gray-800 dark:border-gray-600"
                    aria-disabled="true" aria-label="{{ __('Previous') }}">
                    <x-heroicon-o-chevron-left class="w-5 h-5" />
                </span>
                @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="inline-flex items-center px-2 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-l-md hover:text-gray-400 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:text-white"
                    aria-label="{{ __('Previous') }}">
                    <x-heroicon-o-chevron-left class="w-5 h-5" />
                </a>
                @endif

                {{-- Pagination numbers --}}
                @foreach ($elements as $element)
                @if (is_string($element))
                <span
                    class="inline-flex items-center px-4 py-2 text-sm text-gray-500 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-600">{{
                    $element }}</span>
                @endif

                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <span
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-gray-300 cursor-default dark:text-blue-400 dark:bg-gray-800 dark:border-gray-600"
                    aria-current="page">
                    {{ $page }}
                </span>
                @else
                <a href="{{ $url }}"
                    class="inline-flex items-center px-4 py-2 text-sm text-gray-600 bg-white border border-gray-300 hover:text-gray-400 dark:text-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:hover:text-white">
                    {{ $page }}
                </a>
                @endif
                @endforeach
                @endif
                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="inline-flex items-center px-2 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-r-md hover:text-gray-400 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:text-white"
                    aria-label="{{ __('Next') }}">
                    <x-heroicon-o-chevron-right class="w-5 h-5" />
                </a>
                @else
                <span
                    class="inline-flex items-center px-2 py-2 text-sm text-gray-500 bg-white border border-gray-300 rounded-r-md dark:bg-gray-800 dark:border-gray-600"
                    aria-disabled="true" aria-label="{{ __('Next') }}">
                    <x-heroicon-o-chevron-right class="w-5 h-5" />
                </span>
                @endif
            </span>
        </div>
    </div>
</nav>
@endif