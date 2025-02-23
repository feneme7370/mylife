<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <link rel="stylesheet" href="{{asset('lib/lightbox/css/lightbox.min.css')}}">
        <link rel="stylesheet" href="{{asset('lib/toastr/toastr.min.css')}}">

    </head>
    <body class="f-serif antialiased transition-all duration-300 ease-in-out bg-purple-50" id="body">

        @include('layouts.includes.sidebarFlowbite')

        <!-- Page Content -->
        <main class="p-4 sm:ml-64 pt-20 min-h-full mb-20">
            {{ $slot }}
        </main>

        @livewireScripts

        <!-- libs -->
        <script src="{{asset('lib/jquery/jquery.min.js')}}"  ></script>
        <script src="{{asset('lib/flowbite/flowbite.min.js')}}"  ></script>
        

        {{-- <script src="../path/to/flowbite/dist/flowbite.min.js"></script> --}}


        <script src="{{asset('lib/lightbox/js/lightbox.min.js')}}"  ></script>
        <script src="{{asset('lib/sweetalert2/sweetalert2.all.min.js')}}"  ></script>
        <script src="{{asset('lib/toastr/toastr.min.js')}}"  ></script>

        @stack('modals')
        @stack('scripts')
    </body>
</html>
