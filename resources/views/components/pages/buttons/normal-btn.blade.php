@props(['title' => '', 'icon' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => '

    flex items-center justify-center gap-1

    text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-600 font-medium rounded-lg text-sm px-2 py-1 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800

    ']) }}
    wire:loading.class="opacity-50"
    wire:loading.attr="disabled"
>
    {{$icon}}
    <span>{{ $slot }}{{ $title }}</span>
</button>