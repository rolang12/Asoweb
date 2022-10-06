{{-- {{dd($notificaciones)}} --}}
<div class="items-center inline-flex" >
    <div x-data="{ open: false }">
        <a href="/chatify">
            <i  x-on:click="open=!open" class="fa-solid fa-message  text-white hover:text-gray-200 text-lg px-4 "></i>
        </a>
    </div>

</div>