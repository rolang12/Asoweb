<?php

namespace App\Http\Livewire;

use App\Models\Amigos;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function PHPUnit\Framework\isEmpty;

class EnviarSolicitud extends Component
{
    public $iduser = '', $status, $sonAmigos;

    public function mount()
    {
        // dd($this->sonAmigos->status);
    }

    public function render()
    {
        $sonAmigos = Amigos::where('from_id',Auth::user()->id)->where('to_id', $this->iduser)->get();

        if ($sonAmigos->isEmpty()) {
             $this->status = 'Enviar Solicitud';
        } else {
            $this->status = $sonAmigos[0]->status;
            $sonAmigos[0]->status;
            
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

            return $this->status = 'Solicitud Enviada';
        }

        if ($this->sonAmigos->status == 'Solicitud Enviada') {
        
            $this->sonAmigos = Amigos::update([
                'status' => 'Cancelar Solicitud';
            ]);

            return $this->status = 'Cancelar Enviada';

        }
    }
}
