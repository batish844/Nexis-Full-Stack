<div class="flex pagination mt-6 justify-center w-full">
    @if ($items->hasPages())
        <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center">
            <!-- Mobile View: Previous and Next Buttons -->
            <div class="flex justify-center flex-1 sm:hidden">
                @if ($items->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-gray-200 border border-gray-300 cursor-default rounded-md leading-5 dark:bg-gray-800 dark:border-gray-600">
                        {!! __('pagination.previous') !!}
                    </span>
                @else
                    <a href="{{ $items->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-blue-300 text-white border border-gray-300 rounded-md hover:text-gray-500 focus:ring focus:ring-blue-300 active:bg-gray-100 transition duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:text-gray-200 dark:focus:ring-blue-700">
                        {!! __('pagination.previous') !!}
                    </a>
                @endif

                @if ($items->hasMorePages())
                    <a href="{{ $items->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium bg-blue-300 text-white border border-gray-300 rounded-md hover:text-gray-500 focus:ring focus:ring-blue-300 active:bg-gray-100 transition duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:text-gray-200 dark:focus:ring-blue-700">
                        {!! __('pagination.next') !!}
                    </a>
                @else
                    <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-gray-200 border border-gray-300 cursor-default rounded-md leading-5 dark:bg-gray-800 dark:border-gray-600">
                        {!! __('pagination.next') !!}
                    </span>
                @endif
            </div>

            <!-- Desktop View: Page Numbers and Previous/Next Buttons -->
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div class="relative z-0 inline-flex shadow-sm rounded-md">
                    <!-- Previous Page Link -->
                    @if ($items->onFirstPage())
                        <span aria-disabled="true" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-200 bg-gray-300 border border-gray-300 cursor-default rounded-l-md leading-5 dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @else
                        <a href="{{ $items->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:outline-none focus:ring focus:ring-blue-300 active:bg-gray-100 active:text-gray-500 transition duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:text-gray-200 dark:focus:ring-blue-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    <!-- Page Numbers -->
                    <div class="inline-flex items-center">
                        {{ $items->links() }}
                    </div>

                    <!-- Next Page Link -->
                    @if ($items->hasMorePages())
                        <a href="{{ $items->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:outline-none focus:ring focus:ring-blue-300 active:bg-gray-100 active:text-gray-500 transition duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:text-gray-200 dark:focus:ring-blue-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-200 bg-gray-300 border border-gray-300 cursor-default rounded-r-md leading-5 dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @endif
                </div>
            </div>
        </nav>
    @endif
</div>

