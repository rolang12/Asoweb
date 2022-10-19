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
        $this->status = "Enviar Solicitud";
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
        $sonAmigos = Amigos::where('from_id',Auth::user()->id)->where('to_id', $iduser)->limit(1)->get();

        if ($sonAmigos->isEmpty()) {
            $sonAmigos = Amigos::create([
                'from_id' => Auth::user()->id,
                'to_id' => $this->iduser,
                'status' => 'Solicitud Enviada',
            ]);

            return $this->status = 'Solicitud Enviada';
        }

        if ($sonAmigos[0]->status == 'Solicitud Enviada') {
            $this->status = 'Enviar Solicitud';

            $sonAmigos[0]->update([
                'status' => 'Enviar Solicitud',
            ]);

            return $this->status = 'Enviar Solicitud';
        }

        // if ($sonAmigos[0]->status == 'Solicitud Cancelada') {
        
        //     $sonAmigos[0]->update([
        //         'status' => 'Enviar Solicitud',
        //     ]);

        //     return $this->status = 'Enviar Solicitud';
        // }


    }
}
