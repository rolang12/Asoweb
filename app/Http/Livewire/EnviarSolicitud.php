<?php

namespace App\Http\Livewire;

use App\Models\Amigos;
use App\Models\User;
use App\Models\Usuarios_has_amigos;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function PHPUnit\Framework\isEmpty;

class EnviarSolicitud extends Component
{
    public $iduser = '', $status, $amigos;

    public function mount()
    {
        $this->iduser = User::find($iduser);
        $this->sonAmigos = Amigos::where('from_id',Auth::user()->id)->where('to_id', $this->iduser)->get();

    }

    public function render()
    {
        
        if (isEmpty($this->sonAmigos)) {
            $this->status = 'Enviar Solicitud';
        } else {
            $this->status = $this->sonAmigos->status;
        }
            
        return view('livewire.enviar-solicitud',[
            'status' => $this->status
        ]);
    }


    public function enviarSolicitud($iduser)
    {
        if (isEmpty($this->sonAmigos)) {
            $this->sonAmigos = Amigos::create([
                'from_id' => Auth::user()->id,
                'to_id' => $this->iduser,
                'status' => 'Solicitud Enviada',
            ]);
        }

        if ($this->sonAmigos->status == 'Solicitud Enviada') {
        
            $this->sonAmigos = Amigos::update([
                'status' => 'Cancelar Solicitud'
            ]);
        }
    }

}
