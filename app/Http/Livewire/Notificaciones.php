<?php

namespace App\Http\Livewire;

use App\Models\Notificaciones as ModelsNotificaciones;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notificaciones extends Component
{
    
    public $notificaciones, $cantidad;

    public function mount()
    {
        $this->notificaciones = ModelsNotificaciones::with('publicaciones','users')
        ->whereRelation('publicaciones','users_id',Auth::user()->id)
        ->orderby('created_at','desc')
        ->get();

        $this->cantidad = ModelsNotificaciones::with('publicaciones','users')
        ->whereRelation('publicaciones','users_id',Auth::user()->id)
        ->where('status','1')
        ->get('id')->count();
    }

    public function render()
    {
        return view('livewire.navbar.notificaciones', [

            'notificaciones' => $this->notificaciones,
            'count' => $this->cantidad
        ]);
    }

    public function ver_notificacion(ModelsNotificaciones $notificaciones)
    {
         $notificaciones->update([
                'status' => 2
            ]);

        return;
    }

}
