<?php

namespace App\Http\Livewire;

use App\Models\Amigos;
use Livewire\Component;

class EnviarSolicitud extends Component
{
    public $iduser = '';

    public function render()
    {
        return view('livewire.enviar-solicitud');
    }

    public function enviarSolicitud($iduser)
    {

        
        dd($this->ids);
    }

}
