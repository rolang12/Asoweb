<div class="mt-20  ">
    
    <div class="flex flex-col bg-gray-50 px-4 rounded-md ">
        <div class="grid grid-cols-2 mx-auto">
            <i
                class="fa-solid fa-user-group my-auto text-center bg-clip-text text-transparent bg-gradient-to-r from-orange-400 to-yellow-400"></i>

            <div class="text-center font-semibold py-3">Amigos</div>

        </div>
        <hr>
        @forelse ($amigos as $amigo)
            <div class="grid grid-cols-2 py-2 mt-1  text-sm hover:bg-gray-100 rounded-md p-2 text-right">
                <span class="text-left">
                    <div>{{ $amigo->name }}</div>
                </span>
                <span><i
                        class="fa-solid fa-circle text-xs {{ $amigo->active_status == 1 ? 'text-green-500' : 'text-red-500' }}"></i>
                </span>
            </div>
        @empty
            <div class="text-center">Aún no tienes amigos</div>
        @endforelse

    </div>
    
</div>
