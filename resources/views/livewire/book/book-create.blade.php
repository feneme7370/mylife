<div class="w-full">
    <form wire:submit.prevent="saveBook" class="grid grid-cols-12 gap-1 sm:m-3 p-4 bg-white border border-purple-200 rounded-lg shadow-sm sm:p-8  ">
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
            <x-pages.forms.label-form for="book_author_id" value="{{ __('Autor') }}" />
            <x-pages.forms.select-form wire:model="book_author_id" id="book_author_id" value_placeholder="- Autores -">
              @foreach ($authors as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
            </x-pages.forms.select-form>
            <x-pages.forms.input-error for="book_author_id" />
        </div>

        <div class="col-span-6">
            <x-pages.forms.label-form for="book_collection_id" value="{{ __('Coleccion') }}" />
            <x-pages.forms.select-form wire:model="book_collection_id" id="book_collection_id" value_placeholder="- Colecciones -">
              @foreach ($collections as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
            </x-pages.forms.select-form>
            <x-pages.forms.input-error for="book_collection_id" />
          </div>

        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="release_date" value="{{ __('Publicacion') }}" />
            <x-pages.forms.input-form id="release_date" type="date" placeholder="{{ __('Publicacion') }}" wire:model="release_date"
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
            <x-pages.forms.label-form for="pages" value="{{ __('Paginas') }}" />
            <x-pages.forms.input-form id="pages" type="text" placeholder="{{ __('Paginas') }}" wire:model="pages"
                  />
            <x-pages.forms.input-error for="pages" />
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

        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="start_date" value="{{ __('Comenzado') }}" />
            <x-pages.forms.input-form id="start_date" type="date" placeholder="{{ __('Comenzado') }}" wire:model="start_date"
                  />
            <x-pages.forms.input-error for="start_date" />
        </div>

        <div class="sm:col-span-3 col-span-6">
            <x-pages.forms.label-form for="end_date" value="{{ __('Finalizado') }}" />
            <x-pages.forms.input-form id="end_date" type="date" placeholder="{{ __('Finalizado') }}" wire:model="end_date"
                  />
            <x-pages.forms.input-error for="end_date" />
        </div>

        <div class="col-span-12 sm:col-span-6">
            <x-pages.forms.label-form for="status" value="{{ __('Estado') }}" />
            <x-pages.forms.select-form wire:model="status" id="status" value_placeholder="- Estados -">
                <option selected>Estados</option>
              @foreach ($statusBook as $key => $value)
                  <option value="{{ $key }}">{{ $value }}</option>
              @endforeach
            </x-pages.forms.select-form>
            <x-pages.forms.input-error for="status" />
          </div>

        <div class="col-span-12">
            <x-pages.forms.label-form for="cover_image_url" value="{{ __('URL de portada') }}" />
            <x-pages.forms.input-form id="cover_image_url" type="text" placeholder="{{ __('URL de portada') }}" wire:model="cover_image_url"
                  />
            <x-pages.forms.input-error for="cover_image_url" />
        </div>

        <div class="my-3 flex flex-wrap gap-1 col-span-12">
            @foreach ($book_tags as $item)
            
            <x-pages.forms.label-form for="{{ 'selected_book_tags['. $item->id .']' }}" value="{{ $item->name }}">
                <x-pages.forms.checkbox-form 
                    type="checkbox" 
                    id="{{ 'selected_book_tags['. $item->id .']' }}" 
                    wire:model="selected_book_tags" 
                    value="{{ $item->id }}"  />
            </x-pages.forms.label-form>

            @endforeach

        </div>

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
        wire:click="saveBook" 
    ></x-pages.buttons.primary-btn>
    </form>
</div>
