<?php

namespace App\Services;

use App\Models\Notificaciones;
use App\Models\Publicaciones;
use Illuminate\Support\Facades\Auth;

class NotificacionServices {

    
   public static function addNotification(?Publicaciones $publicaciones, $user, $tipo)
   {
        
        $nombreUsuarioActual = Auth()->user()->name;

        if ($tipo == 'Ha comentado tu publicación' || $tipo == 'le ha gustado tu publicación') {
            // Verifica si el usuario que emite el like sea diferente al que le llega la notificación
            if ($publicaciones->users_id != Auth::user()->id) {
                $notificacion = Notificaciones::create([
                'tipo_mensaje' => "$nombreUsuarioActual". " $tipo",
                'users_id' => $user,
                'status' => 1,
                'publicaciones_id' => $publicaciones->id
                ]);
            }

            return;
        }

        $notificacion = Notificaciones::create([
        'tipo_mensaje' => "$nombreUsuarioActual". " $tipo",
        'users_id' => $user,
        'status' => 1,
        'publicaciones_id' => null
        ]);

        return;
   }

}