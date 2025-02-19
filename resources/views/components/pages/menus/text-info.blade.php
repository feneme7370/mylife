@props(['title' => ''])

<div {{ $attributes->merge(['class' => '
    text-xs text-gray-700 mb-2
']) }}>       

        {{ $title }}{{$slot}}

</div>
