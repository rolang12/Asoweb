{{-- {{dd($notificaciones)}} --}}
<div class="my-auto" >
    <div x-data="{ open: false }">
        
        <div
            x-data="{body: ''}"
            x-show="body.length"
            x-cloak
            x-on:notification.window="body = $event.detail.body; setTimeout(() => body = '', $event.detail.timeout || 2000)"
            class="fixed bottom-2 right-2 flex px-4 py-6 items-start pointer-events-none">
            <div class="w-full flex flex-col items-center space-y-4">
                <div class="max-w-sm w-full bg-yellow-500 rounded-lg pointer-events-auto">
                    <div class="p-4 flex items-center">
                        <div class="ml-2 w flex-1 text-white">
                            <span x-text="body"></span>
                        </div>
                        <button class="inline-flex text-gray-400" x-on:click="body = ''">
                            <span class="sr-only">Close</span>
                            <span class="text-2xl">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <i  x-on:click="open=!open" class="fa-solid fa-message text-white hover:text-gray-200 text-lg px-4 "></i>

        <div x-show="open" x-on:click.away="open = false" class="bg-gray-50 my-3 absolute">

            <div class="">

                <ul class="bg-gray-50 " >
                @forelse ($notificaciones as $notificacion)
                    <li class="px-4 py-2 bg-gray-50 shadow-lg w-44 right-36 hover:bg-gray-100 text-left ">

                        
                        <div class="text-xs font-bold text-blue-800" >{{$notificacion->user->name}}</div><div class="text-xs"> Te ha enviado un mensaje</div> 
                        
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