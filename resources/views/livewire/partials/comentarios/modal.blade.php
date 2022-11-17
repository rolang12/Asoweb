<div class="z-50" wire:ignore.self class="modal fade shadow-md" id="theModalComment" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark ">
                <h5 class="modal-title  ">
                    <b>Editar comentario</b>
                </h5>
                <h6 class="text-center text-warning" wire:loading>
                    Actualizando...
                </h6>
            </div>
            <div class="modal-body">

                {{--empieza body  --}}
               <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                        
                        <input placeholder="Edita aquí tu comentario..." wire:model.lazy="newComment" type="text" class="form-control">
                        @error('newComment')
                            <span class="text-danger er">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            
            </div>
            <div class="modal-footer text-white ">
                <button type="button" wire:click.prevent="resetUI()" class="bg-red-600 hover:bg-red-600 p-2 close-btn rounded-lg" data-dismiss="modal" >Cerrar</button>
            

                <button type="button" wire:click.prevent="actualizar_comentario()" class="bg-cyan-800 hover:bg-cyan-900 p-2 rounded-lg close-modal">Actualizar</button>

                
            </div>
        </div>
    </div>
</div>