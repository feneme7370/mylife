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
                
                <a href="{{ route('book_dashboard') }}" class="text-sm font-medium text-gray-600 hover:underline ">
                    Volver
                </a>
            </div>
       </div>

        <img src="{{ $book->cover_image_url }}" class="w-full sm:w-auto sm:h-96 mx-auto mb-1 sm:mb-5" alt="">

        <div class="flex justify-between items-start gap-1">
            <div class="mt-4 sm:mt-0 mb-4">
                <h5 class="text-xl sm:text-2xl font-bold text-gray-950">{{ $book->title }}</h5>
                <p class="mb-2 text-xs sm:text-base text-gray-800 font-light italic">{{ $book->original_title }}</p>
            </div>
            <a href="{{ route('book_edit', ['type' => $book->book_type, 'uuid' => $book->uuid]) }}" class="font-medium text-gray-600  hover:underline"><x-pages.buttons.edit-text/></a>
        </div>
        
        
        <p class="mt-1 mb-3 text-base sm:text-lg text-gray-800"><span class="text-gray-950 font-bold">{{ \Carbon\Carbon::parse($book->release_date)->year }}</span>
            @foreach ($book->book_authors as $item)
            - <a class="italic hover:underline" href="{{ route('book_library', ['a' => $item->uuid]) }}">{{ $item->name }}</a>
            @endforeach
    </p>


        <p class="mb-4 text-sm sm:text-base text-gray-800 whitespace-pre-wrap">{{ $book->synopsis }}</p>

        <p class="mt-4 sm:mt-0 mb-2 text-xl sm:text-2xl font-bold text-gray-950"> Datos</p>

        @if (!$book->book_collections->isEmpty())
        <p class="mt-1 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Coleccion:</span></p>
        <div class="mb-2">
            @foreach ($book->book_collections as $item)
                <a class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg" href="{{ route('book_library', ['c' => $item->uuid]) }}">{{ $item->name }}</a>
            @endforeach
        </div>
        @endif

        @if (!$book->book_genres->isEmpty())
        <p class="mt-1 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Generos:</span></p>
        <div class="mb-2">
            @foreach ($book->book_genres as $item)
            <a class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg" href="{{ route('book_library', ['g' => $item->uuid]) }}">{{ $item->name }}</a>
            @endforeach
        </div>
        @endif

        @if (!$book->book_tags->isEmpty())
        <p class="mt-1 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Etiquetas:</span></p>
        <div class="mb-2">
            @foreach ($book->book_tags as $item)
            <a class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg" href="{{ route('book_library', ['t' => $item->uuid]) }}">{{ $item->name }}</a>
            @endforeach
        </div>
        @endif

        @if ($book->number_collection)
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Volumen:</span> {{$book->number_collection}}</p>
        @endif
        @if ($book->pages)
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Paginas:</span> {{ $book->pages }}</p>
        @endif
        @if ($book->rating)
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Valoracion:</span> {{ $valoration_stars[$book->rating] ?? 'Desconocido' }}</p>
        @endif
        @if ($book->status)
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Estado:</span> {{ $status_book[$book->status] ?? 'Desconocido' }}</p>
        @endif
        @if ($book->format)
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Formato:</span> {{ $format[$book->format] ?? 'Desconocido' }}</p>
        @endif
        @if ($book->emission_status)
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Emision:</span> {{ $emission_status[$book->emission_status] ?? 'Desconocido' }}</p>
        @endif
        
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Favorito:</span> {{ $book->is_favorite ? 'Si' : 'No' }}</p>
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Lista de deseo:</span> {{ $book->is_wish ? 'Si' : 'No' }}</p>
        
        @if ($book->book_readings->count() > 0)
        <p class="mb-2 text-xs sm:text-base text-gray-800 italic">Leido {{ $book->book_readings->count() == 1 ? $book->book_readings->count().' vez' : $book->book_readings->count().' veces' }}</p>
            @foreach ($book->book_readings as $item)
                <div class="px-3 border-l-4 border-purple-800">
                    <p class="mb-2 text-xs sm:text-base text-gray-800">{{ $item->start_date }} - {{ $item->end_date }} en {{ \Carbon\Carbon::parse($item->start_date)->diffInDays($item->end_date) }} dias</p>
                </div>
            @endforeach
        @endif

        @if ($book->personal_description)
        <p class="mt-4 sm:mt-0 mb-4 text-xl sm:text-2xl font-bold text-gray-950">Descripcion personal</p>
        <p class="mb-4 text-sm sm:text-base text-gray-800 whitespace-pre-wrap">{!! $book->personal_description !!}</p>
        @endif

        </div>
        
</div>
