@props(['title' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => '

flex items-center gap-2 p-1 font-semibold text-xs 

uppercase tracking-widest
text-red-700 

hover:text-red-500 

active:text-red-500
']) }}>

        <x-sistem.icons.for-icons-app icon="trash" class="w-6 h-6"/>
          
        {{$slot}}{{ $title }}

</button>
