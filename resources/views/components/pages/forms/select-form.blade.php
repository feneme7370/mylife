@props(['disabled' => false, 'value_empty' => true, 'value_placeholder' => '-- Seleccionar --'])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '
block w-full 
text-sm rounded-lg shadow-md
my-1 p-2 

bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-purple-600 focus:border-purple-600 
']) !!}>
    @if ($value_empty)
        <option value="">{{ $value_placeholder }}</option>
    @endif
    {{ $slot }}
</select>