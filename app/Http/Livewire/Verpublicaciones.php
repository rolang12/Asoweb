<?php

namespace App\Http\Livewire;

use App\Models\Areas;
use App\Models\Likes;
use App\Models\Publicaciones;
use App\Services\ComentariosServices;
use App\Services\NotificacionServices;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Verpublicaciones extends Component
{
    public $fechaActual, $iduser = "", $comentario;

    public function mount()
    {
        $this->fechaActual = Carbon::now();
        $this->userid = Auth::user()->id;
    }

    public function render()
    {  
        return view('livewire.verpublicaciones',[
            'areas' => Areas::all(),
            'publicaciones' =>  Publicaciones::with('likes','users','comentarios','comentarios.users','areas')->whereRelation('users','name',$this->iduser)
            ->latest('created_at')->get(),
            'fechaActual' => $this->fechaActual
        ]);
    }

    public function comentar(Publicaciones $publicaciones)
    {
        $rules = ['comentario' => "required"];
        $messages = [
            'comentario.required' => 'Comentario vacío'
        ];
        
        $this->validate($rules, $messages);

        return ComentariosServices::addComment($publicaciones, $this->comentario);
        
    }
    
    public function like(Publicaciones $publicacion)
    {
       
        // Verificar que $publicacion->likes la publicación tenga likes asociados
        if ($publicacion->likes == null) {

            $likes = Likes::create([
                'status' => 1,
                'publicaciones_id' => $publicacion->id,
                'users_id' => Auth()->user()->id
            ]);
               
            $publicacion->update([
                'cantidad_likes' => $publicacion->cantidad_likes + 1
            ]);

            // Genero la notificación
            // return event(new StatusLiked($publicacion->id));
            return $this->notificacion($publicacion, $this->userid, 'le ha gustado tu publicación');

        }

        // Intancio el modelo likes para verificar si la publicacion ya tiene un like asociado
        //con el usuario autenticado.
        $like = Likes::with('publicaciones')
                    ->whereRelation('publicaciones','publicaciones.id','=', $publicacion->id)
                    ->where('users_id', $this->userid)->limit(1)->get();
        
        // Si retorna la consulta vacia, creo el like
        if ($like->isEmpty()) {
        
            $likes = Likes::create([
                'status' => 1,
                'publicaciones_id' => $publicacion->id,
                'users_id' => Auth()->user()->id
            ]);
            
            $publicacion->update([
                'cantidad_likes' => $publicacion->cantidad_likes + 1
            ]);
            
            return $this->notificacion($publicacion, $this->userid, 'le ha gustado tu publicación');

            // return event(new StatusLiked($publicacion->id));
        }


        // Obtengo el estatus del like de la primera instancia
        $this->status = $like[0]->status;

        // Si ya el like tiene el status 1 lo actualizo a 0
        if ($this->status == 1) {

            $like[0]->update([
                'status' => 0,
            ]);

            // En caso que la publicación no tenga likes, reinicio la cantidad de likes a 0
            // Para no tener valores negativos
            if ($publicacion->cantidad_likes == 0) {
                $publicacion->update([
                    'cantidad_likes' => 0
                ]);
                return;
            }
            // Actualizo la cantidad de likes
            $publicacion->update([
                'cantidad_likes' => $publicacion->cantidad_likes-1
            ]);
                
            return;

        } else {

            $like[0]->update([
                'status' => 1,
            ]);

            $publicacion->update([
                'cantidad_likes' => $publicacion->cantidad_likes+1
            ]);

            // return event(new StatusLiked($publicacion->id));
            return $this->notificacion($publicacion,$this->userid, "le ha dado like a tu post");

        }

    }

    public function notificacion(?Publicaciones $publicaciones, $user, $tipo)
    {

        return NotificacionServices::addNotification($publicaciones, $user, $tipo);

    }

    public function compartir($publicacion, $user)
    {
        $post = Publicaciones::find($publicacion);



    }

}
