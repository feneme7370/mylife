@props(['placeholder' => 'Buscar', 'disabled' => false, 'description' => false])

<div>
    <div
          
    x-data="{ isUploading: false, progress: 0, isUpload: false }"

    x-on:livewire-upload-start="isUploading = true; isUpload = false"

    x-on:livewire-upload-finish="isUploading = false; isUpload = true"

    x-on:livewire-upload-error="isUploading = false"

    x-on:livewire-upload-progress="progress = $event.detail.progress"

    >
        <input type="file" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '

            block w-full 
            text-sm rounded-lg shadow-md
            my-1 p-2 

            bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-purple-600 focus:border-purple-600 
        ']) !!}>

        <p class="my-1 text-sm text-gray-500 " id="file_input_help">{{$description}}</p>

        <div x-show="isUploading">
          
            <progress max="100" x-bind:value="progress"></progress>
            <!-- Mostrar porcentaje en tiempo real -->
            <span x-text="progress + '%'"></span>

        </div>
        <div x-show="isUpload">
          
            <!-- Mostrar porcentaje en tiempo real -->
            <span x-text="'Subido con exito!'"></span>

        </div>
        

    </div>
</div>