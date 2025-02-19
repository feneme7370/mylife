@props(['type' => 'radio', 'placeholder' => 'Buscar','disabled' => false])

<input type="{{ $type }}" placeholder="{{ $placeholder }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '
w-4 h-4 

bg-gray-50 border border-gray-300 sm:text-sm rounded-md 
text-purple-800

focus:ring-purple-600 
focus:border-purple-600 

']) !!}>