@props(['active', 'title'])

@php
$classes = ($active ?? false)
            ? 'flex items-center justify-start gap-1  p-2 text-gray-900 rounded-lg bg-primary-300 group'
            : 'flex items-center justify-start gap-1  p-2 text-gray-900 rounded-lg hover:bg-primary-200 group';
@endphp

<li>
    <a {!! $attributes->merge(['class' => $classes]) !!}>
        <span>{{$slot}}</span>
        <span class="ms-3">{{$title}}</span>
    </a>
</li>