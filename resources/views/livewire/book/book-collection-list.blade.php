<div class="w-full">

        {{-- breadcrum, title y button --}}
        <x-pages.breadcrums.breadcrum title_1="Inicio" link_1="{{ route('dashboard') }}" title_2="Libros"
        link_2="{{ route('book_dashboard') }}" title_3="Colecciones" link_3="{{ route('book_collection_list') }}" />

    <x-pages.menus.title-and-btn>

        @slot('title')
        <x-pages.titles.title-pages title="Colecciones" />
        @endslot

        @slot('button')
        <a href="{{ route('book_dashboard') }}" class="text-sm font-medium text-gray-600 hover:underline ">
            Volver
        </a>
        @endslot
    </x-pages.menus.title-and-btn>
    {{-- end breadcrum, title y button --}}

    <div class="sm:m-3 p-4 bg-gray-50 border border-purple-200 rounded-lg shadow-sm sm:p-8  ">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-1">
                <h5 class="text-xl font-bold leading-none text-gray-900 ">Listado</h5>
            </div>
            @if (session('status'))
                <div class="alert alert-success text-sm font-bold leading-none text-red-900 ">
                    {{ session('status') }}
                </div>
            @endif</h5>
            <div>
                <x-pages.buttons.create-text class="text-sm font-medium text-gray-700 hover:text-gray-500 hover:underline " wire:click="createActionModal" wire:loading.attr="disabled" />
            </div>
       </div>
    
       <div class="flow-root">
            <ul role="list" class="divide-y divide-purple-200 ">
                @foreach ($collections as $item)
     
    
                <li class="py-3 sm:py-4">
                    <div class="flex items-center">
                        <div class="flex-1 min-w-0 ms-4">
                            <p class="text-sm font-medium text-gray-900 truncate ">
                                <a class="hover:underline" href="{{ route('book_library', ['c' => $item->uuid]) }}">{{ $item->name }}</a>
                            </p>
                        </div>
    
                        <x-pages.buttons.edit-text wire:click="editActionModal('{{$item->uuid}}')" wire:loading.attr="disabled" />
                        <x-pages.buttons.delete-text wire:click="deleteActionModal('{{$item->uuid}}')"
                        wire:loading.attr="disabled" />
                    </div>
                </li>
                @endforeach
                
            </ul>
       </div>
    
        {{-- Paginacion --}}
        <div class="mt-2">{{ $collections->onEachSide(1)->links() }}</div>
        {{-- end Paginacion --}}
    </div>
    
    {{-- modal action create --}}
    <x-pages.modals.jetstream.dialog-modal wire:model="showCreateModal">
        <x-slot name="title">
            {{ __('Formulario') }}
        </x-slot> 
    
        <x-slot name="content">
            <form wire:submit="saveCollectionCreate" class="sm:m-3 p-4 bg-white border border-purple-200 rounded-lg shadow-sm sm:p-8  ">
    
                <div>
                    <x-pages.forms.label-form for="name" value="{{ __('Nombre') }}" />
                    <x-pages.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
                          />
                    <x-pages.forms.input-error for="name" />
                  </div>
            
                  <div class="col-span-12">
                    <x-pages.forms.label-form for="cover_image_url" value="{{ __('URL del tag') }}" />
                    <x-pages.forms.input-form id="cover_image_url" type="text" placeholder="{{ __('URL del tag') }}" wire:model="cover_image_url"
                          />
                    <x-pages.forms.input-error for="cover_image_url" />
                </div>
        
                  <div>
                    <x-pages.forms.label-form for="description" value="{{ __('Descripcion') }}" />
                    <x-pages.forms.textarea-form id="description"
                        placeholder="{{ __('Descripcion del autor') }}" wire:model="description" />
                    <x-pages.forms.input-error for="description" />
                </div>
            
                <x-pages.forms.validation-errors class="mb-4" />
        
            </form>
        </x-slot>
    
        <x-slot name="footer">
            <x-pages.buttons.primary-btn 
            title="Guardar" 
            wire:click="saveCollectionCreate" 
        ></x-pages.buttons.primary-btn>
        </x-slot>
      </x-pages.modals.jetstream.dialog-modal>
    {{-- end modal action create --}}
    {{-- modal action edit --}}
    <x-pages.modals.jetstream.dialog-modal wire:model="showEditModal">
        <x-slot name="title">
            {{ __('Formulario') }}
        </x-slot> 
    
        <x-slot name="content">
            <form wire:submit="saveCollectionEdit" class="sm:m-3 p-4 bg-white border border-purple-200 rounded-lg shadow-sm sm:p-8  ">
           <div>
            <x-pages.forms.label-form for="name" value="{{ __('Nombre') }}" />
            <x-pages.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
                  />
            <x-pages.forms.input-error for="name" />
          </div>
    
          <div class="col-span-12">
            <x-pages.forms.label-form for="cover_image_url" value="{{ __('URL del tag') }}" />
            <x-pages.forms.input-form id="cover_image_url" type="text" placeholder="{{ __('URL del tag') }}" wire:model="cover_image_url"
                  />
            <x-pages.forms.input-error for="cover_image_url" />
        </div>

          <div>
            <x-pages.forms.label-form for="description" value="{{ __('Descripcion') }}" />
            <x-pages.forms.textarea-form id="description"
                placeholder="{{ __('Descripcion del autor') }}" wire:model="description" />
            <x-pages.forms.input-error for="description" />
        </div>
    
        <x-pages.forms.validation-errors class="mb-4" />
        
    
            </form>
        </x-slot>
    
        <x-slot name="footer">
            <x-pages.buttons.primary-btn 
            title="Guardar" 
            wire:click="saveCollectionEdit" 
        ></x-pages.buttons.primary-btn>
        </x-slot>
      </x-pages.modals.jetstream.dialog-modal>
    {{-- end modal action edit --}}
    {{-- modal action --}}
    <x-pages.modals.jetstream.dialog-modal wire:model="showDeleteModal">
        <x-slot name="title">
            {{ __('Formulario') }}
        </x-slot> 
    
        <x-slot name="content">
            <form wire:submit="deleteCollection" class="sm:m-3 p-4 bg-purple-50 border border-purple-200 rounded-lg shadow-sm sm:p-8  text-center">
                
                <p class="mb-5">Desea borrar la coleccion?</p>
        
    
            </form>
        </x-slot>
    
        <x-slot name="footer">
            <x-pages.buttons.primary-btn 
            title="Borrar" 
            wire:click="deleteCollection" 
        ></x-pages.buttons.primary-btn>
        </x-slot>
      </x-pages.modals.jetstream.dialog-modal>
    {{-- end modal action --}}
    </div>
    