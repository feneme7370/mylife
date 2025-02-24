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

        <h5 class="mt-4 sm:mt-0 mb-4 text-xl sm:text-2xl font-bold text-gray-950">{{ $media->title }}</h5>
        
        <p class="mb-4 text-base sm:text-base text-gray-800">{{ \Carbon\Carbon::parse($media->release_date)->year }} - 
            
            @foreach ($media->media_directors as $item)
                <a href="{{ route('media_library', ['d' => $item->uuid]) }}">{{ $item->name }}</a>
            @endforeach

        </p>

        <p class="mb-4 text-base sm:text-base text-gray-800">
            
            @foreach ($media->media_actors as $item)
                <a class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg" href="{{ route('media_library', ['a' => $item->uuid]) }}">{{ $item->name }}</a>
            @endforeach

        </p>

        <p class="mb-4 text-sm sm:text-base text-gray-800 whitespace-pre-wrap">{{ $media->synopsis }}</p>

        <p class="mt-4 sm:mt-0 mb-4 text-xl sm:text-2xl font-bold text-gray-950"> Datos</p>

        @foreach ($media->media_collections as $item)
            <a href="{{ route('media_library', ['c' => $item->uuid]) }}">Coleccion: {{ $item->name }}{{ '['.$media->number_collection.']' }}</a>
        @endforeach

        <div class="mb-2">
            @foreach ($media->media_tags as $item)
            <a class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg" href="{{ route('media_library', ['t' => $item->uuid]) }}">{{ $item->name }}</a>
            @endforeach
        </div>

        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Duracion:</span> {{ $duration_hs->format('%h h %i min') }}</p>
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Valoracion:</span> {{ $valoration_stars[$media->rating] ?? 'Desconocido' }}</p>
        <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Estado:</span> {{ $status_media[$media->status] ?? 'Desconocido' }}</p>

        @foreach ($media->seasons as $season_item)
        <div class="px-3 border-l-4 border-purple-800">
            <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Temporada:</span> {{ $season_item->title }} ({{ $season_item->episodes_count }} cap.)</p>
            <p class="mb-2 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Descripcion:</span> {{ $season_item->description }}</p>
        </div>
        @endforeach
        <p class="mt-4 sm:mt-0 mb-4 text-xl sm:text-2xl font-bold text-gray-950">Descripcion personal</p>
        <p class="mb-4 text-sm sm:text-base text-gray-800 whitespace-pre-wrap">{{ $media->personal_description }}</p>

        </div>
        
</div>
