<div class="w-full">

    {{-- breadcrum, title y button --}}
    <x-pages.breadcrums.breadcrum title_1="Inicio" link_1="{{ route('dashboard') }}" title_2="{{ App\Models\Media::title() }}"
        link_2="{{ route('media_dashboard') }}" title_3="Editar {{ $type_content[$type] }}"
        link_3="{{ route('media_list') }}" />

    <x-pages.menus.title-and-btn>

        @slot('title')
        <x-pages.titles.title-pages title="Editar {{ $type_content[$type] }}" />
        @endslot

        @slot('button')
        <a href="{{ route('media_dashboard') }}" class="text-sm font-medium text-gray-600 hover:underline ">
            Volver
        </a>
        @endslot
    </x-pages.menus.title-and-btn>
    {{-- end breadcrum, title y button --}}


    <form wire:submit.prevent="saveMedia"
        class="grid grid-cols-12 gap-1 sm:m-3 p-4 bg-white border border-purple-200 rounded-lg shadow-sm sm:p-8  ">
        <div class="col-span-12">
            <x-pages.forms.label-form for="title" value="{{ __('Titulo') }}" />
            <x-pages.forms.input-form id="title" type="text" placeholder="{{ __('Titulo') }}" wire:model="title" />
            <x-pages.forms.input-error for="title" />
        </div>

        <div class="col-span-12">
            <x-pages.forms.label-form for="original_title" value="{{ __('Titulo original') }}" />
            <x-pages.forms.input-form id="original_title" type="text" placeholder="{{ __('Titulo original') }}"
                wire:model="original_title" />
            <x-pages.forms.input-error for="original_title" />
        </div>

        <div class="col-span-12">
            <x-pages.forms.label-form for="synopsis" value="{{ __('Sinopsis') }}" />
            <x-pages.forms.textarea-form id="synopsis" placeholder="{{ __('Sinopsis') }}" wire:model="synopsis" />
            <x-pages.forms.input-error for="synopsis" />
        </div>

        <div class="col-span-12 sm:col-span-6">
            <x-pages.forms.select-multiple
                model="MediaActors" 
                relation="media_actors" 
                wire:model="selected_media_actors" 
                label="Actores"
                :items="$media_actors"
            />
        </div>

        <div class="col-span-12 sm:col-span-6">
            <x-pages.forms.select-multiple
                model="MediaDirectors" 
                relation="media_directors" 
                wire:model="selected_media_directors" 
                label="Director"
                :items="$media_directors"
            />
        </div>

        <div class="col-span-12 sm:col-span-6">
            <x-pages.forms.select-multiple
                model="MediaCollection" 
                relation="media_collections" 
                wire:model="selected_media_collections" 
                label="Coleccion"
                :items="$media_collections"
            />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-pages.forms.label-form for="release_date" value="{{ __('Lanzamiento') }}" />
            <x-pages.forms.input-form id="release_date" type="date" placeholder="{{ __('Lanzamiento') }}"
                wire:model="release_date" />
            <x-pages.forms.input-error for="release_date" />
        </div>

        <div class="col-span-6 sm:col-span-3 ">
            <x-pages.forms.label-form for="rating" value="{{ __('Valoracion') }}" />
            <x-pages.forms.select2-form wire:model="rating" id="rating" value_placeholder="- Valoraciones -">
                @foreach ($valoration_stars as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </x-pages.forms.select2-form>
            <x-pages.forms.input-error for="rating" />
        </div>

        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="emission_status" value="{{ __('Estado de emision') }}" />
            <x-pages.forms.select2-form wire:model="emission_status" id="emission_status" value_placeholder="- Estados -">
                @foreach ($emissions_status as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </x-pages.forms.select2-form>
            <x-pages.forms.input-error for="emission_status" />
        </div>

        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="format" value="{{ __('Formato') }}" />
            <x-pages.forms.select2-form wire:model="format" id="format" value_placeholder="- Formatos -">
                @foreach ($formats as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </x-pages.forms.select2-form>
            <x-pages.forms.input-error for="format" />
        </div>

        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="status" value="{{ __('Estado del vision') }}" />
            <x-pages.forms.select2-form wire:model="status" id="status" value_placeholder="- Estados -">
                @foreach ($status_media as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </x-pages.forms.select2-form>
            <x-pages.forms.input-error for="status" />
        </div>

        @if ($type == 1)

        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="number_collection" value="{{ __('Orden') }}" />
            <x-pages.forms.input-form id="number_collection" type="text" placeholder="{{ __('Orden') }}"
                wire:model="number_collection" />
            <x-pages.forms.input-error for="number_collection" />
        </div>
        @endif

        @if ($type == 1)

        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="duration" value="{{ __('Duracion en minutos') }}" />
            <x-pages.forms.input-form id="duration" type="text" placeholder="{{ __('Duracion') }}"
                wire:model="duration" />
            <x-pages.forms.input-error for="duration" />
        </div>
        @endif



        {{-- @if ($type == 1)
        <div class="sm:col-span-6 col-span-12">
            <x-pages.forms.label-form for="end_date" value="{{ __('Visto') }}" />
            <x-pages.forms.input-form id="end_date" type="date" placeholder="{{ __('Visto') }}" wire:model="end_date" />
            <x-pages.forms.input-error for="end_date" />
        </div>
        @endif
        @if ($type == 2)
        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="start_date" value="{{ __('Comenzado') }}" />
            <x-pages.forms.input-form id="start_date" type="date" placeholder="{{ __('Comenzado') }}"
                wire:model.live="start_date" />
            <x-pages.forms.input-error for="start_date" />
        </div>

        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="end_date" value="{{ __('Finalizado') }}" />
            <x-pages.forms.input-form id="end_date" type="date" placeholder="{{ __('Finalizado') }}"
                wire:model.live="end_date" />
            <x-pages.forms.input-error for="end_date" />
        </div>
        @endif --}}

        <div class="col-span-12">
            <div class="col-span-12 sm:col-span-6">
                <x-pages.forms.label-form for="is_favorite" value="Favorito">
                    <x-pages.forms.checkbox-form type="checkbox" id="is_favorite"
                        wire:model="is_favorite" value="is_favorite" />
                </x-pages.forms.label-form>
            </div>
            <div class="col-span-12 sm:col-span-6">
                <x-pages.forms.label-form for="is_wish" value="Lista de deseo">
                    <x-pages.forms.checkbox-form type="checkbox" id="is_wish"
                        wire:model="is_wish" value="is_wish" />
                </x-pages.forms.label-form>
            </div>
        </div>

        <div class="col-span-12">
            <x-pages.forms.label-form for="cover_image_url" value="{{ __('URL de portada') }}" />
            <x-pages.forms.input-form id="cover_image_url" type="text" placeholder="{{ __('URL de portada') }}"
                wire:model="cover_image_url" />
            <x-pages.forms.input-error for="cover_image_url" />
        </div>

        <div class="col-span-12 my-1">
            <x-pages.forms.label-form class="col-span-12 mb-3" value="{{ __('Lista de vistas') }}" />

            <x-pages.buttons.primary-btn class="col-span-4" title="Agregar fecha de vista" wire:click="addMediaWatched">
            </x-pages.buttons.primary-btn>

            @foreach($media_watcheds as $index => $media_watched)
            <div class="grid bg-gray-100 rounded-lg my-1 py-1 gap-1">
                <x-pages.forms.label-form class="col-span-12" value="{{ __('Visto el') }}" />

                <div class="col-span-5">
                    <x-pages.forms.input-form id="media_watcheds.{{ $index }}.start_date_table" type="date" placeholder="{{ __('Comenzado') }}"
                        wire:model="media_watcheds.{{ $index }}.start_date_table" />
                </div>
                <div class="col-span-5">
                    <x-pages.forms.input-form id="media_watcheds.{{ $index }}.end_date_table" type="date" placeholder="{{ __('Finalizado') }}"
                        wire:model="media_watcheds.{{ $index }}.end_date_table" />
                </div>
                <div class="flex items-center col-span-2">
                    <x-pages.buttons.normal-btn title="Borrar"
                        wire:click="removeMediaWatched({{ $index }})">
                    </x-pages.buttons.normal-btn>
                </div>
            </div>
            @endforeach

        </div>

        <div class="col-span-12 my-1">
            <x-pages.forms.label-form class="col-span-12 mb-3" value="{{ __('Generos') }}" />
            <div class="my-3 flex flex-wrap gap-1">
                @foreach ($media_genres as $item)

                <x-pages.forms.label-form for="{{ 'selected_media_genres['. $item->id .']' }}"
                    value="{{ $item->name }}">
                    <x-pages.forms.checkbox-form type="checkbox" id="{{ 'selected_media_genres['. $item->id .']' }}"
                        wire:model="selected_media_genres" value="{{ $item->id }}" />
                </x-pages.forms.label-form>

                @endforeach

            </div>
        </div>

        <div class="col-span-12 my-1">
            <x-pages.forms.label-form class="col-span-12 mb-3" value="{{ __('Etiquetas') }}" />
            <div class="mt-3 flex flex-wrap gap-1">
                @foreach ($media_tags as $item)

                <x-pages.forms.label-form for="{{ 'selected_media_tags['. $item->id .']' }}" value="{{ $item->name }}">
                    <x-pages.forms.checkbox-form type="checkbox" id="{{ 'selected_media_tags['. $item->id .']' }}"
                        wire:model="selected_media_tags" value="{{ $item->id }}" />
                </x-pages.forms.label-form>

                @endforeach

            </div>
        </div>

        @if ($type == 2)
        <div class="col-span-12 my-1">
            <x-pages.forms.label-form class="col-span-12 mb-3" value="{{ __('Temporadas') }}" />

            <x-pages.buttons.primary-btn class="col-span-4" title="Agregar temporada" wire:click="addSeason">
            </x-pages.buttons.primary-btn>

            @foreach($seasons as $index => $season)
            <div class="grid bg-gray-100 rounded-lg my-1 py-1">
                <x-pages.forms.label-form class="col-span-12" value="{{ __('Temporada') }}" />

                <x-pages.forms.input-form class="col-span-9" type="string"
                    placeholder="{{ __('Nombre de la temporada') }}" wire:model="seasons.{{ $index }}.title" />
                <x-pages.forms.input-form class="col-span-3" type="number"
                    placeholder="{{ __('Cantidad de capitulos') }}" wire:model="seasons.{{ $index }}.episodes_count" />
                <x-pages.forms.textarea-form class="col-span-12" rows="3"
                    placeholder="{{ __('Descripcion de la temporada') }}"
                    wire:model="seasons.{{ $index }}.description" />

                <span class="col-span-9"></span>
                <x-pages.buttons.normal-btn class="col-span-3" title="Borrar temp."
                    wire:click="removeSeason({{ $index }})">
                </x-pages.buttons.normal-btn>
            </div>
            @endforeach

        </div>

        @endif

        <div class="col-span-12">
            <x-pages.forms.label-form for="personal_description" value="{{ __('Descripcion personal') }}" />
            <x-pages.forms.quill-textarea-form id_quill="editor_personal_description" name="personal_description"
                rows="15" placeholder="{{ __('Descripcion personal') }}" model="personal_description"
                model_data="{{ $personal_description }}" />

            <x-pages.forms.input-error for="personal_description" />
        </div>


        <x-pages.forms.validation-errors class="mb-4 col-span-12" />

        <x-pages.buttons.primary-btn class="col-span-4" title="Guardar" wire:click="saveMedia">
        </x-pages.buttons.primary-btn>

    </form>

</div>