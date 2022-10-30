<div x-data="{ open: false } "  class="basis-2/5" >
    
    <button class="text-sm md:text-base " x-on:click="open=!open">Comentar</button>

    <div x-show.important="open" x-transition x-on:click.away="open = false"  class="bg-gray-50 py-2">

        
            @forelse ($publicacion->comentarios as $detalle)
               <div class="flex flex-row justify-around py-2 px-1" >
                    <div class="text-left text-md ">{{ $detalle->texto }}</div>
                    <small>
                        <strong>
                        <a href="{{ route('perfil', ['id' => $detalle->users->name]) }}"
                            class="text-right text-sm text-blue-800">{{ $detalle->users->name }}
                        </a>
                    </strong>
                    </small>
                </div>
                   

            @empty
                <p class="text-sm my-3 text-gray-500">No hay comentarios aún</p>
            @endforelse

            <div class="p-3 grid grid-cols-2">

                <input placeholder="Deja tu comentario aquí..."
                    class=" rounded-md border-gray-400 mb-3" wire:model="comentario"
                    type="text">
                    
                <button wire:click="comentar({{ $publicacion->id}})"
                    class="text-sm md:text-base rounded-lg font-semibold bg-cyan-900 text-white p-1 "
                    id="submit" type="submit">Comentar
                </button>

            </div>
            

    </div>

</div>
