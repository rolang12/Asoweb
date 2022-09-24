
<div class="md:flex grid grid-cols-1 mx-5 ">
    <style>
        .spinner{
            border: 4px solid rgba(0, 0,0,.1);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border-left-color: rgb(21, 75, 111);

            animation: spin 2s ease infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <!-- Empieza la seccion de noticias -->
        <div class="md:w-2/6  " >
            <div class="">AAAA</div>
        </div>
    <!-- Termina seccion noticias -->

    <!-- Empieza la seccion de publicaciones -->
        <div class=" md:w-3/6">

            <!-- Empieza la seccion de publicar -->
                @include('livewire.publicaciones.crearPubicacion')
            <!-- Termina la seccion de publicar -->


            <!-- Alertas -->
                @include('livewire.alertas.publicado')
                @include('livewire.alertas.actualizado')
                @include('livewire.alertas.eliminado')
            <!-- Fin Alertas -->


            <!-- Empieza la seccion de publicaciones -->
           
                @include('livewire.publicaciones.verPublicaciones')
            
            <!-- Termina la seccion de publicaciones -->
            @include('livewire.modal')

        </div>
    <!-- Termina la seccion de publicaciones -->

    <!-- Empieza la seccion de amigos -->
        <div class="md:w-1/6 invisible md:visible ml-10" > 
            <livewire:amigos-view />
        </div>
    <!-- Termina la seccion de amigos -->

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('show-modal', msg => {
                $('#theModal').modal('show')
            });
    
        
            window.livewire.on('category-updated', msg => {
                $('#theModal').modal('hide')
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
    </script>

</div>
