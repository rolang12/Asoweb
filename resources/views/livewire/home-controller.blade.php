<div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-1 md:mx-0 mx-10 ">

    <div></div>


    <div>
        <!-- Empieza la seccion de publicar -->
        <div class="grid grid-rows-2 h-80 mb-24">
            <div class="my-auto ">
                @if (session()->has('message'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                        <div class="text-center rounded-md mb-3 py-3 w-full text-blue-800 bg-blue-300">
                            {{ session('message') }}
                        </div>
                    </div>
                @endif
                <h3 class="text-2xl   text-center font-semibold">¡Escribe tu publicación aquí!<h3>

            </div>

            <div>

                <form wire:submit.prevent="insertar_publicacion()">

                    <div class="grid grid-cols-2 content-center">
                        <div class="">
                            {{-- <i wire:model='image' type="file" class="fa-solid fa-image"></i> --}}
                            <input
                                class="file:mr-4 text-sm file:py-2 file:px-4      file:rounded-full file:border-0 file:text-sm file:font-semibold
                                        file:bg-blue-50 file:text-blue-800 hover:file:bg-blue-100"
                                wire:model='image' type="file" style="color: transparent">
                        </div>
                        <div class=" justify-self-center my-auto">
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
                        <textarea wire:model='text' class="w-full my-3 border-gray-100" placeholder="Escribe tu publicación aquí..."
                            id="" cols="30" rows="5"></textarea>
                        @error('text')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>


                    <div>
                        <button type="submit"
                            class="bg-gradient-to-r from-blue-900 to-blue-700 w-full p-3 rounded-md font-bold text-white">Publicar</button>

                    </div>


                </form>
            </div>




        </div>
        <!-- Termina la seccion de publicar -->

        <!-- Empieza la seccion de publicaciones -->

        @foreach ($publicaciones as $publicacion)
            <div class="bg-gray-50 shadow-sm grid grid-rows-3 mt-5 p-5">
                <div class="py-5">
                    <div class="grid grid-cols-2 justify-around">
                        <div class="text-blue-800 font-bold "> {{ $publicacion->users->name }}</div>
                        <div class="text-right"> {{ $publicacion->created_at }}</div>
                    </div>

                </div>
                <div>
                    {{ $publicacion->texto }}

                </div>
                <div>
                    <img src=" {{ $publicacion->imagen }}" alt="">

                </div>
                <div class="my-auto">
                    <div class="grid grid-cols-3 text-center text-gray-600 ">
                        <div class="">Me gusta</div>
                        <div>Comentar</div>
                        <div>Compartir</div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- Termina la seccion de publicaciones -->

    </div>

    <!-- Empieza la seccion de amigos -->

    <div class="grid grid-cols-2">
        <div></div>

        <div class="flex flex-col ">
            <div class="text-center font-semibold py-3">Amigos</div>

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




</div>
