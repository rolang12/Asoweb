<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Asoweb</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Styles -->

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
    <header class="bg-transparent fixed w-full top-0 left-0 z-30">
        <div class="container p-5 mx-auto  flex items-center justify-between ">
            <div class="flex mx-auto">
                <a href="{{ asset('imagenes/icon.JPG') }}" target="" title="logo"
                    class="text-center text-gray-500 focus:outline-none"><img src="{{ asset('imagenes/icon.JPG') }}"
                        alt="aji" class="object-cover mx-auto  rounded-full w-10 h-10">
                    <p class="text-xl text-white">Aso<strong>web</strong></p>
                </a>
            </div>

        </div>
    </header>
    <div
        class="bg-white absolute top-0 left-0 bg-gradient-to-b from-cyan-700 via-cyan-800 to-cyan-900 bottom-0 leading-5 h-full w-full overflow-hidden">
        <svg class="relative block " style="width: calc(100% + 10px);" data-name="Layer 1"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path
                d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                fill="#fff"></path>
        </svg>
    </div>
    <div
        class="relative  mt-20 sm:mt-0 min-h-screen  sm:flex sm:flex-row  justify-center bg-transparent p-6 sm:p-24 sm:pb-0 rounded-3xl shadow-xl">
        <div class="flex-col flex  self-center lg:p-14 sm:max-w-4xl xl:max-w-md  z-10">
            <div class="self-start hidden lg:flex flex-col  text-gray-300">

                <h1 class="my-3 font-semibold text-4xl">¡Bienvenid@ a Asoweb!</h1>
                <p class="pr-3 text-sm opacity-75">Un espacio para la familia de la clínica, donde puedes interactuar
                    con la comunidad,
                    un lugar para compartir
                </p>
            </div>
        </div>
        <div class="flex justify-center self-center  z-10">
            <div class="p-12 bg-gradient-to-b from-gray-900 via-gray-900 to-cyan-800 mx-auto rounded-3xl w-96 ">

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="mb-7">
                    <h3 class="font-semibold text-2xl text-gray-300">Iniciar Sesión</h3>
                    <x-jet-validation-errors class="mb-4" />

                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="space-y-6">
                        <div class="">
                            <input id="email"
                                class="w-full text-sm  px-4 py-3 bg-gray-900 border  border-gray-700 rounded-lg focus:outline-none focus:border-purple-400"
                                type="email" name="email" :value="old('email')" required autofocus>
                        </div>



                        <div class="relative" x-data="{ show: true }">
                            <input id="password" name="password" placeholder="Password"
                                :type="show ? 'password' : 'text'"
                                class="text-sm text-gray-200 px-4 py-3 rounded-lg w-full bg-gray-900 border border-gray-700 focus:outline-none focus:border-cyan-400">
                            <div class="flex items-center absolute inset-y-0 right-0 mr-3  text-sm leading-5">

                                <svg @click="show = !show" :class="{ 'hidden': !show, 'block': show }"
                                    class="h-4 text-cyan-900" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    viewbox="0 0 576 512">
                                    <path fill="currentColor"
                                        d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                    </path>
                                </svg>

                                <svg @click="show = !show" :class="{ 'block': !show, 'hidden': show }"
                                    class="h-4 text-cyan-900" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    viewbox="0 0 640 512">
                                    <path fill="currentColor"
                                        d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                    </path>
                                </svg>

                            </div>
                        </div>


                        <div class="flex items-center justify-between">

                            <div class="text-sm ml-auto">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-cyan-800 hover:text-cyan-600">
                                        Olvidaste tu contraseña?
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full flex justify-center bg-yellow-600  hover:bg-yellow-700 text-gray-100 p-3 rounded-lg tracking-wide font-semibold cursor-pointer transition ease-in duration-500">
                                Iniciar Sesión
                            </button>
                        </div>


                    </div>
                </form>
            </div>

        </div>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>
</body>


</html>
