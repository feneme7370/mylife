<div class="w-full ">



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
            <a class="text-sm font-medium text-gray-600 hover:underline " href="{{ route('book_create') }}">Crear</a><span class="text-xl font-medium text-gray-600 hover:underline "> | </span>
            <a href="{{ url()->previous() }}" class="text-sm font-medium text-gray-600 hover:underline ">
                Volver
            </a>
        </div>
    </div>

    <div class="flex items-center justify-start gap-1 sm:gap-3 flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white p-3">
        <div>
            <select id="collection_selected" wire:model.live="collection_selected" class="bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5      ">
              <option selected value="">Coleccion</option>
                @foreach($collections as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="flex gap-1 justify-between items-center">
            <div class="flex items-center">
                <input id="default-radio-1" wire:model.live='statusRead' type="radio" value="" name="default-radio" class="w-4 h-4 text-gray-600 bg-purple-100 border-purple-300 focus:ring-purple-500   ">
                <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 ">Todos</label>
            </div>
            <div class="flex items-center">
                <input checked id="default-radio-2" wire:model.live='statusRead' type="radio" value="2" name="default-radio" class="w-4 h-4 text-gray-600 bg-purple-100 border-purple-300 focus:ring-purple-500   ">
                <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 ">Leido</label>
            </div>
            <div class="flex items-center">
                <input id="default-radio-3" wire:model.live='statusRead' type="radio" value="3" name="default-radio" class="w-4 h-4 text-gray-600 bg-purple-100 border-purple-300 focus:ring-purple-500   ">
                <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 ">Leyendo</label>
            </div>
            <div class="flex items-center">
                <input checked id="default-radio-4" wire:model.live='statusRead' type="radio" value="1" name="default-radio" class="w-4 h-4 text-gray-600 bg-purple-100 border-purple-300 focus:ring-purple-500   ">
                <label for="default-radio-4" class="ms-2 text-sm font-medium text-gray-900 ">Quiero leer</label>
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
                    Estado
                </th>
                <th class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($books as $item)
            <tr class="bg-white border-b border-purple-200 hover:bg-purple-50">
                <th class="flex items-center px-6 py-4 text-gray-900 ">
                    <img class="h-20 rounded-sm object-cover" src="{{ $item->cover_image_url }}" alt="Portada">
                    <div class="ps-3 w-44">
                        <div class="text-sm md:text-base font-semibold hover:underline"><a href="{{ route('book_view', ['uuid' => $item->uuid]) }}">{{ $item->title }}</a></div>
                        <div class="text-sm md:font-normal text-gray-500">{{ $item->book_collection->name }}</div>
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
                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> {{ $statusBook[$item->status] ?? 'Desconocido' }}
                    </div>
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('book_edit', ['id' => $item->id]) }}" class="font-medium text-gray-600  hover:underline">Editar</a>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>

        {{-- Paginacion --}}
        <div class="mt-2">{{ $books->onEachSide(1)->links() }}</div>
        {{-- end Paginacion --}}
</div>


</div>