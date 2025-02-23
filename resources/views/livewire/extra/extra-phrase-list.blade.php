<div class="w-full">

    {{-- breadcrum, title y button --}}
    <x-pages.breadcrums.breadcrum title_1="Inicio" link_1="{{ route('dashboard') }}" title_2="Extras"
    link_2="{{ route('extra_dashboard') }}" title_3="Frases" link_3="{{ route('extra_phrase_list') }}" />

<x-pages.menus.title-and-btn>

    @slot('title')
    <x-pages.titles.title-pages title="Frases" />
    @endslot

    @slot('button')
    <a href="{{ route('extra_dashboard') }}" class="text-sm font-medium text-gray-600 hover:underline ">
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
        @foreach ($phrases as $item)


        <li class="py-3 sm:py-4">
            <div class="flex items-center">
                <div class="flex-1 min-w-0 ms-4">
                    <p class="text-sm font-medium text-gray-900 truncate ">
                        <a class="hover:underline" href="">{{ $item->description }}</a>
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
<div class="mt-2">{{ $phrases->onEachSide(1)->links() }}</div>
{{-- end Paginacion --}}
</div>

{{-- modal action create --}}
<x-pages.modals.jetstream.dialog-modal wire:model="showCreateModal">
<x-slot name="title">
    {{ __('Formulario') }}
</x-slot> 

<x-slot name="content">
    <form wire:submit="savePhraseCreate" class="sm:m-3 p-4 bg-white border border-purple-200 rounded-lg shadow-sm sm:p-8  ">

        <div>
            <x-pages.forms.label-form for="description" value="{{ __('Frase') }}" />
            <x-pages.forms.textarea-form id="description"
                placeholder="{{ __('Frase') }}" wire:model="description" />
            <x-pages.forms.input-error for="description" />
        </div>

        <div>
            <x-pages.forms.label-form for="name" value="{{ __('Autor') }}" />
            <x-pages.forms.input-form id="name" type="text" placeholder="{{ __('Autor') }}" wire:model="name"
                  />
            <x-pages.forms.input-error for="name" />
          </div>
    
        <x-pages.forms.validation-errors class="mb-4" />

    </form>
</x-slot>

<x-slot name="footer">
    <x-pages.buttons.primary-btn 
    title="Guardar" 
    wire:click="savePhraseCreate" 
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
    <form wire:submit="savePhraseEdit" class="sm:m-3 p-4 bg-white border border-purple-200 rounded-lg shadow-sm sm:p-8  ">
        <div>
            <x-pages.forms.label-form for="description" value="{{ __('Frase') }}" />
            <x-pages.forms.textarea-form id="description"
                placeholder="{{ __('Frase') }}" wire:model="description" />
            <x-pages.forms.input-error for="description" />
        </div>
        
        <div>
            <x-pages.forms.label-form for="name" value="{{ __('Autor de la frase') }}" />
            <x-pages.forms.input-form id="name" type="text" placeholder="{{ __('Autor') }}" wire:model="name"
                  />
            <x-pages.forms.input-error for="name" />
          </div>

<x-pages.forms.validation-errors class="mb-4" />


    </form>
</x-slot>

<x-slot name="footer">
    <x-pages.buttons.primary-btn 
    title="Guardar" 
    wire:click="savePhraseEdit" 
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
    <form wire:submit="deletePhrase" class="sm:m-3 p-4 bg-purple-50 border border-purple-200 rounded-lg shadow-sm sm:p-8  text-center">
        
        <p class="mb-5">Desea borrar la frase?</p>


    </form>
</x-slot>

<x-slot name="footer">
    <x-pages.buttons.primary-btn 
    title="Borrar" 
    wire:click="deletePhrase" 
></x-pages.buttons.primary-btn>
</x-slot>
</x-pages.modals.jetstream.dialog-modal>
{{-- end modal action --}}
</div>
