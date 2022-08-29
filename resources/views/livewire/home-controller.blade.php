<div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-1 md:mx-0 mx-10 ">
    <style>
        .ocultar {
            display: none;
        }

        .visible {
            display: block;
        }
    </style>
    <div></div>



    <div>

        <!-- Empieza la seccion de publicar -->
        <div class="grid grid-rows-2 mt-4 mb-24">
            <div class="my-auto ">

                @if (session()->has('message'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                        <div class="text-center rounded-md mb-3 py-3 w-full text-cyan-700 bg-cyan-100">
                            {{ session('message') }}
                        </div>
                    </div>
                @endif
                <h3 class="text-2xl   text-center font-semibold">¡Escribe tu publicación aquí!<h3>

            </div>
            {{-- <livewire:notificaciones /> --}}

            <div>

                <form wire:submit.prevent="insertar_publicacion()">

                    <div class="grid grid-cols-8 items-center">
                        <div class=""><i class="fa-solid text-amber-500 text-2xl fa-image "></i></div>
                        <div class="col-span-4">
                            {{-- <i wire:model='image' type="file" class="fa-solid fa-image"></i> --}}
                            <input
                                class="file:mr-4 text-sm file:py-2 file:px-4      file:rounded-full file:border-0 file:text-sm file:font-semibold
                                        file:bg-blue-50 file:text-cyan-800 hover:file:bg-cyan-100"
                                wire:model='image' type="file" style="color: transparent">
                        </div>
                        <div class="col-span-3 justify-self-center my-auto">
                            <span>
                                <select class="border-none appearance-none" wire:model='categoria'>
                                    <option selected value="5"></option>
                                    @foreach ($categorias as $categoria)
                                        <option class="p-2 py-4" value="{{ $categoria->id }}">
                                            {{ $categoria->categoria }}</option>
                                    @endforeach
                                    @error('categoria')
                                        <span
                                            class="text-center py-3 text-red-700 font-bold error">{{ $message }}</span>
                                    @enderror

                                </select>
                            </span>
                        </div>

                    </div>


                    <div>
                        <input wire:model='text' class="w-full ring-cyan-800 my-3 rounded-lg border-gray-100"
                            placeholder="Escribe tu publicación aquí..." type="text">
                        @error('text')
                            <span class="text-center py-3 font-bold text-red-700 error">{{ $message }}</span>
                        @enderror

                    </div>


                    <div>
                        <button type="submit"
                            class="hover:bg-gradient-to-l bg-gradient-to-r from-cyan-900 to-cyan-700 w-full p-3 rounded-md font-bold text-white">Publicar</button>

                    </div>

                </form>
            </div>

        </div>
        <!-- Termina la seccion de publicar -->

        <!-- Empieza la seccion de publicaciones -->

        {{ dd($publicaciones) }}

        @foreach ($publicaciones as $publicacion)
            <div class="bg-gray-50 shadow-sm flex flex-col  mt-8 p-5">
                <div class="my-auto">
                    <div class="grid grid-cols-2 justify-around">
                        <a href="{{ route('perfil', ['id' => $publicacion->users->id]) }} "
                            class="text-blue-800 font-bold "> {{ $publicacion->users->name }}</a>
                        <div class="text-right"> {{ $publicacion->created_at }}</div>
                    </div>

                </div>
                <div class="mb-3">
                    <div class="my-2">{{ $publicacion->texto }}</div>
                    @if ($publicacion->imagen != null)
                        <img class="bg-contain w-full" src=" {{ $publicacion->imagen }}" height="200" width="100"
                            alt="">
                    @endif
                </div>

                <div class="grid grid-cols-3 w-full">
                    <div class="pl-5 text-gray-600">
                        {{ $publicacion->cantidad_likes }}
                    </div>
                    <div class="pl-5 text-gray-600"></div>
                    <div class="pl-5 text-gray-600"></div>

                </div>
                <div class="my-auto">

                    <div class="grid grid-cols-4 text-md text-center text-gray-600 font-semibold">


                        <div><i class="fa-regular text-right fa-thumbs-up "></i> </div>
                        <button {{-- class="col-span-1 {{ $publicacion->likes->status == 1 && $publicacion->likes->users_id == Auth()->user()->id ? 'text-blue-600 font-bold' : 'text-gray-500 ' }} " --}} class="col-span-1  " wire:click="like({{ $publicacion->id }})">Me
                            gusta

                        </button>

                        <div>{{ $publicacion->likes }}</div>


                        <div x-data="{ open: false }">
                            <button x-on:click="open=!open">Comentar</button>

                            <div x-show="open" x-on:click.away="open = false "class="bg-gray-50 my-3">

                                <div class="flex flex-col">
                                </div>

                                <input placeholder="Deja tu comentario aquí..." class=" rounded-md border-gray-400 mb-3"
                                    wire:model="comentario" type="text">
                                <div class="">
                                    <div class=""> </div>
                                    <button wire:click.prevent="comentar()"
                                        class="rounded-lg font-semibold bg-cyan-900 text-white  p-2" id="submit"
                                        type="submit" name="sumbit">Comentar</button>

                                </div>

                            </div>
                        </div>

                        <div>Compartir</div>

                    </div>

                </div>
            </div>
        @endforeach
        <!-- Termina la seccion de publicaciones -->

    </div>

    <!-- Empieza la seccion de amigos -->
    <livewire:amigos-view />
    <!-- Termina la seccion de amigos -->


    <script type="text/javascript">
        function comentar() {

            var x = document.getElementById("comen");
            x.classList.toggle("visible");
        }
    </script>


</div>
