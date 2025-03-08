<div class="w-full ">

    {{-- breadcrum, title y button --}}
    <x-pages.breadcrums.breadcrum title_1="Inicio" link_1="{{ route('dashboard') }}" title_2="{{ App\Models\Media::title() }}"
    link_2="{{ route('media_dashboard') }}" title_3="Lista de {{ App\Models\Media::title() }}" link_3="{{ route('media_list') }}" />

<x-pages.menus.title-and-btn>

    @slot('title')
    <x-pages.titles.title-pages title="Lista de {{ App\Models\Media::title() }}" />
    @endslot

    @slot('button')
    <a href="{{ route('media_dashboard') }}" class="text-sm font-medium text-gray-600 hover:underline ">
        Volver
    </a>
    @endslot
</x-pages.menus.title-and-btn>
{{-- end breadcrum, title y button --}}

<div class="relative w-full overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-center md:justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 bg-white px-3">
        <div>
            <a class="text-sm font-medium text-gray-600 hover:underline " href="{{ route('media_create', ['type' => 1]) }}">Crear Peli</a>
            <span class="text-xl font-medium text-gray-600 hover:underline "> | </span>
            <a class="text-sm font-medium text-gray-600 hover:underline " href="{{ route('media_create', ['type' => 2]) }}">Crear Serie</a>
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
                <select id="collection_selected" wire:model.live="collection_selected" class="bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5">
                    <option selected value="">Colecciones</option>
                    @foreach($collections as $collection_item)
                        <option value="{{ $collection_item->uuid }}">{{ $collection_item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-6 xl:col-span-3">
                <select id="media_type" wire:model.live="media_type" class="bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5">
                    <option selected value="">Tipo</option>
                    @foreach($type_content as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>

        
        <div class="flex gap-1 justify-start items-center col-span-12">
            <div class="flex items-center">
                <input id="default-radio-1" wire:model.live='status_read' type="radio" value="" name="default-radio" class="w-4 h-4 text-gray-600 bg-purple-100 border-purple-300 focus:ring-purple-500   ">
                <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 ">Todos</label>
            </div>
            <div class="flex items-center">
                <input checked id="default-radio-2" wire:model.live='status_read' type="radio" value="2" name="default-radio" class="w-4 h-4 text-gray-600 bg-purple-100 border-purple-300 focus:ring-purple-500   ">
                <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 ">Visto</label>
            </div>
            <div class="flex items-center">
                <input id="default-radio-3" wire:model.live='status_read' type="radio" value="3" name="default-radio" class="w-4 h-4 text-gray-600 bg-purple-100 border-purple-300 focus:ring-purple-500   ">
                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 ">Viendo</label>
            </div>
            <div class="flex items-center">
                <input checked id="default-radio-4" wire:model.live='status_read' type="radio" value="1" name="default-radio" class="w-4 h-4 text-gray-600 bg-purple-100 border-purple-300 focus:ring-purple-500   ">
                <label for="default-radio-4" class="ms-2 text-sm font-medium text-gray-900 ">Quiero ver</label>
            </div>
        </div>
    </div>
</div>
<div class=" w-full shadow-md sm:rounded-lg">
    <div class="w-full grid gap-1 grid-col-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
        @foreach ($medias as $item)
            <section class="w-full p-1 border border-purple-300 bg-gray-50 rounded-md mt-1  flex flex-col justify-between items-start">
    
                <div class="grid grid-cols-12 gap-3 w-full">
                    <div class="w-full col-span-8">
                        <div class="text-sm md:text-base font-semibold hover:underline line-clamp-3"><a href="{{ route('media_view', ['uuid' => $item->uuid]) }}">{{ $item->title }}</a></div>
                        <div class="flex flex-col gap-1">
                            <span class="text-sm md:font-normal text-gray-500">{{ $item->media_type == null ? '' : $type_content[$item->media_type] }} ({{ \Carbon\Carbon::parse($item->release_date)->year }})</span>
                            <span class="text-sm md:font-normal text-gray-500">{{ $valoration_stars[$item->rating] ?? 'Sin valorar' }}</span>
                        </div>
                        @if (!$item->seasons->isEmpty())
                        <div class="flex items-start gap-1 mt-1">
                            <span class="text-sm md:font-normal text-gray-500 italic">Temp.: {{ $item->seasons->count() }}</span>
                            <span class="text-sm md:font-normal text-gray-500 italic">Cap.: {{ $item->seasons->sum('episodes_count') }}</span>
                        </div>
                        @endif
                    </div>
                    <img class="h-auto rounded-md object-cover col-span-4" src="{{ $item->cover_image_url }}" alt="Portada">
                </div>
    
                <div class="flex flex-col gap-1 mt-1">
                    <div class="flex gap-1 flex-wrap">
                        @foreach ($item->media_collections as $collection_item)
                            <a href="{{ route('media_library', ['c' => $collection_item->uuid]) }}" class="hover:underline text-sm md:font-normal text-gray-500 italic bg-gray-200 rounded-md px-1 border border-purple-200">{{ $collection_item->name }}</a>
                        @endforeach
                    </div>
                    <div class="flex gap-1  flex-wrap">
                        @foreach ($item->media_genres as $genre_item)
                            <span><a href="{{ route('media_library', ['g' => $genre_item->uuid]) }}" class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg">{{ $genre_item->name }}</a>
                            </span>
                        @endforeach
                    </div>
                    <div class="flex gap-1 flex-wrap">
                        @foreach ($item->media_tags as $tag_item)
                            <span><a href="{{ route('media_library', ['t' => $tag_item->uuid]) }}" class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg">{{ $tag_item->name }}</a>
                            </span>
                        @endforeach
                    </div>
                </div>
                <div class="w-full">
    
                    <div class="flex justify-between">
                            <div class=" flex items-center justify-center gap-1">
                                <span class="flex w-3 h-3 me-3 bg-purple-500 rounded-full"></span>
                                <span class="text-sm italic">{{ $status_media[$item->status] ?? 'Desconocido' }}</span>
                            </div>
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('media_edit', ['type' => $item->media_type, 'uuid' => $item->uuid]) }}" class="font-medium text-gray-600  hover:underline"><x-pages.buttons.edit-text/></a>
                                <x-pages.buttons.delete-text wire:click="deleteActionModal('{{$item->uuid}}')"
                                wire:loading.attr="disabled" />
                            </div>
                    </div>
                </div>
            </section>
        @endforeach
    </div>
{{-- <table class="w-full overflow-hidden text-sm text-left rtl:text-right text-gray-500 ">
    <thead class="text-xs text-gray-700 uppercase bg-purple-50  ">
        <tr>
            <th class="px-6 py-3">
                Titulo
            </th>
            <th class="px-6 py-3">
                Datos
            </th>
            <th class="px-6 py-3">
                Coleccion
            </th>
            <th class="px-6 py-3">
                Genero
            </th>
            <th class="px-6 py-3">
                Etiquetas
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
                <div class="flex flex-col gap-1">
                    <span>{{ $item->media_type == null ? '' : $type_content[$item->media_type] }} ({{ \Carbon\Carbon::parse($item->release_date)->year }})</span>
                    <span>{{ $valoration_stars[$item->rating] ?? 'Sin valorar' }}</span>
                </div>
            </td>

            <td class="px-6 py-4">
                <div class="flex flex-col justify-center items-center">
                    @if ($item->media_collections->isEmpty())
                        <span>Sin coleccion</span>
                    @endif
                    @foreach ($item->media_collections as $collection_item)<a href="{{ route('media_library', ['c' => $collection_item->uuid]) }}" class="hover:underline text-sm md:font-normal text-gray-500">{{ $collection_item->name }}</a>
                    @endforeach

                    @if (!$item->seasons->isEmpty())
                    <div class="flex flex-col justify-center items-center mt-1">
                        <span>Temporadas: {{ $item->seasons->count() }}</span>
                        <span>Capitulos: {{ $item->seasons->sum('episodes_count') }}</span>
                    </div>
                    @endif

                </div>
            </td>

            <td class="px-6 py-4">
                <div class="flex flex-wrap justify-center gap-1 w-40">
                    @if ($item->media_genres->isEmpty())
                        <span>Sin genero</span>
                    @endif
                    @foreach ($item->media_genres as $genre_item)
                        <span><a href="{{ route('media_library', ['g' => $genre_item->uuid]) }}" class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg">{{ $genre_item->name }}</a>
                        </span>
                    @endforeach
                </div>
            </td>

            <td class="px-6 py-4">
                <div class="flex flex-wrap justify-center gap-1 w-40">
                    @if ($item->media_tags->isEmpty())
                        <span>Sin etiquetas</span>
                    @endif
                    @foreach ($item->media_tags as $tag_item)
                        <span><a href="{{ route('media_library', ['t' => $tag_item->uuid]) }}" class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg">{{ $tag_item->name }}</a>
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="px-6 py-4">
                <div class=" flex items-center justify-center gap-1">
                    <span class="flex w-3 h-3 me-3 bg-purple-500 rounded-full"></span>
                    <span>{{ $status_media[$item->status] ?? 'Desconocido' }}</span>
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
</table> --}}

    {{-- Paginacion --}}
    <div class="mt-2 py-1 px-3">{{ $medias->onEachSide(1)->links() }}</div>
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