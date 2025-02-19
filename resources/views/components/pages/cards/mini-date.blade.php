@props(['title' => '', 'href' => '', 'date' => '', 'date_total' => false])

<div class="flex items-center p-2 border border-1 rounded-md border-yellow-800 h-full shadow-md">
    <div class="p-3 mr-4 text-amber-100 rounded-full bg-yellow-800">
      {{$slot}}
    </div>

    <div>
        <a href="{{$href}}">
            <p class="mb-1 text-sm font-semibold text-gray-800 hover:underline">
                {{$title}}
            </p>
        </a>
        <p class="text-xs font-semibold text-gray-700">
            {{$date}} / {{$date_total}}
        </p>
    </div>

</div>