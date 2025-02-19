@props(['title', 'link'])

<a {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-orante-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}

    href="{{$link}}"
>
    {{ $title }}
</a>
