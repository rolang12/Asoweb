<div class="md:flex grid grid-cols-1 mx-5 " id="top">

    <!-- Empieza la seccion de personas que podrías agregar -->
    <div class="md:w-2/6 md:mt-36 mt-0">
        <livewire:seccion-izquierda />
    </div>
    <!-- Termina seccion de personas que podrías agregar -->

    <!-- Empieza la seccion de publicaciones -->
    <div class=" md:w-3/6">

        <!-- Empieza la seccion de publicar -->
        @include('livewire.publicaciones.crearPubicacion')
        <!-- Termina la seccion de publicar -->

        <!-- Alertas -->
        @include('livewire.alertas.publicado')
        @include('livewire.alertas.actualizado')
        @include('livewire.alertas.eliminado')
        @include('livewire.alertas.comentarios.eliminado')
        @include('livewire.alertas.compartir.compartido')
        <!-- Fin Alertas -->

        <!-- Seccion de ver publicaciones -->
        @include('livewire.publicaciones.verPublicaciones')

        <!-- Modales -->
        @include('livewire.partials.publicaciones.modal')
        @include('livewire.partials.comentarios.modal')
        @include('livewire.partials.compartir.modal')

    </div>
    <!-- Termina la seccion de publicaciones -->

    <!-- Empieza la seccion de amigos -->
    <div class="md:w-1/6 invisible md:visible ml-10">
        <livewire:amigos-view />
    </div>
    <!-- Termina la seccion de amigos -->

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
            
            //Compartido
            window.livewire.on('show-modal-compartir', msg => {
                $('#theModalCompartir').modal('show')
            });

            window.livewire.on('hide-modal-compartir', msg => {
                $('#theModalCompartir').modal('hide')
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

</div>
