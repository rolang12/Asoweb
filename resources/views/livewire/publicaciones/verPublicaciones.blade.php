<div>
    <style>
        .tes{
            font-family: monospace;
        }
    </style>
    @foreach ($publicaciones as $publicacion)
        {{-- @include('livewire.publicaciones.verCompartidos') --}}

        <div id="{{ $publicacion->texto }}" class=" flex flex-col shadow rounded-md mt-8 p-5">
            <div class="my-auto">

                @if ($publicacion->comp_status == 'si')
                    <div class=" p-1 rounded-lg">
                        <div class="bg-gray-100 flex justify-between">
                            <strong>{{ $publicacion->compartidos->name }}</strong>
                            <div>Ha compartido una publicaci贸n de</div>
                            <strong>{{ $publicacion->users->name }}</strong>
                            <small>{{ \Carbon\Carbon::parse($publicacion->created_at)->diffForHumans() }}</small>
                        </div>
                        <p class="my-2">{{ $publicacion->comp_texto }}</p>
                    </div>
                @endif
                <div class="grid grid-cols-2 justify-around">

                    <div>
                        <a href="{{ route('perfil', ['id' => $publicacion->users->name]) }} "
                            class="text-blue-800 font-bold "> {{ $publicacion->users->name }}
                        </a>
                    </div>

                    @if ($publicacion->users->id == Auth()->user()->id)
                        <div class="text-right " x-data="{ isOpen: false }">
                            <button>
                                <i @click="isOpen = !isOpen" @keydown.escape="isOpen = false"
                                    class="hover:text-cyan-800 text-center fa-solid fa-ellipsis"></i>
                            </button>
                            <ul class="bg-gray-50 text-center right-94 md:right-64 border absolute border-slate-200 rounded-md shadow-lg "
                                x-show="isOpen" x-transition @click.away="isOpen = false">

                                <!-- Acciones -->
                                @include('livewire.publicaciones.acciones.editarPublicacion')
                                @include('livewire.publicaciones.acciones.eliminarPublicacion')

                            </ul>

                        </div>
                    @endif

                </div>

                <div class="grid grid-cols-2">

                    <div class="flex justify-stretch ">
                        <span> <i class="fa-regular fa-clock pr-3 text-xs "></i></span>

                        <div class="my-auto text-left text-xs">
                            {{ \Carbon\Carbon::parse($publicacion->created_at)->diffForHumans() }}</div>

                    </div>
                    <div class="text-right ">
                        <span
                            class="rounded-xl text-center text-xs md:text-sm px-3 md:px-9 bg-yellow-500 text-white font-semibold">
                            {{ $publicacion->areas->area }} </span>
                    </div>
                </div>

            </div>

            <div class="my-3">
                <p class="break-words"> {{ $publicacion->texto }}</p>


                @if ($publicacion->imagen != null)
                    @if (substr($publicacion->imagen, -1) == '4')
                        <video controls src="{{ 'storage/app/public/posts/' . $publicacion->imagen }}"></video>
                    @else
                        <img src="{{ 'storage/app/public/posts/' . $publicacion->imagen }}" alt="imagen"
                            class="cover" class="rounded">
                    @endif
                @endif

            </div>

            <div class="flex my-2">
                <p class="  text-center text-gray-600">
                    {{ $publicacion->cantidad_likes }}
                </p>

            </div>
            <hr class="p-2">
            <div class="my-auto">

                <div class="grid grid-cols-3 justify-around text-md text-center text-gray-600 font-semibold">

                    {{-- <div class="text-center"><i class="fa-solid text-blue-800 fa-thumbs-up"></i></div> --}}

                    <!-- Interacciones -->

                    @include('livewire.publicaciones.interacciones.likes')

                    <div class=" w-full">

                        <i onclick="mostrarComentarios('{{ $publicacion->id }}')" id="comment_icon" title="Comentar"
                            class=" hover:text-cyan-800 fa-regular fa-message cursor-pointer ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
                        </i>
    
                    </div>
                    
                    @include('livewire.publicaciones.interacciones.compartir')

                </div>
                
                @include('livewire.publicaciones.interacciones.comentarios') 

            
            </div>

        
        </div>
    @endforeach
    {{ $publicaciones->links() }}

    <script>

        function mostrarComentarios(id) {
            let comentario = document.getElementById(id);

            if (comentario.style.display == 'none') {
                return comentario = comentario.style.display = 'block';
            }

            return comentario = comentario.style.display = 'none';
            
        }

        function ver_mas() {
            let comentarios = document.getElementById('comentarios');

            if (comentarios.style.display == 'none') {
                document.getElementById("vermas").innerHTML = "Ver Menos";

                return comentarios = comentarios.style.display = 'block';
            }
            document.getElementById("vermas").innerHTML = "Ver Mas";
            return comentarios = comentarios.style.display = 'none';
        }

    </script>
</div>
