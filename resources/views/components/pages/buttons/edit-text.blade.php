@props(['title' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => '

flex items-center gap-2 p-1 font-semibold text-xs 

uppercase tracking-widest
text-blue-700 

hover:text-blue-500 

active:text-blue-500
']) }}>
    <div class="flex flex-row gap-1 items-center">
        
        <x-sistem.icons.for-icons-app icon="edit" class="w-6 h-6"/>
        {{ $title }}{{$slot}}
    </div>
</button>
