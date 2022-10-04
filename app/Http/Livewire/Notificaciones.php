<?php

namespace App\Http\Livewire;

use App\Models\Notificaciones as ModelsNotificaciones;
use Livewire\Component;

class Notificaciones extends Component
{
    
    public function render()
    {
        return view('livewire.notificaciones', [

            'notificaciones' => ModelsNotificaciones::all()
           
            
        ]);
    }

    public function ver_notificacion(ModelsNotificaciones $notificaciones)
    {
         $notificaciones->update([
                'status' => 0
            ]);
    }

}
