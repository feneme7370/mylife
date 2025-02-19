@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div>
    @if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">

        <!-- simple pagination -->
        <div class="flex flex-col gap-1 my-1 w-full sm:hidden">
            <div class="flex justify-between flex-1 sm:hidden px-2 my-1">
                <span>
    
                    <!-- anterior grisado o no-->
                    @if ($paginator->onFirstPage())
                    <span
                        class="relative inline-flex items-center px-4 py-2 ml-3 text-sm text-purple-500 bg-white border border-purple-300 cursor-default leading-5 rounded-md">
                        {!! __('pagination.previous') !!}
                    </span>
                    @else
                    <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                        x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
                        dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-purple-700 bg-white border border-purple-300 leading-5 rounded-md hover:text-purple-500 focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 active:bg-purple-100 active:text-purple-700 transition ease-in-out duration-150">
                        {!! __('pagination.previous') !!}
                    </button>
                    @endif
                </span>
    
                <span>
                    <!-- siguiente grisado o no-->
                    @if ($paginator->hasMorePages())
                    <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                        x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
                        dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                        class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-purple-700 bg-white border border-purple-300 leading-5 rounded-md hover:text-purple-500 focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 active:bg-purple-100 active:text-purple-700 transition ease-in-out duration-150">
                        {!! __('pagination.next') !!}
                    </button>
                    @else
                    <span
                        class="relative inline-flex items-center px-4 py-2 ml-3 text-sm text-purple-500 bg-white border border-purple-300 cursor-default leading-5 rounded-md">
                        {!! __('pagination.next') !!}
                    </span>
                    @endif
                </span>
            </div>
            <div class="mx-auto sm:hidden">
                <p
                    class="">
                    <span>{!! __('pagination.showing') !!}</span>
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    <span>{!! __('pagination.to') !!}</span>
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    <span>{!! __('pagination.of') !!}</span>
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    <span>{!! __('pagination.results') !!}</span>
                </p>
            </div>
        
        </div>


        <!-- vista completa -->
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between p-4 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">

            <!-- informacion izquierda paginacion-->
            <div>
                <p
                    class="">
                    <span>{!! __('pagination.showing') !!}</span>
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    <span>{!! __('pagination.to') !!}</span>
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    <span>{!! __('pagination.of') !!}</span>
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    <span>{!! __('pagination.results') !!}</span>
                </p>
            </div>

            <div>
                <span
                    class="relative z-0 inline-flex items-center">
                    <span>

                        <!-- icono de anterior -->
                        @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span
                                class="px-3 py-2 rounded-sm rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                        @else
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                            dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                            rel="prev"
                            class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                            aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        @endif
                    </span>


                    @foreach ($elements as $element)

                    <!-- puntos separadores -->
                    @if (is_string($element))
                    <span aria-disabled="true">
                        <span class="px-3 py-1">{{ $element }}</span>
                    </span>
                    @endif

                    <!-- numeros de la paginacion -->
                    @if (is_array($element))
                    @foreach ($element as $page => $url)
                    
                    <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                        <!-- numero seleccionado -->
                        @if ($page == $paginator->currentPage())
                        <span aria-current="page">
                            <span
                                class="px-3 py-2 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">{{
                                $page }}</span>
                        </span>

                        <!-- numeros no seleccionados -->
                        @else
                        <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                            class="px-3 py-2 rounded-md focus:outline-none focus:shadow-outline-purple"
                            aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                            {{ $page }}
                        </button>
                        @endif
                    </span>
                    @endforeach
                    @endif
                    @endforeach

                    <span>
                        {{-- Next Page Link --}}

                        <!-- icono siguiente -->
                        @if ($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                            dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                            rel="next"
                            class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                            aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span
                                class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                        @endif
                    </span>
                </span>
            </div>
        </div>
    </nav>
    @endif
    </div>