<?php

namespace App\Http\Livewire;

use App\Models\ChMessage;
use Livewire\Component;

class NotificacionMensaje extends Component
{
    public $notificaciones;

    public function mount()
    {
        $this->notificaciones = ChMessage::with('user')->where('to_id', Auth()->user()->id)->where('seen','0')->get();

    }

    public function render()
    {
        
        return view('livewire.notificacion-mensaje',[

            'notificaciones' => $this->notificaciones

            , $this->dispatchBrowserEvent('notification', [
                'body' => count($this->notificaciones),
                'timeout' => 4000
            ])
        ]);

    }
}
