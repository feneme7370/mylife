<div class="w-full">

    {{-- breadcrum, title y button --}}
    <x-pages.breadcrums.breadcrum title_1="Inicio" link_1="{{ route('dashboard') }}" title_2="{{ App\Models\Book::title() }}"
        link_2="{{ route('book_dashboard') }}" title_3="Editar Libro" link_3="{{ route('book_list') }}" />

    <x-pages.menus.title-and-btn>

        @slot('title')
        <x-pages.titles.title-pages title="Editar Libro" />
        @endslot

        @slot('button')
        <a href="{{ route('book_dashboard') }}" class="text-sm font-medium text-gray-600 hover:underline ">
            Volver
        </a>
        @endslot
    </x-pages.menus.title-and-btn>
    {{-- end breadcrum, title y button --}}


    <form wire:submit.prevent="saveBook"
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

        {{-- <div class="col-span-12 sm:col-span-6">
            <x-pages.forms.label-form for="selected_book_authors" value="{{ __('Autores') }}" />
            <x-pages.forms.select2-form multiple wire:model="selected_book_authors" id="selected_book_authors">
                @foreach ($book_authors as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </x-pages.forms.select2-form>
            <x-pages.forms.input-error for="selected_book_authors" />
        </div> --}}

        <div class="col-span-12 sm:col-span-6">
            <x-pages.forms.select-multiple
                model="BookAuthor" 
                relation="book_authors" 
                wire:model="selected_book_authors" 
                label="Autores"
                :items="$book_authors"
            />
        </div>

        {{-- <div class="col-span-12 sm:col-span-6">
            <x-pages.forms.label-form for="selected_book_collections" value="{{ __('Coleccion') }}" />
            <x-pages.forms.select2-form multiple wire:model="selected_book_collections" id="selected_book_collections">
                @foreach ($book_collections as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </x-pages.forms.select2-form>
            <x-pages.forms.input-error for="book_collection_id" />
        </div> --}}

        <div class="col-span-12 sm:col-span-6">
            <x-pages.forms.select-multiple
                model="BookCollections" 
                relation="book_collections" 
                wire:model="selected_book_collections" 
                label="Colecciones"
                :items="$book_collections"
            />
        </div>

        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="release_date" value="{{ __('Publicacion') }}" />
            <x-pages.forms.input-form id="release_date" type="date" placeholder="{{ __('Publicacion') }}"
                wire:model="release_date" />
            <x-pages.forms.input-error for="release_date" />
        </div>

        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="pages" value="{{ __('Paginas') }}" />
            <x-pages.forms.input-form id="pages" type="text" placeholder="{{ __('Paginas') }}" wire:model="pages" />
            <x-pages.forms.input-error for="pages" />
        </div>

        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="number_collection" value="{{ __('Orden') }}" />
            <x-pages.forms.input-form id="number_collection" type="text" placeholder="{{ __('Orden') }}"
                wire:model="number_collection" />
            <x-pages.forms.input-error for="number_collection" />
        </div>

        <div class="sm:col-span-3 col-span-6">
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
            <x-pages.forms.label-form for="status" value="{{ __('Estado del libro') }}" />
            <x-pages.forms.select2-form wire:model="status" id="status" value_placeholder="- Estados -">
                @foreach ($status_book as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </x-pages.forms.select2-form>
            <x-pages.forms.input-error for="status" />
        </div>
        
        {{-- <div class="sm:col-span-3 col-span-6">
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
        </div> --}}

        <div class="col-span-12 sm:col-span-6">
            <x-pages.forms.label-form for="media_type" value="{{ __('Tipo de contenido') }}" />
            <x-pages.forms.select2-form wire:model="media_type" id="media_type" value_placeholder="- Tipo -">
                @foreach ($type_content as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </x-pages.forms.select2-form>
            <x-pages.forms.input-error for="media_type" />
        </div>

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

        <div class="col-span-12 sm:col-span-6">
            <x-pages.forms.label-form for="cover_image_url" value="{{ __('URL de portada') }}" />
            <x-pages.forms.input-form id="cover_image_url" type="text" placeholder="{{ __('URL de portada') }}"
                wire:model="cover_image_url" />
            <x-pages.forms.input-error for="cover_image_url" />
        </div>

        <div class="col-span-12 my-1">
            <x-pages.forms.label-form class="col-span-12 mb-3" value="{{ __('Lista de lecturas') }}" />

            <x-pages.buttons.primary-btn class="col-span-4" title="Agregar fecha de lectura" wire:click="addBookReading">
            </x-pages.buttons.primary-btn>

            @foreach($book_readings as $index => $book_reading)
            <div class="grid bg-gray-100 rounded-lg my-1 py-1">
                <x-pages.forms.label-form class="col-span-12" value="{{ __('Leido el') }}" />

                <div class="col-span-5">
                    <x-pages.forms.input-form id="book_readings.{{ $index }}.start_date_table" type="date"
                        placeholder="{{ __('Comenzado') }}" wire:model="book_readings.{{ $index }}.start_date_table" />
                </div>
                <div class="col-span-5">
                    <x-pages.forms.input-form id="book_readings.{{ $index }}.end_date_table" type="date"
                        placeholder="{{ __('Finalizado') }}" wire:model="book_readings.{{ $index }}.end_date_table" />
                </div>

                <div class="flex items-center col-span-2">
                    <x-pages.buttons.normal-btn title="Borrar"
                        wire:click="removeBookReading({{ $index }})">
                    </x-pages.buttons.normal-btn>
                </div>
            </div>
            @endforeach

        </div>

        <div class="col-span-12 my-1">
            <x-pages.forms.label-form class="col-span-12 mb-3" value="{{ __('Generos') }}" />
            <div class="mt-3 flex flex-wrap gap-1">
                @foreach ($book_genres as $item)
    
                <x-pages.forms.label-form for="{{ 'selected_book_genres['. $item->id .']' }}" value="{{ $item->name }}">
                    <x-pages.forms.checkbox-form type="checkbox" id="{{ 'selected_book_genres['. $item->id .']' }}"
                        wire:model="selected_book_genres" value="{{ $item->id }}" />
                </x-pages.forms.label-form>
    
                @endforeach
    
            </div>
        </div>

        <div class="col-span-12 my-1">
            <x-pages.forms.label-form class="col-span-12 mb-3" value="{{ __('Etiquetas') }}" />
            <div class="mt-3 flex flex-wrap gap-1">
                @foreach ($book_tags as $item)
    
                <x-pages.forms.label-form for="{{ 'selected_book_tags['. $item->id .']' }}" value="{{ $item->name }}">
                    <x-pages.forms.checkbox-form type="checkbox" id="{{ 'selected_book_tags['. $item->id .']' }}"
                        wire:model="selected_book_tags" value="{{ $item->id }}" />
                </x-pages.forms.label-form>
    
                @endforeach
            </div>
        </div>

        <div class="col-span-12">
            <x-pages.forms.label-form for="personal_description" value="{{ __('Descripcion personal') }}" />
            <x-pages.forms.quill-textarea-form id_quill="editor_personal_description" name="personal_description"
                rows="15" placeholder="{{ __('Descripcion personal') }}" model="personal_description"
                model_data="{{ $personal_description }}" />

            <x-pages.forms.input-error for="personal_description" />
        </div>

        {{-- <div class="col-span-12" wire:ignore>
            <div id="editor_personal_description" style="height: 300px;"></div>
            <input type="hidden" wire:model="personal_description" id="personal_description">

            <script>
                document.addEventListener("livewire:initialized", function () {
                    var quill = new Quill("#editor_personal_description", {
                        theme: "snow",
                        placeholder: "Escribe aquí...",
                        modules: {
                            toolbar: [
                                [{ header: [1, 2, false] }],
                                ["bold", "italic", "underline"],
                                [{ list: "ordered" }, { list: "bullet" }],
                                ["link", "image"]
                            ]
                        }
                    });

                     // Cargar contenido guardado al iniciar
                    quill.root.innerHTML = @json($personal_description);
            
                    quill.on("text-change", function () {
                        let content = quill.root.innerHTML;
                        @this.set("personal_description", content)
                    });

                    Livewire.hook("morphed",  () => {
                        quill.on("text-change", function () {
                            let content = quill.root.innerHTML;
                            @this.set("personal_description", content)
                        });
                    })

                });
            </script>
        </div> --}}

        <x-pages.forms.validation-errors class="mb-4 col-span-12" />

        <x-pages.buttons.primary-btn class="col-span-4" title="Guardar" wire:click="saveBook">
        </x-pages.buttons.primary-btn>

    </form>


</div>