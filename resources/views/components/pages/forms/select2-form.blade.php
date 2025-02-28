@props(['disabled' => false, 'value_empty' => true, 'value_placeholder' => '-- Seleccionar --', 'id' => ''])

<select {{ $disabled ? 'disabled' : '' }} id="{{ $id }}" {!! $attributes->merge(['class' => '
block w-full 
rounded-lg shadow-md
my-1 p-2 

bg-gray-50  

text-gray-900 text-sm

border border-gray-300

focus:ring-purple-600 focus:border-purple-600 
']) !!}>
    @if ($value_empty)
        <option value="">{{ $value_placeholder }}</option>
    @endif
    {{ $slot }}
</select>

@push('scripts')
<script type="text/javascript">

    document.addEventListener('livewire:initialized', function () {

        function loadJavascript(){
            $('#{{ $id }}').select2().on("change", function(){
                @this.set("{{ $id }}", $(this).val());
            });
        }
        loadJavascript();
        Livewire.hook("morphed",  () => {
            loadJavascript();
        })
    });
</script>
@endpush