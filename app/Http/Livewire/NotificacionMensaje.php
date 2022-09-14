<?php

namespace App\Http\Livewire;

use App\Models\ChMessage;
use Livewire\Component;

class NotificacionMensaje extends Component
{
    public function render()
    {
        return view('livewire.notificacion-mensaje',[

            'notificaciones' => ChMessage::where('to_id', Auth()->user()->id)->where('seen','0')->get('type')

        ]);
    }
}
