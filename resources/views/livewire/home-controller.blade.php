
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
            <div class="grid grid-rows-2">

                <div></div>

                <div class=" ">

                    <div class="mx-auto bg-red-200 text-white rounded-md" wire:offline>Estás Offline</div>

                    <form wire:submit.prevent="insertar_publicacion()">

                        <div class="md:flex md:flex-row grid justify-between items-center">

                            <div class="col-span-1">
                                <input accept="video/webm, video/mp4, video/avi, image/jpeg, image/jpg, image/png"
                                    wire:offline.attr="disabled"
                                    class="file:mr-4 text-sm file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold
                                            file:bg-yellow-50 file:text-yellow-400 hover:file:bg-yellow-200"
                                    wire:model='image' type="file">

                            </div>

                            <div class=" text-center md:mx-0 mx-10 text-sm text-white px-4 bg-yellow-400 rounded-xl p-1 "> Area:</div>

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

                        <span wire:loading wire:target="insertar_publicacion"  >
                            
                            <div class=" mt-2 flex flex-col items-center justify-center">
                                <div class="spinner">

                                </div>    
                            </div>
    
                        </span>

                    </form>
                </div>

            </div>
            <!-- Termina la seccion de publicar -->

            <div
                x-data="{body: ''}"
                x-show="body.length"
                x-cloak
                x-on:notification.window="body = $event.detail.body; setTimeout(() => body = '', $event.detail.timeout || 2000)"
                class="fixed bottom-2 right-2 flex px-4 py-6 items-start pointer-events-none">
                <div class="w-full flex flex-col items-center space-y-4">
                    <div class="max-w-sm w-full bg-yellow-500 rounded-lg pointer-events-auto">
                        <div class="p-4 flex items-center">
                            <div class="ml-2 w flex-1 text-white">
                                <span x-text="body"></span>
                            </div>
                            <button class="inline-flex text-gray-400" x-on:click="body = ''">
                                <span class="sr-only">Close</span>
                                <span class="text-2xl">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div
                x-data="{body: ''}"
                x-show="body.length"
                x-cloak
                x-on:eliminacion.window="body = $event.detail.body; setTimeout(() => body = '', $event.detail.timeout || 2000)"
                class="fixed bottom-2 right-2 flex px-4 py-6 items-start pointer-events-none">
                <div class="w-full flex flex-col items-center space-y-4">
                    <div class="max-w-sm w-full bg-red-700 rounded-lg pointer-events-auto">
                        <div class="p-4 flex items-center">
                            <div class="ml-2 w flex-1 text-white">
                                <span x-text="body"></span>
                            </div>
                            <button class="inline-flex text-gray-400" x-on:click="body = ''">
                                <span class="sr-only">Close</span>
                                <span class="text-2xl">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Empieza la seccion de publicaciones -->
            @foreach ($publicaciones as $publicacion)

                <div class=" flex flex-col shadow rounded-md mt-8 p-5">
                    <div class="my-auto  ">

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
                                    <ul class="bg-gray-50 text-center right-96 border absolute border-slate-200 rounded-md shadow-lg "
                                        x-show="isOpen" @click.away="isOpen = false">
                                        <a href="#" wire:click="editar_post({{ $publicacion->id }})">
                                            <li class="p-1 w-32 text-gray-600 hover:bg-cyan-900 hover:text-white">
                                                <div  class="py-2">Editar
                                                </div>

                                            </li>
                                        </a>
                                        <a href="#" onclick="Confirm('{{ $publicacion->id }}')">
                                            <li  class="p-1 w-32 text-gray-600 hover:bg-cyan-900 hover:text-white">
                                                <div 
                                                    class="py-2 ">Eliminar
                                                </div>
                                            </li>
                                        </a>
                                    </ul>

                                  
                                        {{-- wire:click="eliminar_post({{ $publicacion->id }})" --}}
                                    

                                </div>
                            @endif

                            

                        </div>

                        <div class="grid grid-cols-2">

                        <div class="flex  justify-stretch ">
                            <span> <i class="fa-regular fa-clock pr-3 text-xs "></i></span>

                            <div class="hidden" >{{$minutesDiff=$fechaActual->diffInMinutes($publicacion->created_at)}}</div>

                            @switch($minutesDiff)
                                @case($minutesDiff>1 && $minutesDiff<2 )
                                    <div class="my-auto text-left text-xs">Hace un momento </div>
                                    @break
                                @case($minutesDiff>3 && $minutesDiff<60)
                                    <div class="my-auto text-left text-xs">Hace {{ $minutesDiff=$fechaActual->diffInMinutes($publicacion->created_at)  }} minuto(s) </div>
                                    @break
                                @case($minutesDiff>60 && $minutesDiff<1440 )
                                    <div class="my-auto text-left text-xs">Hace {{ $hoursDiff=$fechaActual->diffInHours($publicacion->created_at)  }} Hora(s) </div>
                                    @break
                                @case($minutesDiff>1440)
                                    <div class="my-auto text-left text-xs">Hace {{ $hoursDiff=$fechaActual->diffInDays($publicacion->created_at)  }} Día(s) </div>
                                    @break
                                @default
                                    <!--<div class="my-auto text-left text-xs">Hace {{ $minutesDiff=$fechaActual->diffInMinutes($publicacion->created_at)  }} minuto(s) </div>-->

                            @endswitch

                        </div>
                        <div class="text-right " >
                           <span class="rounded-xl text-center text-xs md:text-sm px-3 md:px-9 bg-yellow-500 text-white font-semibold" > {{ $publicacion->areas->area }} </span>
                        </div>
                    </div>

                    </div>

                    <div class="my-3">
                        <div>  {{ $publicacion->texto }}</div>
                        

                        @if ($publicacion->imagen != null)
                            @if (substr($publicacion->imagen, -1) == '4')
                                <video controls src="{{ asset('storage/posts/' . $publicacion->imagen) }}"></video>
                            @else
                                <img src="{{ asset('storage/posts/' . $publicacion->imagen) }}" alt="imagen ejemplo"
                                    class="cover" class="rounded">
                            @endif
                        @endif

                    </div>

                    <div class="grid grid-cols-4 w-full my-2">
                        <div class="  text-center text-gray-600">
                            {{ $publicacion->cantidad_likes }}
                        </div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>

                    <div class="my-auto">

                        <div class="flex justify-around text-md text-center text-gray-600 font-semibold">

                            <div class="text-center"><i class="fa-regular fa-thumbs-up"></i></div>

                            <div>
                                @if ($publicacion->likes == null)
                                    <button wire:offline.attr="disabled"
                                        class="text-sm md:text-base col-span-1 text-gray-500 ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 hover:text-blue-800 hover:font-extrabold"
                                        wire:click="like({{ $publicacion->id }})">Me
                                        gusta
                                    </button>
                                @else
                                    <button wire:offline.attr="disabled"
                                        class="text-sm  md:text-base col-span-1 {{ $publicacion->likes->users_id == Auth()->user()->id && $publicacion->likes->status == 1 ? 'text-blue-600 font-bold' : 'text-gray-500 ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 hover:text-blue-800 hover:font-extrabold' }} "
                                        wire:click="like({{ $publicacion->id }})">Me gusta
                                    </button>
                                @endif
                            </div>
                            {{-- x-bind:class="! open ? '' : 'col-span-5'" QUITA O AGREGA UNA CLASE DEPENDE DEL ESTADO OPEN O FALSE --}}
                            <div x-data="{ open: false }">
                                <button class="text-sm md:text-base " x-on:click="open=!open">Comentar</button>

                                <div x-show="open" x-on:click.away="open = false" class="bg-gray-50 my-3 ">

                                    <div class="">

                                        @forelse ($publicacion->comentarios as $detalle)
                                           <div class="flex flex-col" >
                                                    <div class="text-left">{{ $detalle->texto }}</div>

                                                    <a href="{{ route('perfil', ['id' => $detalle->users->name]) }}"
                                                        class="text-right text-sm text-blue-800">{{ $detalle->users->name }}</a>
                                            </div>
                                               

                                        @empty
                                            <p class="text-sm mb-3 text-gray-500">No hay comentarios aún</p>
                                        @endforelse

                                        <div class="p-3 ">

                                            <input placeholder="Deja tu comentario aquí..."
                                                class=" rounded-md border-gray-400 mb-3" wire:model="comentario"
                                                type="text">


                                            <button wire:click="comentar({{ $publicacion->id }})"
                                                class="text-sm md:text-base rounded-lg font-semibold bg-cyan-900 text-white p-2 "
                                                id="submit" type="submit">Comentar
                                            </button>


                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="text-sm md:text-base">Compartir</div>

                        </div>

                    </div>
                </div>
            @endforeach
            @include('livewire.modal')
            <!-- Termina la seccion de publicaciones -->

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
