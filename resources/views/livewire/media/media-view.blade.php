<div class="w-full ">


    <div class="sm:m-3 p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm sm:p-8">

        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-1">
                <h5 class="text-xl font-bold leading-none text-gray-900 ">{{ $type_content[$media->media_type] }}</h5>
            </div>
            @if (session('status'))
                <div class="alert alert-success text-sm font-bold leading-none text-red-900 ">
                    {{ session('status') }}
                </div>
            @endif</h5>
            <div>
                
                <a href="{{ route('media_dashboard') }}" class="text-sm font-medium text-gray-600 hover:underline ">
                    Volver
                </a>
            </div>
       </div>

        <img src="{{ $media->cover_image_url }}" class="w-full sm:w-auto sm:h-96 mx-auto mb-1 sm:mb-5" alt="">

        <div class="flex justify-between items-center gap-1">
            <div class="mt-4 sm:mt-0 mb-4">
                <h5 class="text-xl sm:text-2xl font-bold text-gray-950">{{ $media->title }}</h5>
                <p class="mb-2 text-xs sm:text-base text-gray-800 font-light italic">{{ $media->original_title }}</p>
            </div>
            <a href="{{ route('media_edit', ['type' => $media->media_type, 'uuid' => $media->uuid]) }}" class="font-medium text-gray-600  hover:underline"><x-pages.buttons.edit-text/></a>
        </div>
        

        <p class="mt-1 mb-3 text-base sm:text-lg text-gray-800"><span class="text-gray-950 font-bold">{{ \Carbon\Carbon::parse($media->release_date)->year }}</span>
                @foreach ($media->media_directors as $item)
                - <a class="italic hover:underline" href="{{ route('media_library', ['d' => $item->uuid]) }}">{{ $item->name }}</a>
                @endforeach
        </p>

        <p class="mb-4 text-base sm:text-base text-gray-800">
            @foreach ($media->media_actors as $item)
                <a class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg" href="{{ route('media_library', ['a' => $item->uuid]) }}">{{ $item->name }}</a>
            @endforeach
        </p>

        <p class="mb-4 text-sm sm:text-base text-gray-800 whitespace-pre-wrap">{{ $media->synopsis }}</p>

        <p class="mt-4 sm:mt-0 mb-4 text-xl sm:text-2xl font-bold text-gray-950"> Datos</p>

        @if (!$media->media_collections->isEmpty())
        <p class="mt-1 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Coleccion:</span></p>
        <div class="mb-2">
            @foreach ($media->media_collections as $item)
                <a class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg" href="{{ route('media_library', ['c' => $item->uuid]) }}">{{ $item->name }}</a>
            @endforeach
        </div>
        @endif

        @if (!$media->media_genres->isEmpty())
        <p class="mt-1 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Generos:</span></p>
        <div class="mb-2">
            @foreach ($media->media_genres as $item)
            <a class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg" href="{{ route('media_library', ['g' => $item->uuid]) }}">{{ $item->name }}</a>
            @endforeach
        </div>
        @endif

        @if (!$media->media_tags->isEmpty())
        <p class="mt-1 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Etiquetas:</span></p>
        <div class="mb-2">
            @foreach ($media->media_tags as $item)
            <a class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg" href="{{ route('media_library', ['t' => $item->uuid]) }}">{{ $item->name }}</a>
            @endforeach
        </div>
            
        @endif

        @if ($media->number_collection)
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Volumen:</span> {{$media->number_collection}}</p>
        @endif
        @if ($media->media_type == 1 && !$duration_hs)
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Duracion:</span> {{ $duration_hs->format('%h h %i min') }}</p>
        @endif
        @if ($media->rating)
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Valoracion:</span> {{ $valoration_stars[$media->rating] ?? 'Desconocido' }}</p>
        @endif
        @if ($media->status)
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Estado:</span> {{ $status_media[$media->status] ?? 'Desconocido' }}</p>
        @endif

        @foreach ($media->seasons as $season_item)
        <div class="px-3 border-l-4 border-purple-800">
            <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Temporada:</span> {{ $season_item->title }} ({{ $season_item->episodes_count }} cap.)</p>
            <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Descripcion:</span> {{ $season_item->description }}</p>
        </div>
        @endforeach

        @if ($media->format)
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Formato:</span> {{ $format[$media->format] ?? 'Desconocido' }}</p>
        @endif
        @if ($media->emission_status)
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Emision:</span> {{ $emission_status[$media->emission_status] ?? 'Desconocido' }}</p>
        @endif
        
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Favorito:</span> {{ $media->is_favorite ? 'Si' : 'No' }}</p>
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Lista de deseo:</span> {{ $media->is_wish ? 'Si' : 'No' }}</p>
        
        @if ($media->media_watcheds->count() > 0)
        <p class="mb-2 text-xs sm:text-base text-gray-800 italic">Visto {{ $media->media_watcheds->count() == 1 ? $media->media_watcheds->count().' vez' : $media->media_watcheds->count().' veces' }}</p>
            @foreach ($media->media_watcheds as $item)
                @if ((\Carbon\Carbon::parse($item->start_date)->diffInDays($item->end_date)) == 0)
                    <div class="px-3 border-l-4 border-purple-800">
                        <p class="mb-2 text-xs sm:text-base text-gray-800">{{ $item->end_date }}</p>
                    </div>
                @else

                    <div class="px-3 border-l-4 border-purple-800">
                        <p class="mb-2 text-xs sm:text-base text-gray-800">{{ $item->start_date }} - {{ $item->end_date }} en {{ \Carbon\Carbon::parse($item->start_date)->diffInDays($item->end_date) }} dias</p>
                    </div>
                @endif



            @endforeach
        @endif

        @if ($media->personal_description)
        <p class="mt-4 sm:mt-0 mb-4 text-xl sm:text-2xl font-bold text-gray-950">Descripcion personal</p>
        <p class="mb-4 text-sm sm:text-base text-gray-800 whitespace-pre-wrap">{!! $media->personal_description !!}</p>
        @endif

        </div>
        
</div>
