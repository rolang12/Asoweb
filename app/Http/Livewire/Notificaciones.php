<?php

namespace App\Http\Livewire;

use App\Models\Notificaciones as ModelsNotificaciones;
use Livewire\Component;

class Notificaciones extends Component
{
    
    public function render()
    {
        return view('livewire.notificaciones', [

            'notificaciones' => ModelsNotificaciones::with('publicaciones_has_likes','publicaciones_has_likes.likes','publicaciones_has_likes.publicaciones')->get()
            
        ]);
    }

    public function ver_notificacion(ModelsNotificaciones $notificaciones)
    {
         $notificaciones->update([
                'status' => 0
            ]);
    }

}
