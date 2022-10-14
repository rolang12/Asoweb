<?php

namespace App\Http\Livewire;

use App\Models\Notificaciones as ModelsNotificaciones;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notificaciones extends Component
{
    
    public function render()
    {
        return view('livewire.notificaciones', [

            'notificaciones' => ModelsNotificaciones::with('publicaciones')->whereRelation('publicaciones','users_id',Auth::user()->id)
                            ->where('status','1')
                            ->get()
           
            
        ]);
    }

    public function ver_notificacion(ModelsNotificaciones $notificaciones)
    {
         $notificaciones->update([
                'status' => 0
            ]);
    }

}
