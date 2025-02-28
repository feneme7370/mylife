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
        <script src="{{asset('lib/jquery/jquery.min.js')}}"  ></script>
        <link rel="stylesheet" href="{{asset('lib/lightbox/css/lightbox.min.css')}}">
        <link rel="stylesheet" href="{{asset('lib/toastr/toastr.min.css')}}">

        <script src="{{asset('lib/select2/select2.min.js')}}"></script>
        <link href="{{asset('lib/select2/select2.min.css')}}" rel="stylesheet">
        {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

        <script src="{{asset('lib/quill/quill.js')}}"></script>
        <link href="{{asset('lib/quill/quill.snow.css')}}" rel="stylesheet">
        {{-- <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet"> --}}

    </head>
    <body class="f-serif antialiased transition-all duration-300 ease-in-out bg-purple-50" id="body">

        @include('layouts.includes.sidebarFlowbite')

        <!-- Page Content -->
        <main class="p-4 sm:ml-64 pt-20 min-h-full mb-20">
            {{ $slot }}
        </main>

        @livewireScripts

        <!-- libs -->

        <script src="{{asset('lib/flowbite/flowbite.min.js')}}"  ></script>
        
        <script src="{{asset('lib/lightbox/js/lightbox.min.js')}}"  ></script>
        <script src="{{asset('lib/sweetalert2/sweetalert2.all.min.js')}}"  ></script>
        <script src="{{asset('lib/toastr/toastr.min.js')}}"  ></script>

        @stack('modals')
        @stack('scripts')
    </body>
</html>
