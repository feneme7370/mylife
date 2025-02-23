
<div>

    {{-- breadcrum, title y button --}}
        <x-pages.breadcrums.breadcrum 
        title_1="Inicio"
        link_1="{{ route('dashboard') }}"
        title_2="Media"
        link_2="{{ route('media_dashboard') }}"
        />

        <x-pages.menus.title-and-btn>

        @slot('title')
            <x-pages.titles.title-pages title="Peliculas y Series"/>
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

                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('media_list') }}">◉ <span class="hover:underline">Lista de peliculas y series</span></a></p>

                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('media_library') }}">◉ <span class="hover:underline">Biblioteca</span></a></p>

                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('media_actor_list') }}">◉ <span class="hover:underline">Actores</span></a></p>

                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('media_director_list') }}">◉ <span class="hover:underline">Directores</span></a></p>

                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('media_collection_list') }}">◉ <span class="hover:underline">Colecciones</span></a></p>

                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('media_tag_list') }}">◉ <span class="hover:underline">Etiquetas</span></a></p>
            </div>


        </div>
            
    </div>
    {{-- end mini datos --}}



</div>
