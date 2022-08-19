<div class="grid grid-cols-3">

    <div></div>
    <!-- Empieza la seccion de publicar -->

    <div>

        <div class="grid grid-rows-4 divide-y  ">
            <div class="my-auto p-8- ">
                <h3 class="text-2xl  text-center font-semibold">¡Escribe tu publicación aquí!</h3>
            </div>

            <div class="grid grid-cols-2 content-center">
                <div class="col ">
                    {{-- <i wire:model='image' type="file" class="fa-solid fa-image"></i> --}}
                    <input
                        class="file:mr-4 text-sm file:py-2 file:px-4      file:rounded-full file:border-0 file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-800 hover:file:bg-blue-100"
                        wire:model='image' type="file" style="color: transparent">
                </div>
                <div class="col justify-self-center my-auto">
                    <span>Categoría</span>
                    <select class="border-none appearance-none" wire:model="categoria" id="">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                        @endforeach
                    </select>
                </div>


            </div>


            <div>
                <textarea wire:model='text' class="w-full mb-3 border-gray-100" placeholder="Escribe tu publicación aquí..."
                    id="" cols="30" rows="5"></textarea>

            </div>


            <div>
                <button type="button" wire:click="insertar_publicacion()"
                    class="bg-gradient-to-r from-blue-900 to-blue-700 w-full p-3 rounded-md font-bold text-white">Publicar</button>

            </div>




        </div>
        <!-- Termina la seccion de publicar -->


        @foreach ($publicaciones as $publicacion)
            <div class="bg-gray-50 shadow-md grid grid-rows-3 mt-5">
                <div class="py-5">
                    <div class="grid grid-cols-2 justify-around">

                        <div class="text-blue-800 font-bold "> {{ $publicacion->users->name }}</div>
                        <div> {{ $publicacion->created_at }}</div>
                    </div>

                </div>
                <div>
                    {{ $publicacion->texto }}

                </div>
                <div>
                    <div class="grid grid-cols-3">
                        <div>Me gusta</div>
                        <div>Comentar</div>
                        <div>Compartir</div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <div></div>



</div>
