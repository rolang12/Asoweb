<div wire:ignore.self class="modal fade shadow-md" id="theModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark ">
                <h5 class="modal-title  ">
                    <b>Editar publicacion</b>
                </h5>
                <h6 class="text-center text-warning" wire:loading>
                    Please Wait
                </h6>
            </div>
            <div class="modal-body">

                {{--empieza body  --}}
               <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>Name</label>
                        <input wire:model.lazy="name" type="text" class="form-control">
                        @error('name')
                            <span class="text-danger er">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            
            </div>
            <div class="modal-footer text-white ">
                <button type="button" wire:click.prevent="resetUI()" class="bg-red-600 hover:bg-red-600 p-2 close-btn rounded-lg" data-dismiss="modal" >Close</button>
            

                <button type="button" wire:click.prevent="actualizar_post()" class="bg-cyan-800 hover:bg-cyan-900 p-2 rounded-lg close-modal">Update</button>

                
            </div>
        </div>
    </div>
</div>