<x-app-layout>
</x-app-layout>

{{dd($publicaciones)}}
<div class="mt-20">       
    @foreach ($publicaciones as $publicacion)
       <div>  {{$publicacion->texto}}</div>
    @endforeach
</div>