{{-- {{dd($notificaciones)}} --}}
<div class="my-auto" >
    <div x-data="{ open: false }">
        <i  x-on:click="open=!open" class="fa-solid fa-message text-white hover:text-gray-200 text-lg px-4 py-1"></i>

        <div x-show="open" x-on:click.away="open = false" class="bg-gray-50 my-3 ">

            <div class="absolute">

                <ul class="bg-gray-50 " >
                @forelse ($notificaciones as $notificacion)
                    <li class="p-4">
                        Tienes 
                        {{-- <a href="{{ route('perfil', ['id' => $detalle->users->name]) }}"
                            class="text-right text-sm text-blue-800">{{ $detalle->users->name }}</a> --}}
                    </li>


                @empty
                    <li class="text-sm mb-3 text-gray-500">No tienes mensajes nuevos</li>
                @endforelse
                </ul>
                
            </div>
        </div>
    </div>

    {{-- {{ $cantidad }} --}}
    {{-- <script>
        function mostrar() {
            document.getElementById("com").style.display = 'block';
        }
    </script> --}}

</div>
