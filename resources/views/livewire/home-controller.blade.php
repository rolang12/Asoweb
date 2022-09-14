<div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-1 md:mx-0 mx-10 ">

    <div></div>

    <div class="-mt-12 ">

        <!-- Empieza la seccion de publicar -->
        <div class="grid grid-rows-2 ">
            <div style="z-index: 99999" class="z-50 mt-36">

                @if (session()->has('message'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                        <div class="text-center rounded-md mb-3 py-3 w-full text-cyan-700 bg-cyan-100">
                            {{ session('message') }}
                        </div>
                    </div>
                @endif

            </div>

            <div>

                <div class="mx-auto bg-red-200 text-white rounded-md" wire:offline>Estás Offline</div>

                <form wire:submit.prevent="insertar_publicacion()">

                    <div class="grid grid-cols-8 items-center">
                        {{-- <div class=""><i class="fa-solid text-amber-500 text-2xl fa-image "></i></div> --}}
                        <div class="col-span-5">
                            {{-- <i wire:model='image' type="file" class="fa-solid fa-image"></i> --}}
                            <input accept="video/webm, video/mp4, video/avi, image/jpeg, image/jpg, image/png"
                                wire:offline.attr="disabled"
                                class="file:mr-4 text-sm file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold
                                        file:bg-blue-50 file:text-cyan-800 hover:file:bg-cyan-100"
                                wire:model='image' type="file">

                        </div>
                        <div class="col-span-3 justify-self-center my-auto">
                            <select class="border-none appearance-none" wire:model='categoria'>
                                <option selected value="5"></option>
                                @foreach ($categorias as $categoria)
                                    <option class="p-2 py-4" value="{{ $categoria->id }}">
                                        {{ $categoria->categoria }}</option>
                                @endforeach


                            </select>
                        </div>

                    </div>


                    <div>
                        <input wire:model='text' class="w-full ring-cyan-800 my-3 rounded-lg border-gray-100"
                            placeholder="Escribe tu publicación aquí..." type="text">
                        @error('text')
                            <span class="text-center py-3 font-bold text-red-700 error">{{ $message }}</span>
                        @enderror
                        <br>
                        @error('image')
                            <span class="text-center py-3 text-red-700 font-bold error">{{ $message }}</span>
                        @enderror
                        @error('categoria')
                            <span class="text-center py-3 text-red-700 font-bold error">{{ $message }}</span>
                        @enderror

                    </div>

                    <div>
                        <button wire:offline.attr="disabled" wire:target="insertar_publicacion"
                            wire:loading.class="from-gray-300 to-gray-200" type="submit" wire:loading.attr="disabled"
                            class="hover:bg-gradient-to-l bg-gradient-to-r from-cyan-900 to-cyan-700 w-full p-3 rounded-md font-bold text-white transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">Publicar</button>

                    </div>
                    <span wire:loading wire:target="insertar_publicacion">
                        Publicando...
                    </span>

                </form>
            </div>

        </div>
        <!-- Termina la seccion de publicar -->

        <!-- Empieza la seccion de publicaciones -->
        @foreach ($publicaciones as $publicacion)
            <div class=" flex flex-col shadow rounded-md mt-8 p-5">
                <div class="my-auto  ">

                    <div class="grid grid-cols-2 justify-around">

                        <div>
                            <a href="{{ route('perfil', ['id' => $publicacion->users->name]) }} "
                                class="text-blue-800 font-bold "> {{ $publicacion->users->name }}
                            </a>
                        </div>

                        @if ($publicacion->users->id == Auth()->user()->id)
                            <div class="text-right " x-data="{ isOpen: false }">

                                <i @click="isOpen = !isOpen" @keydown.escape="isOpen = false"
                                    class="hover:text-cyan-800 text-center fa-solid fa-ellipsis"></i>

                                <ul class="bg-gray-50 text-center right-96 border absolute border-slate-200 rounded-md shadow-lg "
                                    x-show="isOpen" @click.away="isOpen = false">
                                    <li class="p-1 w-32 text-gray-600 hover:bg-cyan-900 hover:text-white">
                                        <button wire:click="editar_post({{ $publicacion->id }})" class="py-2">Editar
                                        </button>

                                    </li>
                                    <li class="p-1 w-32 text-gray-600 hover:bg-cyan-900 hover:text-white">
                                        <button wire:click="eliminar_post({{ $publicacion->id }})"
                                            class="py-2 ">Eliminar
                                        </button>
                                    </li>
                                </ul>


                            </div>
                        @endif
                    </div>

                    <div class="flex  justify-stretch ">
                        <span> <i class="fa-regular fa-clock pr-3 text-xs "></i></span>

                        <div class="hidden" >{{$minutesDiff=$fechaActual->diffInMinutes($publicacion->created_at)}}</div>

                        @switch($minutesDiff)
                            @case($minutesDiff>1 && $minutesDiff<2 )
                                <div class="my-auto text-left text-xs">Hace un momento </div>
                                @break
                            @case($minutesDiff>3 && $minutesDiff<60)
                                <div class="my-auto text-left text-xs">Hace {{ $minutesDiff=$fechaActual->diffInMinutes($publicacion->created_at)  }} minuto(s) </div>
                                @break
                            @case($minutesDiff>60 && $minutesDiff<1440 )
                                <div class="my-auto text-left text-xs">Hace {{ $hoursDiff=$fechaActual->diffInHours($publicacion->created_at)  }} Hora(s) </div>
                                @break
                            @case($minutesDiff>1440)
                                <div class="my-auto text-left text-xs">Hace {{ $hoursDiff=$fechaActual->diffInDays($publicacion->created_at)  }} Día(s) </div>
                                @break
                            @default
                                <!--<div class="my-auto text-left text-xs">Hace {{ $minutesDiff=$fechaActual->diffInMinutes($publicacion->created_at)  }} minuto(s) </div>-->

                        @endswitch

                    </div>

                </div>

                <div class="my-3">
                    <div>  {{ $publicacion->texto }}</div>
                    

                    @if ($publicacion->imagen != null)
                        @if (substr($publicacion->imagen, -1) == '4')
                            <video controls src="{{ asset('storage/posts/' . $publicacion->imagen) }}"></video>
                        @else
                            <img src="{{ asset('storage/posts/' . $publicacion->imagen) }}" alt="imagen ejemplo"
                                class="cover" class="rounded">
                        @endif
                    @endif

                </div>

                <div class="grid grid-cols-4 w-full my-2">
                    <div class="  text-center text-gray-600">
                        {{ $publicacion->cantidad_likes }}
                    </div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

                <div class="my-auto">

                    <div class="grid grid-cols-4 text-md text-center text-gray-600 font-semibold">

                        <div class="text-center"><i class="fa-regular fa-thumbs-up"></i></div>

                        <div>
                            @if ($publicacion->likes == null)
                                <button wire:offline.attr="disabled"
                                    class="text-sm md:text-base col-span-1 text-gray-500 ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 hover:text-blue-800 hover:font-extrabold"
                                    wire:click="like({{ $publicacion->id }})">Me
                                    gusta
                                </button>
                            @else
                                <button wire:offline.attr="disabled"
                                    class="text-sm  md:text-base col-span-1 {{ $publicacion->likes->users_id == Auth()->user()->id && $publicacion->likes->status == 1 ? 'text-blue-600 font-bold' : 'text-gray-500 ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 hover:text-blue-800 hover:font-extrabold' }} "
                                    wire:click="like({{ $publicacion->id }})">Me gusta
                                </button>
                            @endif
                        </div>
                        {{-- x-bind:class="! open ? '' : 'col-span-5'" QUITA O AGREGA UNA CLASE DEPENDE DEL ESTADO OPEN O FALSE --}}
                        <div x-data="{ open: false }">
                            <button class="text-sm md:text-base " x-on:click="open=!open">Comentar</button>

                            <div x-show="open" x-on:click.away="open = false" class="bg-gray-50 my-3 ">

                                <div class="absolute">

                                    @forelse ($publicacion->comentarios as $detalle)
                                        <div class="grid grid-cols-2 py-3">
                                            <div class="text-left">{{ $detalle->texto }}</div>

                                            <a href="{{ route('perfil', ['id' => $detalle->users->name]) }}"
                                                class="text-right text-sm text-blue-800">{{ $detalle->users->name }}</a>

                                        </div>

                                    @empty
                                        <p class="text-sm mb-3 text-gray-500">No hay comentarios aún</p>
                                    @endforelse

                                    <div class="grid grid-cols-2 justify-around w-fit">

                                        <input placeholder="Deja tu comentario aquí..."
                                            class=" rounded-md border-gray-400 mb-3" wire:model="comentario"
                                            type="text">


                                        <button wire:click="comentar({{ $publicacion->id }})"
                                            class="text-sm md:text-base rounded-lg font-semibold bg-cyan-900 text-white -p-2 "
                                            id="submit" type="submit">Comentar
                                        </button>


                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="text-sm md:text-base">Compartir</div>

                    </div>

                </div>
            </div>
        @endforeach
        <!-- Termina la seccion de publicaciones -->

    </div>

    <!-- Empieza la seccion de amigos -->
    <livewire:amigos-view />
    <!-- Termina la seccion de amigos -->

</div>
