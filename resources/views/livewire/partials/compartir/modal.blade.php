<div wire:ignore.self class="modal fade shadow-md" id="theModalCompartir" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark ">
                <h5 class="modal-title  ">
                    <b>Compartir Publicacion</b>
                </h5>
                <h6 class="text-center text-warning" wire:loading>
                    Publicando...
                </h6>
            </div>
            <div class="modal-body">


                <div class="form-group">
                 
                    <div class="col-sm-12 col-md-12">
                        <input placeholder="Escribir..." wire:model.lazy="textoCompartir" type="text" class="form-control">
                        @error('textoCompartir')
                            <span class="text-danger er">{{ $message }}</span>
                        @enderror
                    </div>
                  
                    <div class="row">
                        <div class="col-sm-2 col-md-2">
                            <input class="border-0" disabled type="text" wire:model="username">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12" >
                            <input class="border-0" disabled type="text" wire:model="text">
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-12 col-md-12" >
                            <input class="border-0" disabled type="text" wire:model="fechaPost">
                        </div>
                    </div>
                  
                    
                
                </div>
            

            </div>
            <div class="modal-footer text-white ">
                <button type="button" wire:click.prevent="resetUI()" class="bg-red-600 hover:bg-red-600 p-2 close-btn rounded-lg" data-dismiss="modal" >Cerrar</button>
            

                <button type="button" wire:click.prevent="compartir()" class="bg-cyan-800 hover:bg-cyan-900 p-2 rounded-lg close-modal" data-dismiss="modal">Compartir</button>

                
            </div>
        </div>
    </div>
</div>