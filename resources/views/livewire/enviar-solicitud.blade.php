<div>
    <button wire:click="enviarSolicitud({{$iduser}})" class="bg-cyan-900 border-2 transition ease-in hover:-translate-y-1
     hover:skew-110 border-cyan-900 shadow-lg hover:shadow-cyan-500/50 translate-y-2 delay-100 duration-100
     {{$status == 'Solicitud Enviada' ? 'bg-gray-400 border-gray-300' : 'bg-cyan-900'}} rounded-2xl text-white p-3 hover:text-cyan-900 hover:bg-white">{{$status}}</button>
</div>
