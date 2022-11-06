<div x-data="{ open: false }">

    <button x-on:click="open=!open">
        <i class="fa-solid fa-user-group text-white hover:text-gray-200 text-lg"> </i>
        @if ($count > 0)
        <span 
            class="w-4 h-4 right-64 text-xs absolute rounded-full bg-red-600 text-white">{{ $count }}</span>
    @endif
    </button>

    <div class="shadow-lg" x-show.important="open" x-transition  x-on:click.away="open = false">
        <ul class="shadow-lg absolute text-sm h-80 rounded-md right-40 w-80 top-11 bg-white overflow-auto">
            <li class="bg-gray-50 text-gray-500 relative text-left ">
                <div class="p-1" >Solicitudes</div>
            </li>
            <hr>
            @forelse ($solicitudes as $solicitud)
                <li wire:click="soli_vista({{$solicitud}})" class="bg-white text-left  px-5 py-2 shadow-md hover:bg-cyan-100 text-gray-800 overflow-auto">
                   
                    <div class="flex cursor-pointer justify-evenly  ">
                        @if ($solicitud->status == 'Solicitud Enviada'  )
                            <div>
                                <form class="inline-flex "
                                    action="{{ route('perfil', ['id' => $solicitud->users->name]) }}" method="get">
                                    @csrf
                                    <img class="w-10 h-10 rounded-full object-cover"
                                        src="{{ asset('storage/' . $solicitud->users->profile_photo_path) }}"
                                        alt="img">

                                    <div class="ml-2 items-center font-semibold" {{ $solicitud->users->name }}>
                                        Te ha enviado una solicitud de amistad</div>

                                    <input class="font-bold cursor-pointer" type="submit" value="Ver">
                                    <span class="text-right" ><small>{{ \Carbon\Carbon::parse($solicitud->created_at)->diffForHumans() }}</small></span>

                                </form>

                            </div>
                        @else
                            <div >
                                <form class="inline-flex "
                                    action="{{ route('perfil', ['id' => $solicitud->amigos->name]) }}" method="get">
                                    @csrf
                                    <img class="w-10 h-10 rounded-full object-cover"
                                        src="{{ asset('storage/' . $solicitud->amigos->profile_photo_path) }}"
                                        alt="img">

                                    <div class=" ml-2 items-center font-semibold ">{{ $solicitud->amigos->name }} Ha
                                        aceptado tu solicitud de amistad</div>

                                    <input class="font-bold cursor-pointer" type="submit" value="Ver">
                                </form>

                            </div>
                        @endif
                    </div>

                </li>

            @empty

                <li class="bg-white text-left px-5 py-2 shadow-md  text-gray-800">
                    <small class="">No hay Solicitudes</small>
                </li>
            @endforelse
        </ul>

    </div>

</div>
