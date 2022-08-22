<div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-1 md:mx-0 mx-10 ">

    <div></div>

    <div>

        <!-- Empieza la seccion de publicar -->
        <div class="grid grid-rows-2 mb-24">
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

            <div>

                <form wire:submit.prevent="insertar_publicacion()">

                    <div class="grid grid-cols-8 items-center">
                        <div class=""><i class="fa-solid text-amber-500 text-2xl fa-image "></i></div>

                        <div class="col-span-4">
                            {{-- <i wire:model='image' type="file" class="fa-solid fa-image"></i> --}}
                            <input"
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
                                        <span class="error">{{ $message }}</span>
                                    @enderror

                                </select>
                            </span>
                        </div>


                    </div>


                    <div>
                        <input wire:model='text' class="w-full ring-cyan-800 my-3 rounded-lg border-gray-100"
                            placeholder="Escribe tu publicación aquí..." type="text">
                        @error('text')
                            <span class="error">{{ $message }}</span>
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
        {{-- {{ dd($publicaciones) }} --}}
        @foreach ($publicaciones as $publicacion)
            <div class="bg-gray-50 shadow-sm flex flex-col  mt-5 p-5">
                <div class="my-auto">
                    <div class="grid grid-cols-2 justify-around">
                        <div class="text-blue-800 font-bold "> {{ $publicacion->publicaciones->users->name }}</div>
                        <div class="text-right"> {{ $publicacion->publicaciones->created_at }}</div>
                    </div>

                </div>
                <div class="mb-3">
                    <div class="my-2">{{ $publicacion->publicaciones->texto }}</div>
                    <img class="bg-contain w-full" src=" {{ $publicacion->publicaciones->imagen }}" height="200"
                        width="100" alt="">

                </div>

                <div class="grid grid-cols-3 w-full">
                    <div class="pl-5 text-gray-600">{{ $publicacion->likes->cantidad }}</div>
                    <div class="pl-5 text-gray-600"></div>
                    <div class="pl-5 text-gray-600"></div>

                </div>

                <div class="my-auto">

                    <div class="grid grid-cols-3 text-center text-gray-600 font-semibold">
                        <div class="{{ $publicacion->likes->status == '0' ? 'text-gray-600' : 'text-blue-500 ' }} "
                            wire:click="like({{ $publicacion->id }})">Me gusta
                            <span> </span>
                        </div>

                        {{-- <livewire:like-controller /> --}}

                        <div onclick="comentario()">Comentar</div>



                        <div>Compartir</div>

                    </div>
                    <div id="com" style="display: none" class="bg-gray-50 my-3 flex flex-col ">

                        <div class="flex flex-col">
                            {{-- <div>{{ $publicacion->publicaciones->comentarios->texto }}</div> --}}
                        </div>


                        <input placeholder="Deja tu comentario aquí..." class="w-full rounded-md border-gray-400 mb-3"
                            wire:model="comentario" type="text">
                        <div class="grid grid-cols-3">
                            <div class="col-span-2"> </div>
                            <button wire:click.prevent="comentar()"
                                class="rounded-lg font-semibold bg-cyan-900 text-white w-full p-2" id="submit"
                                type="submit" name="sumbit">Comentar</button>

                        </div>

                    </div>
                </div>
            </div>
        @endforeach
        <!-- Termina la seccion de publicaciones -->

    </div>

    <!-- Empieza la seccion de amigos -->

    <div class="grid
                        grid-cols-2">
        <div></div>

        <div class="flex flex-col ">
            <div class="grid grid-cols-2 mx-auto">
                <i class="fa-solid fa-user-group my-auto text-center text-cyan-900 "></i>

                <div class="text-center font-semibold py-3">Amigos</div>

            </div>

            @forelse ($amigos as $amigo)
                <div class="grid grid-cols-2 py-2 text-right">
                    <span class="text-left">
                        <div>{{ $amigo->amigos->name }}</div>
                    </span>
                    <span><i
                            class="fa-solid fa-circle {{ $amigo->amigos->status == '0' ? 'text-green-500' : 'text-red-500' }}"></i>
                    </span>
                </div>
            @empty
                <div class="text-center">Aún no tienes amigos</div>
            @endforelse

        </div>



    </div>
    <!-- Termina la seccion de amigos -->


    <script>
        function comentario() {
            document.getElementById("com").style.display = 'block';
        }
    </script>


</div>
