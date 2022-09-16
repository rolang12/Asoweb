{{-- {{dd($notificaciones)}} --}}
<div class="my-auto" >
    <div x-data="{ open: false }">
        
        {{-- @if( count($notificaciones) > 0 )
            <div>
                <i  x-on:click="open=!open" class="fa-solid fa-message text-white hover:text-gray-200 text-lg px-4 "></i>
                <i class="-ml-6  text-red-500 fa-solid fa-circle"></i>
                <span class="text-white" >{{count($notificaciones)}}</span>
            </div>
        @else
        @endif --}}
        <i  x-on:click="open=!open" class="fa-solid fa-message text-white hover:text-gray-200 text-lg px-4 "></i>

        <div x-show="open" x-on:click.away="open = false" class="bg-gray-50 my-3 absolute">

            <div class="">

                <ul class="bg-gray-50 " >
                @forelse ($notificaciones as $notificacion)
                    <li class="px-4 py-2 bg-gray-50 shadow-lg w-44 right-36 hover:bg-gray-100 text-left ">

                        <a href="#" >

                        <div class="text-xs font-bold text-blue-800" >{{$notificacion->user->name}}</div><div class="text-xs"> Te ha enviado un mensaje</div> 
                        </a>
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