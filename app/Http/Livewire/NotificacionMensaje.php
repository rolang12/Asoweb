<?php

namespace App\Http\Livewire;

use App\Models\Amigos;
use Livewire\Component;

class NotificacionMensaje extends Component
{
    public $solicitudes, $count;

    public function mount()
    {
        $this->solicitudes = Amigos::with('users','amigos')->where('to_id', Auth()->user()->id)
        ->where('status','Solicitud Enviada')
        ->orWhere('status','Amigos')->where('leido','No')->orderby('created_at','desc')->get();

        $this->count = Amigos::with('users','amigos')->where('to_id', Auth()->user()->id)
        ->where('status','Solicitud Enviada')
        ->orWhere('status','Amigos')->where('leido','No')->get('id')->count();



    }

    public function render()
    {
        
        return view('livewire.navbar.notificacion-mensaje',[

            'solicitudes' => $this->solicitudes,
            'count' => $this->count
        ]);

    }

    public function soli_vista(Amigos $amigos)
    {
         $amigos->update([
                'leido' => 'si'
            ]);

        return;
    }
    
}
