@props([
    'title_1' => '',
    'link_1' => '#',
    'title_2' => '',
    'link_2' => '#',
    'title_3' => '',
    'link_3' => '#',
    'title_4' => '',
    'link_4' => '#',
])

<nav class="flex mb-2" aria-label="Breadcrumb">
    
    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">

      @if ($title_1)
        <li class="inline-flex items-center">
          <a href="{{ $link_1 }}" class="inline-flex items-center text-purple-700 hover:text-purple-600">
            <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
            {{ $title_1 }}
          </a>
        </li>
      @endif
    
      @if ($title_2)
        <li>
          <div class="flex items-center">
            <svg class="w-6 h-6 text-purple-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            <a href="{{ $link_2 }}" class="ml-1 text-purple-700 hover:text-purple-600 md:ml-2 dark:text-purple-300 dark:hover:text-white">{{ $title_2 }}</a>
          </div>
        </li>
      @endif
    
      @if ($title_3)
        <li>
          <div class="flex items-center">
            <svg class="w-6 h-6 text-purple-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            <a href="{{ $link_3 }}" class="ml-1 text-purple-700 hover:text-purple-600 md:ml-2 dark:text-purple-300 dark:hover:text-white">{{ $title_3 }}</a>
          </div>
        </li>
      @endif
    
      @if ($title_4)
        <li>
          <div class="flex items-center">
            <svg class="w-6 h-6 text-purple-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            <a href="{{ $link_4 }}" class="ml-1 text-purple-700 hover:text-purple-600 md:ml-2 dark:text-purple-300 dark:hover:text-white">{{ $title_3 }}</a>
          </div>
        </li>
      @endif
    
    </ol>
</nav>