<div class="grid mt-20">
 
    <div class=" ">

        <div class="mx-auto bg-red-200 text-white rounded-md" wire:offline>Estás Offline</div>

        <form wire:submit.prevent="insertar_publicacion()">

            <div class="md:flex md:flex-row grid justify-around md:justify-between items-center">

                <div class="col-span-1">
                    <input wire:model="image" accept="video/webm, video/mp4, video/avi, image/jpeg, image/jpg, image/png"
                        wire:offline.attr="disabled"
                        class="file:mr-4 text-sm file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold
                                file:bg-yellow-50 file:text-yellow-400 hover:file:bg-yellow-100"
                         type="file">
                            
                </div>

                <div class=" text-center md:mx-0 mx-10 text-sm text-white px-4 bg-yellow-400 rounded-xl p-1 ">Area:</div>

                <div class=" justify-self-center my-auto">
                    
                    <select class="border-none " wire:model='area'>
                        
                        <option selected value="1"></option>
                        
                        @foreach ($areas as $area)
                            <option class="p-2 py-4" value="{{ $area->id }}">
                                {{ $area->area }}</option>
                        @endforeach


                    </select>
                </div>

            </div>


            <div>
                <input wire:model='text' class="w-full ring-cyan-800 my-3 rounded-lg border-gray-100"
                    placeholder="Escribe tu publicación aquí..." type="text">
                @error('text')
                    <span class="text-center py-3 font-bold text-red-700 error">{{ $message }}</span>
                @enderror
                <br>
                @error('image')
                    <span class="text-center py-3 text-red-700 font-bold error">{{ $message }}</span>
                @enderror
                @error('area')
                    <span class="text-center py-3 text-red-700 font-bold error">{{ $message }}</span>
                @enderror

            </div>

            <div>
                <button wire:offline.attr="disabled" wire:target="insertar_publicacion"
                    wire:loading.class="from-gray-300 to-gray-200" type="submit" wire:loading.attr="disabled"
                    class="hover:bg-gradient-to-l bg-gradient-to-r from-cyan-900 to-cyan-700 w-full p-3 rounded-md font-bold text-white transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">Publicar</button>

            </div>

            <span wire:loading wire:target="insertar_publicacion">
                
                <div class=" mt-2 flex flex-row  items-center justify-center">
                    <div class="spinner"></div>    
                    
                </div>

            </span>

        </form>
    </div>

    <script>'use strict';

        ;( function ( document, window, index )
        {
            var inputs = document.querySelectorAll( '.inputfile' );
            Array.prototype.forEach.call( inputs, function( input )
            {
                var label	 = input.nextElementSibling,
                    labelVal = label.innerHTML;
        
                input.addEventListener( 'change', function( e )
                {
                    var fileName = '';
                    if( this.files && this.files.length > 1 )
                        fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                    else
                        fileName = e.target.value.split( '\\' ).pop();
        
                    if( fileName )
                        label.querySelector( 'span' ).innerHTML = fileName;
                    else
                        label.innerHTML = labelVal;
                });
            });
        }( document, window, 0 ));</script>

</div>