<div class="w-full ">


    <div class="sm:m-3 p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm sm:p-8">

        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-1">
                <h5 class="text-xl font-bold leading-none text-gray-900 ">{{ App\Models\Recipe::title() }}</h5>
            </div>
            @if (session('status'))
                <div class="alert alert-success text-sm font-bold leading-none text-red-900 ">
                    {{ session('status') }}
                </div>
            @endif</h5>
            <div>
                
                <a href="{{ route('recipe_dashboard') }}" class="text-sm font-medium text-gray-600 hover:underline ">
                    Volver
                </a>
            </div>
       </div>

        <img src="{{ $recipe->cover_image_url }}" class="w-full sm:w-auto sm:h-96 mx-auto mb-1 sm:mb-5" alt="">

        <div class="flex justify-between items-center gap-1">
            <h5 class="mt-4 sm:mt-0 mb-4 text-xl sm:text-2xl font-bold text-gray-950">{{ $recipe->title }}</h5>
            <a href="{{ route('recipe_edit', ['type' => $recipe->recipe_type, 'uuid' => $recipe->uuid]) }}" class="font-medium text-gray-600  hover:underline"><x-pages.buttons.edit-text/></a>
        </div>

        <p class="mb-4 text-sm sm:text-base text-gray-800 whitespace-pre-wrap">{{ $recipe->synopsis }}</p>

        <p class="mt-4 sm:mt-0 mb-2 text-xl sm:text-2xl font-bold text-gray-950"> Datos</p>

        @if (!$recipe->recipe_categories->isEmpty())
        <p class="mt-1 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Categoria:</span></p>
        <div class="mb-2">
            @foreach ($recipe->recipe_categories as $item)
                <a class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg" href="{{ route('recipe_list', ['c' => $item->uuid]) }}">{{ $item->name }}</a>
            @endforeach
        </div>
        @endif

        @if (!$recipe->recipe_tags->isEmpty())
        <p class="mt-1 text-sm sm:text-base text-gray-800"><span class="text-gray-950 font-bold">Etiquetas:</span></p>
        <div class="mb-2">
            @foreach ($recipe->recipe_tags as $item)
            <a class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg" href="{{ route('recipe_list', ['t' => $item->uuid]) }}">{{ $item->name }}</a>
            @endforeach
        </div>
        @endif

        @if ($recipe->ingredients)
        <p class="mt-4 sm:mt-0 mb-4 text-xl sm:text-2xl font-bold text-gray-950">Ingredientes</p>
        <p class="mb-4 text-sm sm:text-base text-gray-800 whitespace-pre-wrap">{!! $recipe->ingredients !!}</p>
        @endif

        @if ($recipe->steps)
        <p class="mt-4 sm:mt-0 mb-4 text-xl sm:text-2xl font-bold text-gray-950">Pasos</p>
        <p class="mb-4 text-sm sm:text-base text-gray-800 whitespace-pre-wrap">{!! $recipe->steps !!}</p>
        @endif

        </div>
        
</div>
