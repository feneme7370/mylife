
<div>

    {{-- breadcrum, title y button --}}
        <x-pages.breadcrums.breadcrum 
        title_1="Inicio"
        link_1="{{ route('dashboard') }}"
        />

        <x-pages.menus.title-and-btn>

        @slot('title')
            <x-pages.titles.title-pages title="Bienvenido"/>
        @endslot

        @slot('button')
            <span class="font-bold italic"></span>
        @endslot
        </x-pages.menus.title-and-btn>
    {{-- end breadcrum, title y button --}}


    
    {{-- portada y logo --}}
        <div class="grid grid-cols-2 gap-3 mb-2">



        </div>
    {{-- portada y logo --}}
    
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


        <div class="sm:m-3 p-4 bg-gray-100 border border-gray-200 rounded-lg shadow-sm sm:p-8 ">
    
            <div class="py-2">
                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('book_dashboard') }}">{{ App\Models\Book::title() }}</a></p>
                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('media_dashboard') }}">{{ App\Models\Media::title() }}</a></p>
                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('recipe_dashboard') }}">{{ App\Models\Recipe::title() }}</a></p>
                <p><a class="mb-4 text-sm md:text-base font-bold text-gray-800" href="{{ route('extra_dashboard') }}">{{ App\Models\ExtraPhrase::title() }}</a></p>

            </div>


        </div>
            
    </div>
    {{-- end mini datos --}}



</div>
