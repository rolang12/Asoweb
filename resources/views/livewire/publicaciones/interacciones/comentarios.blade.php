<div x-data="{ open: false }">
    <button class="text-sm md:text-base " x-on:click="open=!open">Comentar</button>

    <div x-show="open" x-on:click.away="open = false" class="bg-gray-50 my-3 ">

        <div class="">

            @forelse ($publicacion->comentarios as $detalle)
               <div class="flex flex-col" >
                        <div class="text-left">{{ $detalle->texto }}</div>

                        <a href="{{ route('perfil', ['id' => $detalle->users->name]) }}"
                            class="text-right text-sm text-blue-800">{{ $detalle->users->name }}</a>
                </div>
                   

            @empty
                <p class="text-sm mb-3 text-gray-500">No hay comentarios aún</p>
            @endforelse

            <div class="p-3 ">

                <input placeholder="Deja tu comentario aquí..."
                    class=" rounded-md border-gray-400 mb-3" wire:model="comentario"
                    type="text">


                <button wire:click="comentar({{ $publicacion->id }})"
                    class="text-sm md:text-base rounded-lg font-semibold bg-cyan-900 text-white p-2 "
                    id="submit" type="submit">Comentar
                </button>


            </div>

        </div>
    </div>
</div>