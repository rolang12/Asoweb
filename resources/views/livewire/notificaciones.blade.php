{{-- {{dd($notificaciones)}} --}}
<div class="my-auto" >

    @if (count($notificaciones) > 0)
        <span style="right: 12.5rem " class="absolute text-xs text-white font-medium inline-flex rounded-full justify-center h-4 w-4 bg-red-500">{{count($notificaciones)}}</span>

    @endif

    <div x-data="{ open: false }">
     
        <i  x-on:click="open=!open" class="fa-solid fa-earth-americas text-white hover:text-gray-200 text-lg  "></i>

        <div x-show="open" x-on:click.away="open = false" class="bg-gray-50 my-3 absolute">


           

            <div class="">

                <ul class="bg-gray-50 " >
                @forelse ($notificaciones as $notificacion)
                    <li class=" py-2 bg-gray-50 shadow-lg w-44 right-36 hover:bg-gray-100 text-left ">

                        
                        {{-- <div class="text-xs font-bold text-blue-800" >{{$notificacion->user->name}}</div><div class="text-xs"> Te ha enviado un mensaje</div>  --}}
                        
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

 

</div>

{{--  
<div class="animate-ping" >

    

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
                        </div> 
            @endif
        </div>
    @endforeach

    <i class="fa-solid fa-earth-americas text-white hover:text-gray-200 text-lg px-1 py-1"></i>

    <script>
        function mostrar() {
            document.getElementById("com").style.display = 'block';
        }
    </script>

</div>
--}}