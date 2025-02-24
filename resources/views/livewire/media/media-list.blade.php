<div class="w-full ">

    {{-- breadcrum, title y button --}}
    <x-pages.breadcrums.breadcrum title_1="Inicio" link_1="{{ route('dashboard') }}" title_2="Peliculas y Series"
    link_2="{{ route('media_dashboard') }}" title_3="Listado de Peliculas y Series" link_3="{{ route('media_list') }}" />

<x-pages.menus.title-and-btn>

    @slot('title')
    <x-pages.titles.title-pages title="Listado de Peliculas y Series" />
    @endslot

    @slot('button')
    <a href="{{ route('media_dashboard') }}" class="text-sm font-medium text-gray-600 hover:underline ">
        Volver
    </a>
    @endslot
</x-pages.menus.title-and-btn>
{{-- end breadcrum, title y button --}}

<div class="relative w-full overflow-x-auto shadow-md sm:rounded-lg">
<div class="flex items-center justify-center md:justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white p-3">
    <label for="table-search" class="sr-only">Buscar</label>
    <div class="relative">
        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input type="text" wire:model.live='search' class="block p-2 ps-10 text-sm text-gray-900 border border-purple-300 rounded-lg w-80 bg-purple-50 focus:ring-purple-500 focus:border-purple-500      " placeholder="Buscar libro">
    </div>
    <div>
        <a class="text-sm font-medium text-gray-600 hover:underline " href="{{ route('media_create', ['type' => 1]) }}">Crear Peli</a>
        <a class="text-sm font-medium text-gray-600 hover:underline " href="{{ route('media_create', ['type' => 2]) }}">Crear Serie</a>
    </div>
</div>

<div class="flex items-center justify-start gap-1 sm:gap-3 flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white p-3">
    <div>
        <select id="collection_selected" wire:model.live="collection_selected" class="bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5      ">
          <option selected value="">Coleccion</option>
            @foreach($collections as $item)
                <option value="{{ $item->uuid }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <select id="media_type_selected" wire:model.live="media_type_selected" class="bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5">
          <option selected value="">Tipo</option>
            @foreach($type_content as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="flex gap-1 justify-between items-center">
        <div class="flex items-center">
            <input id="default-radio-1" wire:model.live='status_view' type="radio" value="" name="default-radio" class="w-4 h-4 text-gray-600 bg-purple-100 border-purple-300 focus:ring-purple-500   ">
            <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 ">Todos</label>
        </div>
        <div class="flex items-center">
            <input checked id="default-radio-2" wire:model.live='status_view' type="radio" value="2" name="default-radio" class="w-4 h-4 text-gray-600 bg-purple-100 border-purple-300 focus:ring-purple-500   ">
            <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 ">Visto</label>
        </div>
        <div class="flex items-center">
            <input id="default-radio-3" wire:model.live='status_view' type="radio" value="3" name="default-radio" class="w-4 h-4 text-gray-600 bg-purple-100 border-purple-300 focus:ring-purple-500   ">
            <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 ">Viendo</label>
        </div>
        <div class="flex items-center">
            <input checked id="default-radio-4" wire:model.live='status_view' type="radio" value="1" name="default-radio" class="w-4 h-4 text-gray-600 bg-purple-100 border-purple-300 focus:ring-purple-500   ">
            <label for="default-radio-4" class="ms-2 text-sm font-medium text-gray-900 ">Quiero ver</label>
        </div>
    </div>
</div>
</div>
<div class="relative w-full overflow-x-auto shadow-md sm:rounded-lg">
<table class="w-full overflow-hidden text-sm text-left rtl:text-right text-gray-500 ">
    <thead class="text-xs text-gray-700 uppercase bg-purple-50  ">
        <tr>
            <th class="px-6 py-3">
                Titulo
            </th>
            <th class="px-6 py-3">
                Datos
            </th>
            <th class="px-6 py-3">
                Datos
            </th>
            <th class="px-6 py-3">
                Coleccion
            </th>
            <th class="px-6 py-3">
                Estado
            </th>
            <th class="px-6 py-3">
                Action
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($medias as $item)
        <tr class="bg-white border-b border-purple-200 hover:bg-purple-50">
            <th class="flex items-center px-6 py-4 text-gray-900 ">
                <img class="h-20 rounded-sm object-cover" src="{{ $item->cover_image_url }}" alt="Portada">
                <div class="ps-3 w-44">
                    <div class="text-sm md:text-base font-semibold hover:underline"><a href="{{ route('media_view', ['uuid' => $item->uuid]) }}">{{ $item->title }}</a></div>

                    <div class="">
                        @foreach ($item->media_actors as $actor_item)
                            <a href="{{ route('media_library', ['a' => $actor_item->uuid]) }}" class="text-xs hover:underline md:font-normal text-gray-500">{{ $actor_item->name }}</a>
                        @endforeach
                    </div>
                </div>  
            </th>
            <td class="px-6 py-4">
                <span>Pag: {{ $item->pages }}</span>
            </td>
            <td class="px-6 py-4">
                <span>Año: {{ \Carbon\Carbon::parse($item->release_date)->year }}</span>
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center">
                    @foreach ($item->media_collections as $collection_item)<a href="{{ route('media_library', ['c' => $collection_item->uuid]) }}" class="hover:underline text-sm md:font-normal text-gray-500">{{ $collection_item->name }}</a>@endforeach
                </div>
            </td>

            <td class="px-6 py-4">
                <div class=" flex items-center justify-center gap-1">
                    <span class="flex w-3 h-3 me-3 bg-purple-500 rounded-full"></span><span>{{ $status_media[$item->status] ?? 'Desconocido' }}</span>
                </div>
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center justify-center gap-1">
                    <a href="{{ route('media_edit', ['type' => $item->media_type, 'uuid' => $item->uuid]) }}" class="font-medium text-gray-600  hover:underline"><x-pages.buttons.edit-text/></a>
                    <x-pages.buttons.delete-text wire:click="deleteActionModal('{{$item->uuid}}')"
                    wire:loading.attr="disabled" />
                </div>
            </td>
        </tr>
        @endforeach
        
    </tbody>
</table>

    {{-- Paginacion --}}
    <div class="mt-2">{{ $medias->onEachSide(1)->links() }}</div>
    {{-- end Paginacion --}}
</div>

{{-- modal action --}}
<x-pages.modals.jetstream.dialog-modal wire:model="showDeleteModal">
    <x-slot name="title">
        {{ __('Formulario') }}
    </x-slot> 

    <x-slot name="content">
        <form wire:submit="deleteMedia" class="sm:m-3 p-4 bg-purple-50 border border-purple-200 rounded-lg shadow-sm sm:p-8  text-center">
            
            <p class="mb-5">Desea borrar el item?</p>
    

        </form>
    </x-slot>

    <x-slot name="footer">
        <x-pages.buttons.primary-btn 
        title="Borrar" 
        wire:click="deleteMedia" 
    ></x-pages.buttons.primary-btn>
    </x-slot>
  </x-pages.modals.jetstream.dialog-modal>
{{-- end modal action --}}
</div>