<div>
    <div class="ml-6">
        <div class="mt-2">
            <div class="text-gray-600">
                <input wire:model="search" type="search" name="search" placeholder="Buscar Publicación"
                    class="bg-white w-20 border border-gray-400 rounded-md lg:w-96 h-10 px-5 pr-10 text-sm focus:outline-none ">
            </div>


            @if ($search == !'')
                @if ($publicaciones->count())
                    <button data-collapse-toggle="mobile-menu" type="button"
                        class="ml-3 text-gray-400  md:hidden hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-cyan-300 "
                        aria-controls="mobile-menu-2" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div id="dropdownNavbar"
                        class="z-50 absolute w-96 bg-white  divide-y divide-gray-700 shadow border border-gray-300">
                        <ul class="py-1 text-sm text-black " aria-labelledby="dropdownLargeButton">
                            @foreach ($publicaciones as $publicacion)
                                <li>
                                    <a href="#"
                                        class="block py-2 px-4 hover:bg-gray-100 ">{{ $publicacion->texto }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="p-3 t-1 border border-gray-300 bg-gray-100 text-gray-500 absolute z-50">
                            No hay resultados para la busqueda <b>{{ $search }}</b>
                        </div>
                @endif
            @endif
        </div>
    </div>

</div>
