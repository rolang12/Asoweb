<div>
    @foreach ($publicaciones as $publicacion)
        <div class=" flex flex-col shadow rounded-md mt-8 p-5">
            <div class="my-auto  ">

                <div class="grid grid-cols-2 justify-around">

                    <div class="text-left" >
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
                            <ul class="bg-gray-50 text-center right-32 border absolute border-slate-200 rounded-md shadow-lg "
                                x-show="isOpen" x-transition  @click.away="isOpen = false">

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

                        <div class="my-auto text-left text-xs" >{{ \Carbon\Carbon::parse($publicacion->created_at)->diffForHumans() }}</div>

                    </div>
                    <div class="text-right ">
                        <span
                            class="rounded-xl text-center text-xs md:text-sm px-3 md:px-9 bg-yellow-500 text-white font-semibold">
                            {{ $publicacion->areas->area }} </span>
                    </div>
                </div>

            </div>

            <div class="my-3 break-words">
                <p class="text-left" > {{ $publicacion->texto }}</p>


                @if ($publicacion->imagen != null)
                    @if (substr($publicacion->imagen, -1) == '4')
                        <video controls src="{{ asset('storage/posts/' . $publicacion->imagen) }}"></video>
                    @else
                        <img src="{{ asset('storage/posts/' . $publicacion->imagen) }}" alt="imagen ejemplo"
                            class="cover" class="rounded">
                    @endif
                @endif

            </div>

            <div class="flex my-2">
                <p class="  text-center text-gray-600">
                    {{ $publicacion->cantidad_likes }}
                </p>

            </div>

            <div class="my-auto">

                <div class="flex justify-around text-md text-center text-gray-600 font-semibold">

                    <div class="text-center"><i class="fa-regular fa-thumbs-up"></i></div>

                    <!-- Interacciones -->

                    @include('livewire.publicaciones.interacciones.likes')
                    @include('livewire.publicaciones.interacciones.comentarios')
                    @include('livewire.publicaciones.interacciones.compartir')


                </div>

            </div>
        </div>
    @endforeach

    
</div>
<script>
        
    document.addEventListener('DOMContentLoaded', function() {
        //Publicaciones
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });

        window.livewire.on('category-updated', msg => {
            $('#theModal').modal('hide')
        });
        //Comentarios
        window.livewire.on('show-modal-comment', msg => {
            $('#theModalComment').modal('show')
        });

        
        window.livewire.on('comment-updated', msg => {
            $('#theModalComment').modal('hide')
        });

    });


    function Confirm(publicacion) {

        swal({
            title: 'Eliminar Publicación',
            text: '¿Segur@ que deseas eliminar la publicación?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#DC2626',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', publicacion)
                swal.close()
            }
        })
    }

    function confirmComment(comentario) {
        swal({
            title: 'Eliminar Comentario',
            text: '¿Segur@ que deseas eliminar el comentario?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#DC2626',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteComment', comentario)
                swal.close()
            }
        })
    }



</script>