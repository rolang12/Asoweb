<?php

namespace App\Http\Livewire;

use App\Models\Amigos;
use App\Services\UserServices;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EnviarSolicitud extends Component
{
    use UserServices;

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

        // Si no tengo una solicitud de el usuario, genero la plantilla para enviar una solicitud
        if ($sonAmigos2->isEmpty()) {
            
            // Si aun no tengo solicitudes hacia ese usuario, la inicializo
            if ($sonAmigos->isEmpty()) {
                $this->status = 'Enviar Solicitud';

            } else {
                // Si he enviado una solicitud hacia ese usuario, obtengo el status
                $this->status = $sonAmigos[0]->status;
                $sonAmigos[0]->status;
                
            }
            
            // Retorno la vista con el status actual
            return view('livewire.enviar-solicitud',[
                'status' => $this->status
            ]);
           
        } else {
            //Si tengo una solicitud de el usuario, verifico si ya son amigos o no
            if ($sonAmigos2[0]->status == 'Solicitud Enviada') {
                $this->status =  'Aceptar Solicitud';

            } elseif ($sonAmigos2[0]->status == 'Amigos') {
                $this->status =  'Amigos';

            }

            return view('livewire.enviar-solicitud',[
                'status' => $this->status
            ]);
        }

    }

    public function enviarSolicitud($iduser)
    {
        $sonAmigos = Amigos::where('from_id', Auth::user()->id)->where('to_id', $iduser)
                             ->orwhere('from_id', $iduser)->where('to_id',Auth::user()->id)->get();
        $controlador = new HomeController();

        //Si la solicitud no existe en la DB, se crea
        if ($sonAmigos->isEmpty()) {
            $sonAmigos = Amigos::create([
                'from_id' => Auth::user()->id,
                'to_id' => $this->iduser,
                'status' => 'Solicitud Enviada',
            ]);
            
            $controlador->notificacion(null, $this->iduser, 'Te ha enviado una solicitud de amistad');

            return $this->status = 'Solicitud Enviada';
        }

        //Si la solicitud no se ha enviado, se actualiza a enviada
        if ($sonAmigos[0]->status == 'Enviar Solicitud') {
            $this->status = 'Solicitud Enviada';

            $sonAmigos[0]->update([
                'status' => 'Solicitud Enviada',
            ]);

            
            $controlador->notificacion(null,$this->iduser,'Te ha enviado una solicitud de amistad');

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

            // Llamo al trait para eliminar usuarios amigos
            UserServices::deleteFriends($iduser, Auth::user()->id);
            UserServices::deleteFriends(Auth::user()->id, $iduser);

            $sonAmigos[0]->update([
                'status' => 'Enviar Solicitud',
            ]);

            return $this->status = 'Enviar Solicitud';
        }

    }

    public function aceptarSolicitud()
    {
        
        $controlador = new HomeController();

        $sonAmigos2 = Amigos::where('from_id', $this->iduser)
        ->where('to_id', Auth::user()->id )->where('status', 'Solicitud Enviada')->get();

        
        $sonAmigos2[0]->update([
            'status' => 'Amigos',
            'leido' => 'Si'
        ]);

        UserServices::addFriend($this->iduser, Auth::user()->id);
        UserServices::addFriend(Auth::user()->id, $this->iduser);

        $controlador->notificacion(null,$this->iduser,' Ha aceptado tu solicitud de Amistad');

        return $this->status = 'Amigos';

    }

    public function eliminarAmigo($iduser)
    {
    
        $sonAmigos = Amigos::where('from_id', $iduser)
        ->where('to_id', Auth::user()->id )
        ->orwhere('to_id', $iduser)->where('from_id', Auth::user()->id)->get();

        
        // Llamo al trait para eliminar usuarios amigos
        UserServices::deleteFriends($sonAmigos[0]->from_id, $iduser);
        UserServices::deleteFriends($sonAmigos[0]->to_id, Auth::user()->id);

        $sonAmigos[0]->delete();

        return $this->status = 'Enviar Solicitud';
        
    }
}
