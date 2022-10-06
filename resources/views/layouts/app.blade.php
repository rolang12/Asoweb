<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('imagenes/logo1.png') }} ">
    <title>{{ config('app.name', 'Asoweb') }}</title>
    {{-- <script src="{{ asset('assets/js/libs/jquery-ui.js')}}"></script>
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script> --}}
    <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{asset('modal/modalcss.css')}} ">

    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Styles -->
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
 
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    @livewire('navigation-menu')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>


    @stack('modals')

    @livewireScripts
    
    {{-- <script src="{{ asset('modal/bootstrap.min.js')}}"></script>
    <script src="{{ asset('modal/bootstrap.js')}}"></script> --}}

   
</body>

</html>
