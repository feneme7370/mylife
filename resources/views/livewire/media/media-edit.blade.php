<div class="w-full">

    {{-- breadcrum, title y button --}}
    <x-pages.breadcrums.breadcrum title_1="Inicio" link_1="{{ route('dashboard') }}" title_2="Peliculas y Series"
    link_2="{{ route('media_dashboard') }}" title_3="Crear {{ $type_content[$type] }}" link_3="{{ route('media_list') }}" />

<x-pages.menus.title-and-btn>

    @slot('title')
    <x-pages.titles.title-pages title="Crear {{ $type_content[$type] }}" />
    @endslot

    @slot('button')
    <a href="{{ route('media_dashboard') }}" class="text-sm font-medium text-gray-600 hover:underline ">
        Volver
    </a>
    @endslot
</x-pages.menus.title-and-btn>
{{-- end breadcrum, title y button --}}


    <form wire:submit.prevent="saveMedia" class="grid grid-cols-12 gap-1 sm:m-3 p-4 bg-white border border-purple-200 rounded-lg shadow-sm sm:p-8  ">
        <div class="col-span-12">
            <x-pages.forms.label-form for="title" value="{{ __('Titulo') }}" />
            <x-pages.forms.input-form id="title" type="text" placeholder="{{ __('Titulo') }}" wire:model="title"
                  />
            <x-pages.forms.input-error for="title" />
          </div>

          <div class="col-span-12">
            <x-pages.forms.label-form for="synopsis" value="{{ __('Sinopsis') }}" />
            <x-pages.forms.textarea-form id="synopsis" placeholder="{{ __('Sinopsis') }}"
                wire:model="synopsis" />
            <x-pages.forms.input-error for="synopsis" />
        </div>

        <div class="col-span-6">
            <x-pages.forms.label-form for="selected_media_actors" value="{{ __('Actores') }}" />
            <x-pages.forms.select-form multiple wire:model="selected_media_actors" id="selected_media_actors">
              @foreach ($media_actors as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
            </x-pages.forms.select-form>
            <x-pages.forms.input-error for="selected_media_actors" />
        </div>

        <div class="col-span-6">
            <x-pages.forms.label-form for="selected_media_directors" value="{{ __('Directores') }}" />
            <x-pages.forms.select-form multiple wire:model="selected_media_directors" id="selected_media_directors">
              @foreach ($media_directors as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
            </x-pages.forms.select-form>
            <x-pages.forms.input-error for="selected_media_directors" />
        </div>

        <div class="col-span-6">
            <x-pages.forms.label-form for="selected_media_collections" value="{{ __('Coleccion') }}" />
            <x-pages.forms.select-form multiple wire:model="selected_media_collections" id="selected_media_collections">
              @foreach ($media_collections as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
            </x-pages.forms.select-form>
            <x-pages.forms.input-error for="media_collection_id" />
        </div>

        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="release_date" value="{{ __('Lanzamiento') }}" />
            <x-pages.forms.input-form id="release_date" type="date" placeholder="{{ __('Lanzamiento') }}" wire:model="release_date"
                  />
            <x-pages.forms.input-error for="release_date" />
        </div>

        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="number_collection" value="{{ __('Orden') }}" />
            <x-pages.forms.input-form id="number_collection" type="text" placeholder="{{ __('Orden') }}" wire:model="number_collection"
                  />
            <x-pages.forms.input-error for="number_collection" />
        </div>

        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="duration" value="{{ __('Duracion') }}" />
            <x-pages.forms.input-form id="duration" type="text" placeholder="{{ __('Duracion') }}" wire:model="duration"
                  />
            <x-pages.forms.input-error for="duration" />
        </div>

        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="rating" value="{{ __('Valoracion') }}" />
            <x-pages.forms.select-form wire:model="rating" id="rating" value_placeholder="- Valoraciones -">
              @foreach ($valoration_stars as $key => $value)
                  <option value="{{ $key }}">{{ $value }}</option>
              @endforeach
            </x-pages.forms.select-form>
            <x-pages.forms.input-error for="rating" />
          </div>

        @if ($type == 1)
            <div class="sm:col-span-3 col-span-6">
                <x-pages.forms.label-form for="end_date" value="{{ __('Visto') }}" />
                <x-pages.forms.input-form id="end_date" type="date" placeholder="{{ __('Visto') }}" wire:model="end_date"
                    />
                    {{-- <div class="col-span-12 sm:col-span-6 flex items-center justify-start">
                        <span class="flex w-3 h-3 me-3 bg-purple-500 rounded-full"></span>
                        <span>{{ $status ? $status_media[$status] : 'Estado' }}</span>
                    </div> --}}
                <x-pages.forms.input-error for="end_date" />
            </div>
        @endif
        @if ($type == 2)
            <div class="sm:col-span-3 col-span-6">
                <x-pages.forms.label-form for="start_date" value="{{ __('Comenzado') }}" />
                <x-pages.forms.input-form id="start_date" type="date" placeholder="{{ __('Comenzado') }}" wire:model.live="start_date"
                    />
                <x-pages.forms.input-error for="start_date" />
            </div>

            <div class="sm:col-span-3 col-span-6">
                <x-pages.forms.label-form for="end_date" value="{{ __('Finalizado') }}" />
                <x-pages.forms.input-form id="end_date" type="date" placeholder="{{ __('Finalizado') }}" wire:model.live="end_date"
                    />
                    <div class="col-span-12 sm:col-span-6 flex items-center justify-start">
                        <span class="flex w-3 h-3 me-3 bg-purple-500 rounded-full"></span>
                        <span>{{ $status ? $status_media[$status] : 'Estado' }}</span>
                    </div>
                <x-pages.forms.input-error for="end_date" />
            </div>
        @endif

        
        {{-- <div class="col-span-12 sm:col-span-6">
            <x-pages.forms.label-form for="media_type" value="{{ __('Tipo de contenido') }}" />
            <x-pages.forms.select-form wire:model="media_type" id="media_type" value_placeholder="- Tipo -">
              @foreach ($type_content as $key => $value)
                  <option value="{{ $key }}">{{ $value }}</option>
              @endforeach
            </x-pages.forms.select-form>
            <x-pages.forms.input-error for="media_type" /> 
          </div> --}}

        <div class="col-span-12">
            <x-pages.forms.label-form for="cover_image_url" value="{{ __('URL de portada') }}" />
            <x-pages.forms.input-form id="cover_image_url" type="text" placeholder="{{ __('URL de portada') }}" wire:model="cover_image_url"/>
            <x-pages.forms.input-error for="cover_image_url" />
        </div>

        <div class="mt-3 flex flex-wrap gap-1 col-span-12">
            @foreach ($media_tags as $item)
            
            <x-pages.forms.label-form for="{{ 'selected_media_tags['. $item->id .']' }}" value="{{ $item->name }}">
                <x-pages.forms.checkbox-form 
                    type="checkbox" 
                    id="{{ 'selected_media_tags['. $item->id .']' }}" 
                    wire:model="selected_media_tags" 
                    value="{{ $item->id }}"  />
            </x-pages.forms.label-form>

            @endforeach

        </div>

        @if ($type == 2)
        <div class="col-span-12">
            <x-pages.forms.label-form class="col-span-12" value="{{ __('Temporadas') }}" />
        
            <x-pages.buttons.primary-btn class="col-span-4" title="Agregar temporada" wire:click="addSeason">
            </x-pages.buttons.primary-btn>
        
            @foreach($seasons as $index => $season)
            <div class="grid bg-gray-100 rounded-lg my-1 py-1">
                <x-pages.forms.label-form class="col-span-12" value="{{ __('Temporada') }}" />
        
                <x-pages.forms.input-form class="col-span-9" type="string" placeholder="{{ __('Nombre de la temporada') }}"
                    wire:model="seasons.{{ $index }}.title" />
                <x-pages.forms.input-form class="col-span-3" type="number" placeholder="{{ __('Cantidad de capitulos') }}"
                    wire:model="seasons.{{ $index }}.episodes_count" />
                <x-pages.forms.textarea-form class="col-span-12" rows="3" placeholder="{{ __('Descripcion de la temporada') }}"
                    wire:model="seasons.{{ $index }}.description" />
        
                <x-pages.buttons.normal-btn class="col-span-4" title="Borrar temporada" wire:click="removeSeason({{ $index }})">
                </x-pages.buttons.normal-btn>
            </div>
            @endforeach
        
        </div>
        
        @endif

        <div class="col-span-12">
            <x-pages.forms.label-form for="personal_description" value="{{ __('Descripcion personal') }}" />
            <x-pages.forms.textarea-form id="personal_description" rows="15" placeholder="{{ __('Descripcion personal') }}"
                wire:model="personal_description" />
            <x-pages.forms.input-error for="personal_description" />
        </div>

        
        <x-pages.forms.validation-errors class="mb-4 col-span-12" />

        <x-pages.buttons.primary-btn 
            class="col-span-4"
            title="Guardar" 
            wire:click="saveMedia" 
        ></x-pages.buttons.primary-btn>

    </form>

    
</div>
