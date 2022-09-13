<div>
    <div style="display: none">{{ $cantidad = 0 }}</div>

    @foreach ($notificaciones as $notificacion)
        <div style="display: none" id="com">
            @if ($notificacion->publicaciones_has_likes->likes->users_id != Auth()->user()->id)
                <div style="display: none"> {{ $cantidad = $cantidad + 1 }}</div>

                <i onclick="mostrar()" wire:click="ver_notificacion({{ $notificacion->id }})"
                    class="{{ $notificacion->status > 0 ? 'text-red-600' : 'text-cyan-900 font-bold' }} fa-solid fa-messages text-cyan-800 text-lg
                            hover:text-cyan-700"><span
                        class="text-sm pb-5">{{ $cantidad }}</span></i>

                        {{-- <div id="dropdownNavbar"
                            class="z-50 absolute w-44 bg-white  divide-y divide-gray-700 shadow border border-gray-300">
                            <ul class="py-1 text-sm text-black " aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="#"
                                        class="block py-2 px-4 hover:bg-gray-100 ">{{ $notificacion->tipo_mensaje }}</a>
                                </li>

                            </ul>
                        </div> --}}
            @endif
        </div>
    @endforeach

    <i class="fa-solid fa-earth-americas text-white hover:text-gray-200 text-lg px-4 py-1"></i>
    {{-- {{ $cantidad }} --}}
    <script>
        function mostrar() {
            document.getElementById("com").style.display = 'block';
        }
    </script>

</div>
