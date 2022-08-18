<div>
    <div class="">
        @foreach ($publicaciones as $publicacion)
            <div>
                {{ $publicacion->texto }}
            </div>
        @endforeach

    </div>


    <div class="bg-gray-200 mx-auto">

        <label for="text">Texto</label>
        <input wire:model='text' type="text">
        <label for="image">imagen</label>
        <input wire:model='image' type="text">
        <label for="categoria">Categoria</label>
        <input wire:model='categoria' type="text">

        <button type="button" wire:click="insertar_publicacion()" class="btn btn-dark close-btn text-info"
            data-dismiss="modal">Close</button>

    </div>
</div>
<script>
    function noty(msg, option = 1) {
        Snackbar.show({
            text: msg.toUpperCase(),
            actionText: 'CERRAR',
            actionTextColor: '#fff',
            backgroundColor: option == 1 ? '#3b3f5c' : '#e7515a',
            pos: 'top-right'
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('publicacion-creada', Msg => {
            noty(Msg)
        })
    });
</script>
