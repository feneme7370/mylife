@props(['id' => null, 'maxWidth' => null])

<div>
    <x-pages.modals.jetstream.modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
        <div class="px-6 py-4">
            <div class="font-bold text-lg  text-center">
                {{ $title }}
            </div>
    
            <div class="mt-2 text-sm ">
                {{ $content }}
            </div>
        </div>
    
        <div class="flex flex-row justify-end px-6 py-4 gap-2 bg-gray-100 text-end">
            {{ $footer }}
        </div>
    </x-pages.modals.jetstream.modal>
</div>
