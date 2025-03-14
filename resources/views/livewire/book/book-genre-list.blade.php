<div class="w-full">

    {{-- breadcrum, title y button --}}
    <x-pages.breadcrums.breadcrum title_1="Inicio" link_1="{{ route('dashboard') }}" title_2="Libros"
        link_2="{{ route('book_dashboard') }}" title_3="Genero" link_3="{{ route('book_genre_list') }}" />

    <x-pages.menus.title-and-btn>

        @slot('title')
        <x-pages.titles.title-pages title="Genero" />
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
                @foreach ($genres as $item)


                <li class="py-3 sm:py-4 w-full">
                    <div class="flex items-center justify-between gap-2">
                            <img class="h-10 sm:h-16 rounded-lg object-cover" src="{{ $item->cover_image_url ?? 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg'}}" alt="Portada">
                            <div class="">
                                <p class="text-sm font-medium text-gray-900 truncate ">
                                    <a class="hover:underline" href="{{ route('book_library', ['g' => $item->uuid]) }}">{{ $item->name }}</a>
                                </p>
                            </div>

                            <a href="{{ route('book_library', ['g' => $item->uuid]) }}" class="bg-purple-900 text-purple-50 text-xs font-medium me-2 px-2.5 py-0.5 rounded-lg">
                                {{ $item->books->count() }}
                            </a>

                            <div class="flex-1"></div>
                            <div>
                                <x-pages.buttons.edit-text wire:click="editActionModal('{{$item->uuid}}')" wire:loading.attr="disabled" />
                                <x-pages.buttons.delete-text wire:click="deleteActionModal('{{$item->uuid}}')"
                                wire:loading.attr="disabled" />
                            </div>
                    </div>
                    <div class="mt-2">
                        <p class="text-xs font-light text-gray-700 line-clamp-2 max-w-3xl">
                            {{ $item->description }}
                        </p>
                    </div>
            </li>
                @endforeach

            </ul>
        </div>

        {{-- Paginacion --}}
        <div class="mt-2">{{ $genres->onEachSide(1)->links() }}</div>
        {{-- end Paginacion --}}
    </div>

    {{-- modal action create --}}
    <x-pages.modals.jetstream.dialog-modal wire:model="showCreateModal">
        <x-slot name="title">
            {{ __('Formulario') }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit="saveGenreCreate"
                class="sm:m-3 p-4 bg-white border border-purple-200 rounded-lg shadow-sm sm:p-8  ">

                <div>
                    <x-pages.forms.label-form for="name" value="{{ __('Nombre') }}" />
                    <x-pages.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}"
                        wire:model="name" />
                    <x-pages.forms.input-error for="name" />
                </div>

                <div class="col-span-12">
                    <x-pages.forms.label-form for="cover_image_url" value="{{ __('URL del genre') }}" />
                    <x-pages.forms.input-form id="cover_image_url" type="text" placeholder="{{ __('URL del genre') }}" wire:model="cover_image_url"
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
            <x-pages.buttons.primary-btn title="Guardar" wire:click="saveGenreCreate"></x-pages.buttons.primary-btn>
        </x-slot>
    </x-pages.modals.jetstream.dialog-modal>
    {{-- end modal action create --}}
    {{-- modal action edit --}}
    <x-pages.modals.jetstream.dialog-modal wire:model="showEditModal">
        <x-slot name="title">
            {{ __('Formulario') }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit="saveGenreEdit"
                class="sm:m-3 p-4 bg-white border border-purple-200 rounded-lg shadow-sm sm:p-8  ">
                <div>
                    <x-pages.forms.label-form for="name" value="{{ __('Nombre') }}" />
                    <x-pages.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}"
                        wire:model="name" />
                    <x-pages.forms.input-error for="name" />
                </div>

                <div class="col-span-12">
                    <x-pages.forms.label-form for="cover_image_url" value="{{ __('URL del genre') }}" />
                    <x-pages.forms.input-form id="cover_image_url" type="text" placeholder="{{ __('URL del genre') }}" wire:model="cover_image_url"
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
            <x-pages.buttons.primary-btn title="Guardar" wire:click="saveGenreEdit"></x-pages.buttons.primary-btn>
        </x-slot>
    </x-pages.modals.jetstream.dialog-modal>
    {{-- end modal action edit --}}
    {{-- modal action --}}
    <x-pages.modals.jetstream.dialog-modal wire:model="showDeleteModal">
        <x-slot name="title">
            {{ __('Formulario') }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit="deleteGenre"
                class="sm:m-3 p-4 bg-purple-50 border border-purple-200 rounded-lg shadow-sm sm:p-8  text-center">

                <p class="mb-5">Desea borrar el genero?</p>


            </form>
        </x-slot>

        <x-slot name="footer">
            <x-pages.buttons.primary-btn title="Borrar" wire:click="deleteGenre"></x-pages.buttons.primary-btn>
        </x-slot>
    </x-pages.modals.jetstream.dialog-modal>
    {{-- end modal action --}}
</div>