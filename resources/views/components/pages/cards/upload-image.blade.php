@props([
    'new_image_file' => null,
    'new_image_file_string' => '',
    'rotate' => '',
    'delete' => '',
    'image_file_uri' => '',
    'image_file_name' => '',
    'title' => '',
    'title_2' => '',
])

<div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
        @if ($new_image_file)
            
            <x-pages.libraries.lightbox.img-tumb-lightbox 
                class="mx-auto"
                class_w_h="h-32 w-32"
                temporary="{{ true }}" tumb="{{ false }}"
                name="{!! $this->$new_image_file_string->temporaryUrl() !!}"   
            />

        @else
            <x-pages.libraries.lightbox.img-tumb-lightbox 
                class="mx-auto"
                class_w_h="h-32 w-32"
                uri="{{ $image_file_uri }}" 
                name="{{ $image_file_name }}"    
            />

        @endif
        <div>
            <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">{{ $title }}</h3>
            <div class="flex items-center space-x-4">
                @if (!$new_image_file)
                    
                    <x-pages.buttons.normal-btn 
                    title="Rotar" 
                    wire:click="{{ $rotate }}" 
                    >
                    
                    @slot('icon')
                        <x-sistem.icons.for-icons-app icon="rotate" class_w_h="h-4 w-4 fill-white"/>
                    @endslot
          
                  </x-pages.buttons.normal-btn>
                    
                    <x-pages.buttons.primary-btn 
                    title="Borrar" 
                    wire:click="{{ $delete }}" 
                    >
                    
                    @slot('icon')
                        <x-sistem.icons.for-icons-app icon="trash" class_w_h="h-4 w-4"/>
                    @endslot
          
                  </x-pages.buttons.primary-btn>


                @endif
            </div>
            <div>
                <x-pages.forms.label-form for="{{ $new_image_file_string }}" value="{{ $title_2 }}" />
                <x-pages.forms.input-file-form id="{{ $new_image_file_string }}" description="JPG, JPEG, PNG o GIF (Max. 5 mb)" wire:model.live="{{ $new_image_file_string }}" accept="image/*"
                    />
                <x-pages.forms.input-error for="{{ $new_image_file_string }}" />
            </div>
            <x-pages.spinners.loading-spinner wire:loading wire:target='{{ $new_image_file }}' />
        </div>
    </div>
</div>