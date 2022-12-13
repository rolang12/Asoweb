<div id="{{ $publicacion->id }}" class="bg-gray-50 py-2 " style="display: none";>
    <div class="hidden">{{$contador=0}}</div>
    @forelse ($publicacion->comentarios as $detalle)
        <div class="hidden">{{$contador+=1}}</div>
      
            @if ($contador > 3)
                <p onclick="ver_mas()" id="vermas" class="text-sm underline cursor-pointer text-cyan-700">Ver más </p>
                <div id="comentarios" class="flex flex-row justify-between py-2 px-1" style="display: none"; >
                    <div class="text-left text-sm ">{{ $detalle->texto }}</div>
                    <small>
                        <strong class="">
    
                            <a href="{{ route('perfil', ['id' => $detalle->users->name]) }}" class="text-sm text-blue-800"><small
                                    class="text-right ">{{ $detalle->users->name }}</small>
                            </a>
    
                            @if ($detalle->users->id == Auth::user()->id)
                                <i title="Eliminar" onclick="confirmComment('{{ $detalle->id }}')"
                                    class="cursor-pointer fa-solid fa-trash text-red-500"> </i>
                                <i title="Editar" wire:click="editar_comentario({{ $detalle->id }})"
                                    class="cursor-pointer fa-solid fa-pen-to-square text-cyan-800 "></i>
                            @endif
    
    
                        </strong>
                    </small>
                </div>
            @else
                
            

            <div class="flex flex-row justify-between py-2 px-1" >
                <div class="text-left text-sm ">{{ $detalle->texto }}</div>
                <small>
                    <strong class="">

                        <a href="{{ route('perfil', ['id' => $detalle->users->name]) }}" class="text-sm text-blue-800"><small
                                class="text-right ">{{ $detalle->users->name }}</small>
                        </a>

                        @if ($detalle->users->id == Auth::user()->id)
                            <i title="Eliminar" onclick="confirmComment('{{ $detalle->id }}')"
                                class="cursor-pointer fa-solid fa-trash text-red-500"> </i>
                            <i title="Editar" wire:click="editar_comentario({{ $detalle->id }})"
                                class="cursor-pointer fa-solid fa-pen-to-square text-cyan-800 "></i>
                        @endif


                    </strong>
                </small>
            </div>
            @endif
        

    @empty
        <center class="text-sm my-3 text-gray-500">No hay comentarios aún</center>
    @endforelse
    <div>

        <input placeholder="Deja tu comentario aquí..." class="md:w-96 lg:w-96 xl:w-96 w-48 rounded-md border-gray-400 mb-3" wire:model="comentario"
            type="text">

        <button wire:click="comentar({{ $publicacion->id }})"
            class="text-sm md:text-base rounded-lg font-semibold bg-cyan-900 text-white w-1/3 py-2 inline-block px-6 mt-4 xs leading-tight uppercase  shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" id="submit"
            type="submit"  data-mdb-ripple="true"
            data-mdb-ripple-color="light">Comentar
        </button>

    </div>
</div>
