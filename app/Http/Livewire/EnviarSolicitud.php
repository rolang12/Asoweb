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

        //Si la solicitud no existe en la DB, se crea
        if ($sonAmigos->isEmpty()) {
            $sonAmigos = Amigos::create([
                'from_id' => Auth::user()->id,
                'to_id' => $this->iduser,
                'status' => 'Solicitud Enviada',
            ]);

            return $this->status = 'Solicitud Enviada';
        }

        //Si la solicitud no se ha enviado, se actualiza a enviada
        if ($sonAmigos[0]->status == 'Enviar Solicitud') {
            $this->status = 'Solicitud Enviada';

            $sonAmigos[0]->update([
                'status' => 'Solicitud Enviada',
            ]);

            return $this->status = 'Enviar Solicitud';
        }
        //Si la solicitud está enviada, se actualiza a el primer status que es enviar
        if ($sonAmigos[0]->status == 'Solicitud Enviada') {
        
            $sonAmigos[0]->update([
                'status' => 'Enviar Solicitud',
            ]);

            return $this->status = 'Enviar Solicitud';
        }


    }
}
