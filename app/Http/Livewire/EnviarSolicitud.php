<?php

namespace App\Http\Livewire;

use App\Models\Amigos;
use App\Models\Usuarios_has_amigos;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EnviarSolicitud extends Component
{
    public $iduser = '', $status, $sonAmigos;

    public function mount()
    {
        $this->status = "Enviar Solicitud";
    }

    public function render()
    {
        //cambiar el nombre de las variables
        $sonAmigos = Amigos::where('from_id',Auth::user()->id)->where('to_id', $this->iduser)->get();

        //Verificar si tengo una solicitud recibida
        $sonAmigos2 = Amigos::where('from_id',$this->iduser)->where('to_id', Auth::user()->id )->get();

        if ($sonAmigos2->isEmpty()) {
            
            if ($sonAmigos->isEmpty()) {
                $this->status = 'Enviar Solicitud';

            } else {
                $this->status = $sonAmigos[0]->status;
                $sonAmigos[0]->status;
                
            }
                
            return view('livewire.enviar-solicitud',[
                'status' => $this->status
            ]);
           
        } else {
            return view('livewire.enviar-solicitud',[
                $this->status =  'Aceptar Solicitud'
            ]);
        }

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

       
        //Si los usuarios son Amigos, los elimino en ambas direcciones
        if ($sonAmigos[0]->status == 'Amigos') {
        
            $usuarioHasAmigo = Usuarios_has_amigos::where('users_id', Auth::user()->id)
                                ->where('friends_id', $iduser);
                                
            $amigoHasUsuario = Usuarios_has_amigos::where('users_id', $iduser )
                                ->where('friends_id', Auth::user()->id );

            $usuarioHasAmigo->delete();
            $amigoHasUsuario->delete();

            $sonAmigos[0]->update([
                'status' => 'Enviar Solicitud',
            ]);

            return $this->status = 'Enviar Solicitud';
        }

    }

    public function aceptarSolicitud()
    {
        $sonAmigos2 = Amigos::where('from_id',$this->iduser)->where('to_id', Auth::user()->id )->get();

        // $this->status = 'Solicitud Enviada';

        $sonAmigos2[0]->update([
            'status' => 'Amigos',
        ]);

        return $this->status = 'Amigos';


    }
}
