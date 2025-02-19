@props(['value' => ''])

<label {{ $attributes->merge(['class' => '
flex flex-row items-center justify-start gap-1
mt-1
text-sm text-gray-700
']) }}>
    {{ $slot }}{{ $value }}
</label>
