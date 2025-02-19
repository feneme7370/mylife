@if ($errors->any())
    <div {{ $attributes }}>
        {{-- <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div> --}}

        <ul class="bg-red-100 list-none border border-red-400 text-red-700 text-sm px-2 py-1 rounded">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
