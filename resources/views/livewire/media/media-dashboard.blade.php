
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

                <div class="mb-3">
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 ">Listado</h2>
                    <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside ">
                        <li>
                            <a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('media_list') }}"><span class="hover:underline">Tabla</span></a>
                        </li>
                        <li>
                            <a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('media_library') }}"><span class="hover:underline">Videoteca</span></a>
                        </li>
                    </ul>
                </div>

                <div class="mb-3">
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 ">Datos adicionales</h2>
                    <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside ">
                        <li>
                            <a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('media_actor_list') }}"><span class="hover:underline">Actores</span></a>
                        </li>
                        <li>
                            <a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('media_director_list') }}"><span class="hover:underline">Directores</span></a>
                        </li>
                        <li>
                            <a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('media_collection_list') }}"><span class="hover:underline">Colecciones</span></a>
                        </li>
                        <li>
                            <a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('media_tag_list') }}"><span class="hover:underline">Etiquetas</span></a>
                        </li>
                        <li>
                            <a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('media_genre_list') }}"><span class="hover:underline">Generos</span></a>
                        </li>
                    </ul>
                </div>

            </div>


        </div>
            
    </div>
    {{-- end mini datos --}}



</div>
