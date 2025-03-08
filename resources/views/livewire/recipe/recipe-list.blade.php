<div class="w-full ">

    {{-- breadcrum, title y button --}}
    <x-pages.breadcrums.breadcrum title_1="Inicio" link_1="{{ route('dashboard') }}" title_2="{{ App\Models\Recipe::title() }}"
    link_2="{{ route('recipe_dashboard') }}" title_3="Lista de {{ App\Models\Recipe::title() }}" link_3="{{ route('recipe_list') }}" />

    <x-pages.menus.title-and-btn>

        @slot('title')
        <x-pages.titles.title-pages title="Lista de {{ App\Models\Recipe::title() }}" />
        @endslot

        @slot('button')
        <a href="{{ route('recipe_dashboard') }}" class="text-sm font-medium text-gray-600 hover:underline ">
            Volver
        </a>
        @endslot
    </x-pages.menus.title-and-btn>
    {{-- end breadcrum, title y button --}}

<div class="relative w-full overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-center md:justify-between flex-column flex-wrap md:flex-row bg-white px-3">
        <div>
            <a class="text-sm font-medium text-gray-600 hover:underline " href="{{ route('recipe_create') }}">Crear Receta</a><span class="text-xl font-medium text-gray-600 hover:underline "></span>
        </div>
        <label for="table-search" class="sr-only">Buscar</label>
        <div class="relative w-full mt-1">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" wire:model.live='search' class="block p-2 ps-10 text-sm text-gray-900 border border-purple-300 rounded-lg w-full sm:w-80 bg-purple-50 focus:ring-purple-500 focus:border-purple-500      " placeholder="Buscar libro">
        </div>
    </div>

    <div class="grid grid-cols-12 gap-1 pb-4 bg-white p-3">
        <div class="col-span-6 xl:col-span-3">
            <select id="category_selected" wire:model.live="category_selected" class="bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5">
                <option selected value="">Categorias</option>
                @foreach($recipe_categories as $item)
                    <option value="{{ $item->uuid }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-6 xl:col-span-3">
            <select id="tag_selected" wire:model.live="tag_selected" class="bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5">
                <option selected value="">Etiquetas</option>
                @foreach($recipe_tags as $item)
                    <option value="{{ $item->uuid }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>
<div class="relative w-full overflow-x-auto shadow-md sm:rounded-lg">
    <div class="w-full grid gap-1 grid-col-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
        @foreach ($recipes as $item)
            <section class="w-full p-1 border border-purple-300 bg-gray-50 rounded-md mt-1 flex flex-col justify-between items-start">
                
                <div class="grid grid-cols-12 gap-3 w-full">
                    <img class="h-auto rounded-md object-cover col-span-4" src="{{ $item->cover_image_url }}" alt="Portada">
                    <div class="w-full col-span-8">
                        <div class="text-sm md:text-base font-semibold hover:underline line-clamp-3"><a href="{{ route('recipe_view', ['uuid' => $item->uuid]) }}">{{ $item->title }}</a></div>
                        <div class="text-xs md:text-sm font-light line-clamp-2"><a>{{ $item->synopsis }}</a></div>
                    </div>
                </div>
    
                <div class="flex flex-col gap-1 mt-1">
                    <div class="flex gap-1 flex-wrap">
                        @foreach ($item->recipe_categories as $category_item)
                            <a href="{{ route('recipe_list', ['c' => $category_item->uuid]) }}" class="hover:underline text-xs md:text-sm text-gray-500 italic bg-gray-200 rounded-md px-1 border border-purple-200">{{ $category_item->name }}</a>
                        @endforeach
                    </div>
                    <div class="flex gap-1 flex-wrap">
                        @foreach ($item->recipe_tags as $tag_item)
                            <span><a href="{{ route('recipe_list', ['t' => $tag_item->uuid]) }}" class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg">{{ $tag_item->name }}</a>
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="w-full">
    
                    <div class="flex justify-between">
                            <div class=" flex items-center justify-center gap-1">
                            </div>
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('recipe_edit', ['type' => $item->recipe_type, 'uuid' => $item->uuid]) }}" class="font-medium text-gray-600  hover:underline"><x-pages.buttons.edit-text/></a>
                                <x-pages.buttons.delete-text wire:click="deleteActionModal('{{$item->uuid}}')"
                                wire:loading.attr="disabled" />
                            </div>
                    </div>
                </div>
            </section>
        @endforeach
    </div>


    {{-- Paginacion --}}
    <div class="mt-2 py-1 px-3">{{ $recipes->onEachSide(1)->links() }}</div>
    {{-- end Paginacion --}}
</div>

    {{-- modal action --}}
    <x-pages.modals.jetstream.dialog-modal wire:model="showDeleteModal">
        <x-slot name="title">
            {{ __('Formulario') }}
        </x-slot> 
    
        <x-slot name="content">
            <form wire:submit="deleteRecipe" class="sm:m-3 p-4 bg-purple-50 border border-purple-200 rounded-lg shadow-sm sm:p-8  text-center">
                
                <p class="mb-5">Desea borrar el libro?</p>
        
    
            </form>
        </x-slot>
    
        <x-slot name="footer">
            <x-pages.buttons.primary-btn 
            title="Borrar" 
            wire:click="deleteRecipe" 
        ></x-pages.buttons.primary-btn>
        </x-slot>
      </x-pages.modals.jetstream.dialog-modal>
    {{-- end modal action --}}
</div>