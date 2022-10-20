
<div class="md:flex grid grid-cols-1 mx-5 ">
  
    <!-- Empieza la seccion de noticias -->
        <div class="md:w-2/6 mt-36 " >
            <livewire:seccion-izquierda/>
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

            <!-- Empieza la seccion de ver publicaciones -->
                @yield('ver')
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
