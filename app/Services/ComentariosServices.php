<?php

namespace App\Services;

use App\Http\Livewire\HomeController;
use App\Models\Comentarios;
use App\Models\Publicaciones;
use Illuminate\Support\Facades\Auth;

class ComentariosServices {

    
   public static function addComment(Publicaciones $publicaciones, $comentario)
   {
        
        Comentarios::create([
            'texto' => $comentario,
            'publicaciones_id' => $publicaciones->id,
            'users_id' => Auth::user()->id
        ]);

        if (Auth::user()->id != $publicaciones->users_id) {
            $controler = new HomeController();
        
            return $controler->notificacion($publicaciones, Auth::user()->id, 'Ha comentado tu publicación');
            
        }
        return;
   }

}