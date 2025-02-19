@props(['type' => 'textarea', 'placeholder' => 'Descripcion','disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} type="{{ $type }}" placeholder="{{ $placeholder }}" {!! $attributes->merge(['class' => '
resize-none 
block w-full 
text-sm rounded-lg shadow-md
my-1 p-2 

bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-purple-600 focus:border-purple-600 
']) !!}  rows="4"></textarea>
