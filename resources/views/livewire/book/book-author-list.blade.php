<div class="w-full">

<div class="sm:m-3 p-4 bg-gray-50 border border-purple-200 rounded-lg shadow-sm sm:p-8  ">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-1">
            <x-pages.buttons.create-text wire:click="createActionModal" wire:loading.attr="disabled" />
            <h5 class="text-xl font-bold leading-none text-gray-900 ">Autores</h5>
        </div>
        @if (session('status'))
            <div class="alert alert-success text-sm font-bold leading-none text-red-900 ">
                {{ session('status') }}
            </div>
        @endif</h5>
        <div>
            
            <a href="{{ url()->previous() }}" class="text-sm font-medium text-gray-600 hover:underline ">
                Volver
            </a>
        </div>
   </div>

   <div class="flow-root">
        <ul role="list" class="divide-y divide-purple-200 ">
            @foreach ($authors as $item)
 

            <li class="py-3 sm:py-4">
                <div class="flex items-center">
                    <div class="flex-1 min-w-0 ms-4">
                        <p class="text-sm font-medium text-gray-900 truncate ">
                            {{ $item->name }}
                        </p>
                    </div>

                    <x-pages.buttons.edit-text wire:click="editActionModal({{$item->id}})" wire:loading.attr="disabled" />
                    <x-pages.buttons.delete-text wire:click="deleteActionModal({{$item->id}})"
                    wire:loading.attr="disabled" />
                </div>
            </li>
            @endforeach
            
        </ul>
   </div>

    {{-- Paginacion --}}
    <div class="mt-2">{{ $authors->onEachSide(1)->links() }}</div>
    {{-- end Paginacion --}}
</div>

{{-- modal action create --}}
<x-pages.modals.jetstream.dialog-modal wire:model="showCreateModal">
    <x-slot name="title">
        {{ __('Formulario') }}
    </x-slot> 

    <x-slot name="content">
        <form wire:submit="saveAuthorCreate" class="sm:m-3 p-4 bg-white border border-purple-200 rounded-lg shadow-sm sm:p-8  ">

            <div>
                <x-pages.forms.label-form for="name" value="{{ __('Nombre') }}" />
                <x-pages.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
                      />
                <x-pages.forms.input-error for="name" />
              </div>
               
               <div>
                <x-pages.forms.label-form for="birthdate" value="{{ __('Fecha de nacimiento') }}" />
                <x-pages.forms.input-form id="birthdate" type="date" placeholder="{{ __('Fecha de nacimiento') }}" wire:model="birthdate"
                      />
                <x-pages.forms.input-error for="birthdate" />
              </div>
        
               <div>
                <x-pages.forms.label-form for="country" value="{{ __('Pais') }}" />
                <x-pages.forms.input-form id="country" type="text" placeholder="{{ __('Pais') }}" wire:model="country"
                      />
                <x-pages.forms.input-error for="country" />
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
        wire:click="saveAuthorCreate" 
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
        <form wire:submit="saveAuthorEdit" class="sm:m-3 p-4 bg-white border border-purple-200 rounded-lg shadow-sm sm:p-8  ">
       <div>
        <x-pages.forms.label-form for="name" value="{{ __('Nombre') }}" />
        <x-pages.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
              />
        <x-pages.forms.input-error for="name" />
      </div>
       
       <div>
        <x-pages.forms.label-form for="birthdate" value="{{ __('Fecha de nacimiento') }}" />
        <x-pages.forms.input-form id="birthdate" type="date" placeholder="{{ __('Fecha de nacimiento') }}" wire:model="birthdate"
              />
        <x-pages.forms.input-error for="birthdate" />
      </div>

       <div>
        <x-pages.forms.label-form for="country" value="{{ __('Pais') }}" />
        <x-pages.forms.input-form id="country" type="text" placeholder="{{ __('Pais') }}" wire:model="country"
              />
        <x-pages.forms.input-error for="country" />
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
        wire:click="saveAuthorEdit" 
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
        <form wire:submit="deleteAuthor" class="sm:m-3 p-4 bg-purple-50 border border-purple-200 rounded-lg shadow-sm sm:p-8  text-center">
            
            <p class="mb-5">Desea borrar el autor?</p>
    

        </form>
    </x-slot>

    <x-slot name="footer">
        <x-pages.buttons.primary-btn 
        title="Borrar" 
        wire:click="deleteAuthor" 
    ></x-pages.buttons.primary-btn>
    </x-slot>
  </x-pages.modals.jetstream.dialog-modal>
{{-- end modal action --}}
</div>
