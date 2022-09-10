<!-- component -->

<head>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<main class="h-screen w-full flex flex-col justify-center items-center bg-[#1A2238]">
    <h1 class="text-9xl font-extrabold text-white tracking-widest">404</h1>
    <div class="bg-[#ffbe3c] px-2 text-sm rounded rotate-12 absolute">
        Pagina no encontrada
    </div>
    <button class="mt-5">
        <a href="{{ route('inicio') }}"
            class="relative inline-block text-sm font-medium text-[#ffbe3c] group active:text-yellow-300 focus:outline-none focus:ring">
            <span
                class="absolute inset-0 transition-transform translate-x-0.5 translate-y-0.5 bg-[#ffbe3c] group-hover:translate-y-0 group-hover:translate-x-0"></span>

            <span class="relative block px-8 py-3 bg-[#1A2238] border border-current">
                <router-link>Regresar</router-link>
            </span>
        </a>
    </button>

</main>
@livewireScripts
