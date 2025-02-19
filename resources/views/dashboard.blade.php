<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="w-full ">


        <div class="sm:m-3 p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 ">
    
            <div class="py-2">
                <p class="mb-4 text-xl md:text-2xl font-bold text-gray-500">Libros</p>

                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-500" href="{{ route('book_list') }}">Lista de libros</a></p>

                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-500" href="{{ route('book_author_list') }}">Autores</a></p>

                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-500" href="{{ route('book_collection_list') }}">Colecciones</a></p>

                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-500" href="{{ route('book_tag_list') }}">Etiquetas</a></p>
            </div>


        </div>
            
    </div>


</x-app-layout>
