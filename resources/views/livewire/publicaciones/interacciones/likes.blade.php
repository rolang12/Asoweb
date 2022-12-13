
<div class="inline-block" >
    @if ($publicacion->likes == "")
        {{-- <button wire:offline.attr="disabled"
            class="text-sm md:text-base col-span-1 text-gray-500 ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 hover:text-blue-800 hover:font-extrabold"
            wire:click="like({{ $publicacion->id }})">Me
            gusta
        </button> --}}
        <i title="Like" wire:click="like({{ $publicacion->id }})" class="cursor-pointer fa-solid text-gray-400 fa-thumbs-up "></i>

    @else
    <i title="Like" wire:click="like({{ $publicacion->id }})" class="cursor-pointer fa-solid text-blue-600 fa-thumbs-up {{ $publicacion->likes->users_id == Auth()->user()->id && $publicacion->likes->status == 1 ? 'text-blue-600 font-bold' : 'text-gray-500 ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 hover:text-blue-800 hover:font-extrabold' }} "></i>

        {{-- <button wire:offline.attr="disabled"
            class="text-sm  md:text-base col-span-1 {{ $publicacion->likes->users_id == Auth()->user()->id && $publicacion->likes->status == 1 ? 'text-blue-600 font-bold' : 'text-gray-500 ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 hover:text-blue-800 hover:font-extrabold' }} "
            wire:click="like({{ $publicacion->id }})">Me gusta
        </button> --}}
    @endif
</div>
            