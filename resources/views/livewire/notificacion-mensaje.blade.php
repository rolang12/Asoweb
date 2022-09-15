{{-- {{dd($notificaciones)}} --}}
<div class="my-auto" >
    <div x-data="{ open: false }">
        <i  x-on:click="open=!open" class="fa-solid fa-message text-white hover:text-gray-200 text-lg px-4 "></i>

        <div x-show="open" x-on:click.away="open = false" class="bg-gray-50 my-3 absolute">

            <div class="">

                <ul class="bg-gray-50 " >
                @forelse ($notificaciones as $notificacion)
                    <li class="px-4 py-2   bg-gray-50 shadow-lg w-44 right-36 hover:bg-blue-100 text-left ">
                        <div class="text-sm" >{{$notificacion->user->name}} Te ha enviado un mensaje</div> 
                        
                        {{-- <a href="{{ route('perfil', ['id' => $detalle->users->name]) }}"
                            class="text-right text-sm text-blue-800">{{ $detalle->users->name }}</a> --}}
                    </li>
                    <hr>


                @empty
                    <li class="text-sm mb-3 text-gray-500">No tienes mensajes nuevos</li>
                @endforelse
                </ul>
                
            </div>
        </div>
    </div>

    {{-- {{ $cantidad }} --}}
    <script>
        var xhr = new XMLHttpRequest();
        
    </script> 

</div>
