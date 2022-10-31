<?php

namespace App\Http\Livewire;

use App\Models\Notificaciones as ModelsNotificaciones;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notificaciones extends Component
{
    
    public function render()
    {
        return view('livewire.navbar.notificaciones', [

            'notificaciones' => ModelsNotificaciones::with('publicaciones','users')
                            ->whereRelation('publicaciones','users_id',Auth::user()->id)
                            ->where('status','1')->orderby('created_at','desc')
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
