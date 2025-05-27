<div class="w-full ">

        {{-- breadcrum, title y button --}}
        <x-pages.breadcrums.breadcrum title_1="Inicio" link_1="{{ route('dashboard') }}" title_2="{{ App\Models\Book::title() }}"
        link_2="{{ route('book_dashboard') }}" title_3="Libreria de {{ App\Models\Book::title() }}" link_3="{{ route('book_list') }}" />

    <x-pages.menus.title-and-btn>

        @slot('title')
        <x-pages.titles.title-pages title="Libreria de {{ App\Models\Book::title() }}" />
        @endslot

        @slot('button')
        <a href="{{ route('book_dashboard') }}" class="text-sm font-medium text-gray-600 hover:underline ">
            Volver
        </a>
        @endslot
    </x-pages.menus.title-and-btn>
    {{-- end breadcrum, title y button --}}

    <div class="relative w-full overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex items-center justify-center md:justify-between flex-column flex-wrap md:flex-row bg-white px-3">
            <div>
                <a class="text-sm font-medium text-gray-600 hover:underline " href="{{ route('book_create') }}">Crear Libro</a><span class="text-xl font-medium text-gray-600 hover:underline "></span>
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
    
        <div class="grid gap-1 pb-4 bg-white p-3">
            <div class="col-span-6 xl:col-span-3">
                <select id="collection_selected" wire:model.live="collection_selected" class="bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5">
                    <option selected value="">Colecciones</option>
                    @foreach($book_collections as $item)
                        <option value="{{ $item->uuid }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-6 xl:col-span-3">
                <select id="author_selected" wire:model.live="author_selected" class="bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5">
                    <option selected value="">Autores</option>
                    @foreach($book_authors as $item)
                        <option value="{{ $item->uuid }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-6 xl:col-span-3">
                <select id="tag_selected" wire:model.live="tag_selected" class="bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5">
                    <option selected value="">Etiquetas</option>
                    @foreach($book_tags as $item)
                        <option value="{{ $item->uuid }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-6 xl:col-span-3">
                <select id="genre_selected" wire:model.live="genre_selected" class="bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5">
                    <option selected value="">Genero</option>
                    @foreach($book_genres as $genre_item)
                        <option value="{{ $genre_item->uuid }}">{{ $genre_item->name }}</option>
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
                    <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 ">Leido</label>
                </div>
                <div class="flex items-center">
                    <input id="default-radio-3" wire:model.live='status_read' type="radio" value="3" name="default-radio" class="w-4 h-4 text-gray-600 bg-purple-100 border-purple-300 focus:ring-purple-500   ">
                    <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 ">Leyendo</label>
                </div>
                <div class="flex items-center">
                    <input checked id="default-radio-4" wire:model.live='status_read' type="radio" value="1" name="default-radio" class="w-4 h-4 text-gray-600 bg-purple-100 border-purple-300 focus:ring-purple-500   ">
                    <label for="default-radio-4" class="ms-2 text-sm font-medium text-gray-900 ">Quiero leer</label>
                </div>
            </div>
        </div>
    </div>

    <x-pages.spinners.loading-spinner class="my-1" wire:loading.delay />

    <div class="relative w-full overflow-x-auto shadow-md sm:rounded-lg px-1 py-3">

        <div class="grid grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-4">
            <!-- Aquí repetir el card anterior para cada libro -->
            
            @foreach ($books as $item)
            <a class="mx-auto" href="{{ route('book_view', ['uuid' => $item->uuid]) }}">
            <div class="relative w-20 h-32 sm:w-40 sm:h-60 rounded-lg overflow-hidden shadow-lg group">
                <img src="{{ $item->cover_image_url }}" alt="Portada del libro" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-300">
                    <span class="text-white text-lg font-semibold px-2 text-center">{{ $item->title }}</span>
                </div>
            </div>
            </a>
            
            
            @endforeach
            
        </div>
    {{-- Paginacion --}}
    <div class="mt-2">{{ $books->onEachSide(1)->links() }}</div>
    {{-- end Paginacion --}}
    </div>
    
    
    </div>