<?php

namespace App\Services;

use App\Http\Livewire\HomeController;
use App\Models\Comentarios;
use App\Models\Publicaciones;
use Illuminate\Support\Facades\Auth;

class CompartirServices {
    
   public static function compartir(Publicaciones $publicaciones, $userid, $textoCompartir)
   {
        
    $publicacionCompartida = Publicaciones::create([
        'texto' => $publicaciones->texto,
        'cantidad_likes' => 0,
        'users_id' => $publicaciones->users_id,
        'imagen' => $publicaciones->imagen,
        'areas_id' => $publicaciones->areas_id,
        'comp_status' => 'si',
        'comp_publicacion_id' => $publicaciones->id,
        'comp_por_id' => $userid,
        'comp_texto' => $textoCompartir,
        'created_at' => $publicaciones->created_at
    ]);

    if (Auth::user()->id != $publicaciones->users_id) {
        $controler = new HomeController();
    
        return $controler->notificacion($publicaciones, $publicacionCompartida->comp_por_id, 'Ha compartido tu publicacion');
    }

    return $publicacionCompartida;

   }

}