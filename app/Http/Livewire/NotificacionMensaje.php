<?php

namespace App\Http\Livewire;

use App\Models\Amigos;
use App\Models\ChMessage;
use Livewire\Component;

class NotificacionMensaje extends Component
{
    public $solicitudes;

    public function mount()
    {
        $this->solicitudes = Amigos::with('users','amigos')->where('to_id', Auth()->user()->id)
        ->where('status','Solicitud Enviada')
        ->orWhere('status','Amigos')->where('leido','No') ->get();

    }

    public function render()
    {
        
        return view('livewire.navbar.notificacion-mensaje',[

            'solicitudes' => $this->solicitudes

        ]);

    }

    
}
