<div class="mt-20 mr-5">
    <div class="grid grid-cols-2">
        <div></div>

        <div class="flex flex-col ">
            <div class="grid grid-cols-2 mx-auto">
                <i class="fa-solid fa-user-group my-auto text-center text-cyan-900 "></i>

                <div class="text-center font-semibold py-3">Amigos</div>

            </div>

            @forelse ($amigos as $amigo)
                <div class="grid grid-cols-2 py-2 text-sm text-right">
                    <span class="text-left">
                        <div>{{ $amigo->user->name }}</div>
                    </span>
                    <span><i
                            class="fa-solid fa-circle {{ $amigo->user->session->user_id == $amigo->friends_id ? 'text-red-500' : 'text-green-500' }}"></i>
                    </span>
                </div>
            @empty
                <div class="text-center">Aún no tienes amigos</div>
            @endforelse

        </div>
    </div>
</div>
