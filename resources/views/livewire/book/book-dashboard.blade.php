
<div>

    {{-- breadcrum, title y button --}}
        <x-pages.breadcrums.breadcrum 
        title_1="Inicio"
        link_1="{{ route('dashboard') }}"
        title_2="Libros"
        link_2="{{ route('book_dashboard') }}"
        />

        <x-pages.menus.title-and-btn>

        @slot('title')
            <x-pages.titles.title-pages title="Libros"/>
        @endslot

        @slot('button')
            <span class="font-bold italic"></span>
        @endslot
        </x-pages.menus.title-and-btn>
    {{-- end breadcrum, title y button --}}
    
    {{-- logo de carga --}}
        <x-pages.spinners.loading-spinner wire:loading.delay />
    {{-- end logo de carga --}}

    {{-- mini datos --}}
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="w-full ">


        <div class="sm:m-3 p-4 bg-gray-50 border border-purple-200 rounded-lg shadow-sm sm:p-8 ">
    
            <div class="py-2">

                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('book_list') }}">◉ <span class="hover:underline">Lista de libros</span></a></p>

                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('book_library') }}">◉ <span class="hover:underline">Biblioteca</span></a></p>

                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('book_author_list') }}">◉ <span class="hover:underline">Autores</span></a></p>

                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('book_collection_list') }}">◉ <span class="hover:underline">Colecciones</span></a></p>

                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('book_tag_list') }}">◉ <span class="hover:underline">Etiquetas</span></a></p>
            </div>


        </div>
            
    </div>
    {{-- end mini datos --}}



</div>
