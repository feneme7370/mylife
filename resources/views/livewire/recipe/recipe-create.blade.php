<div class="w-full">

    {{-- breadcrum, title y button --}}
    <x-pages.breadcrums.breadcrum title_1="Inicio" link_1="{{ route('dashboard') }}" title_2="{{ App\Models\Recipe::title() }}"
    link_2="{{ route('recipe_dashboard') }}" title_3="Crear {{ App\Models\Recipe::title() }}" link_3="{{ route('recipe_list') }}" />

<x-pages.menus.title-and-btn>

    @slot('title')
    <x-pages.titles.title-pages title="Crear {{ App\Models\Recipe::title() }}" />
    @endslot

    @slot('button')
    <a href="{{ route('recipe_dashboard') }}" class="text-sm font-medium text-gray-600 hover:underline ">
        Volver
    </a>
    @endslot
</x-pages.menus.title-and-btn>
{{-- end breadcrum, title y button --}}


    <form wire:submit.prevent="saveRecipe" class="grid grid-cols-12 gap-1 sm:m-3 p-4 bg-white border border-purple-200 rounded-lg shadow-sm sm:p-8  ">

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

        {{-- <div class="col-span-12 sm:col-span-6">
            <x-pages.forms.label-form for="selected_recipe_categories" value="{{ __('Categorias') }}" />
            <x-pages.forms.select2-form multiple wire:model="selected_recipe_categories" id="selected_recipe_categories">
              @foreach ($recipe_categories as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
            </x-pages.forms.select2-form>
            <x-pages.forms.input-error for="selected_recipe_categories" />
        </div> --}}

        <div class="col-span-12 sm:col-span-6">
            <x-pages.forms.select-multiple
                model="RecipeCategory" 
                relation="recipe_categories" 
                wire:model="selected_recipe_categories" 
                label="Categorias"
                :items="$recipe_categories"
            />
        </div>
          
        <div class="col-span-12 sm:col-span-6">
            <x-pages.forms.label-form for="cover_image_url" value="{{ __('URL de portada') }}" />
            <x-pages.forms.input-form id="cover_image_url" type="text" placeholder="{{ __('URL de portada') }}" wire:model="cover_image_url"
                  />
            <x-pages.forms.input-error for="cover_image_url" />
        </div>


        <div class="my-3 flex flex-wrap gap-1 col-span-12">
            @foreach ($recipe_tags as $item)
            
            <x-pages.forms.label-form for="{{ 'selected_recipe_tags['. $item->id .']' }}" value="{{ $item->name }}">
                <x-pages.forms.checkbox-form 
                    type="checkbox" 
                    id="{{ 'selected_recipe_tags['. $item->id .']' }}" 
                    wire:model="selected_recipe_tags" 
                    value="{{ $item->id }}"  />
            </x-pages.forms.label-form>

            @endforeach

        </div>

        <div class="col-span-12">
            <x-pages.forms.label-form for="ingredients" value="{{ __('Ingredientes') }}" />
            <x-pages.forms.quill-textarea-form id_quill="editor_ingredients" name="ingredients" rows="15" placeholder="{{ __('Ingredientes') }}"
                model="ingredients" model_data="{{ $ingredients }}" />
            
            <x-pages.forms.input-error for="ingredients" />
        </div>

        <div class="col-span-12">
            <x-pages.forms.label-form for="steps" value="{{ __('Pasos') }}" />
            <x-pages.forms.quill-textarea-form id_quill="editor_steps" name="steps" rows="15" placeholder="{{ __('Pasos') }}"
                model="steps" model_data="{{ $steps }}" />
            
            <x-pages.forms.input-error for="steps" />
        </div>

        <x-pages.forms.validation-errors class="mb-4 col-span-12" />


        <x-pages.buttons.primary-btn 
        class="col-span-4"
        title="Guardar" 
        wire:click="saveRecipe" 
        ></x-pages.buttons.primary-btn>

    </form>


</div>
