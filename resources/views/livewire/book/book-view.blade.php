<div class="w-full ">


    <div class="sm:m-3 p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm sm:p-8">

        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-1">
                <h5 class="text-xl font-bold leading-none text-gray-900 ">Libro</h5>
            </div>
            @if (session('status'))
                <div class="alert alert-success text-sm font-bold leading-none text-red-900 ">
                    {{ session('status') }}
                </div>
            @endif</h5>
            <div>
                
                <a href="{{ url()->previous() }}" class="text-sm font-medium text-gray-600 hover:underline ">
                    Volver
                </a>
            </div>
       </div>

        <img src="{{ $book->cover_image_url }}" class="w-full sm:w-auto sm:h-96 mx-auto mb-1 sm:mb-5" alt="">

        <h5 class="mt-4 sm:mt-0 mb-4 text-xl sm:text-2xl font-bold text-gray-950">{{ $book->title }}</h5>
        
        <p class="mb-4 text-base sm:text-base text-gray-800">{{ \Carbon\Carbon::parse($book->release_date)->year }} - {{ $book->book_author->name }}</p>


        <p class="mb-4 text-sm sm:text-base text-gray-800 whitespace-pre-wrap">{{ $book->synopsis }}</p>

        <p class="mt-4 sm:mt-0 mb-4 text-xl sm:text-2xl font-bold text-gray-950"> Datos</p>

        @if ($book->number_collection)
            <p class="mb-4 text-sm sm:text-base text-gray-800">Collecion: {{ $book->book_collection->name }} {{ '['.$book->number_collection.']' }}</p>
        @endif
        <p class="mb-4 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Paginas:</span> {{ $book->pages }}</p>
        <p class="mb-4 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Valoracion:</span> {{ $valoration_stars[$book->rating] ?? 'Desconocido' }}</p>
        <p class="mb-4 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Estado:</span> {{ $statusBook[$book->status] ?? 'Desconocido' }}</p>

        <p class="mt-4 sm:mt-0 mb-4 text-xl sm:text-2xl font-bold text-gray-950">Descripcion personal</p>
        <p class="mb-4 text-sm sm:text-base text-gray-800 whitespace-pre-wrap">{{ $book->personal_description }}</p>

        </div>
        
</div>
