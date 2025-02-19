@props([
    'placeholder_box_1' => '',
    'property_box_1' => '',
    'placeholder_box_2' => '',
    'property_box_2' => '',
    'placeholder_box_3' => '',
    'property_box_3' => '',
    'placeholder_box_4' => '',
    'property_box_4' => '',
    'placeholder_box_5' => '',
    'property_box_5' => '',
    'placeholder_box_6' => '',
    'property_box_6' => '',
     ])

@if ($placeholder_box_1)
    
<div class="my-1 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-1">
    @if ($placeholder_box_1)
        <div class="flex items-center justify-start">
            <x-pages.forms.label-form value="{{ $placeholder_box_1 }}">
                <x-pages.forms.checkbox-form type="checkbox" class="" wire:model.live="{{ $property_box_1 }}" />
            </x-pages.forms.label-form>
        </div>
    @endif
    @if ($placeholder_box_2)
        <div class="flex items-center justify-start">
            <x-pages.forms.label-form value="{{ $placeholder_box_2 }}">
                <x-pages.forms.checkbox-form type="checkbox" class="" wire:model.live="{{ $property_box_2 }}" />
            </x-pages.forms.label-form>
        </div>
    @endif
    @if ($placeholder_box_3)
        <div class="flex items-center justify-start">
            <x-pages.forms.label-form value="{{ $placeholder_box_3 }}">
                <x-pages.forms.checkbox-form type="checkbox" class="" wire:model.live="{{ $property_box_3 }}" />
            </x-pages.forms.label-form>
        </div>
    @endif
    @if ($placeholder_box_4)
        <div class="flex items-center justify-start">
            <x-pages.forms.label-form value="{{ $placeholder_box_4 }}">
                <x-pages.forms.checkbox-form type="checkbox" class="" wire:model.live="{{ $property_box_4 }}" />
            </x-pages.forms.label-form>
        </div>
    @endif
    @if ($placeholder_box_5)
        <div class="flex items-center justify-start">
            <x-pages.forms.label-form value="{{ $placeholder_box_5 }}">
                <x-pages.forms.checkbox-form type="checkbox" class="" wire:model.live="{{ $property_box_5 }}" />
            </x-pages.forms.label-form>
        </div>
    @endif
    @if ($placeholder_box_6)
        <div class="flex items-center justify-start">
            <x-pages.forms.label-form value="{{ $placeholder_box_6 }}">
                <x-pages.forms.checkbox-form type="checkbox" class="" wire:model.live="{{ $property_box_6 }}" />
            </x-pages.forms.label-form>
        </div>
    @endif
    
</div>
@endif