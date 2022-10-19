<?php

namespace App\Http\Livewire;

use App\Models\Areas;
use App\Models\Comentarios;
use App\Models\Publicaciones;
use App\Models\User;
use App\Services\UserServices;
use Carbon\Carbon;
use Livewire\Component;

class PerfilController extends Component
{
    public $user, $fechaActual;
 
    public function mount($id)
    {
        
        $this->user = User::find($id);

    }
    
    public function render($userName)
    {
     
        // Verificar que el usuario existe
        $userExists = User::with('areas')->where('name',$userName)->get(['id','name','status','areas_id','profile_photo_path']);
        
        // Si no existe retorna al 404
        if ($userExists->isEmpty()) {
            return view('errors.404');
        }
        
        // Verificar que el usuario tenga publicaciones asociadas
        $basicData = Publicaciones::with('users','comentarios','areas')
                    ->whereRelation('users','users.name', '=', $userName)->get();

        // Obtener los recuentos de amigos, publicaciones y comentarios
        $friendsCount = UserServices::getFriends($userExists[0]->id);
        $postCount = UserServices::getPostCount($userExists[0]->id);
        $commentsCount = Comentarios::where('users_id', $userExists[0]->id)->get('id')->count();

        //Paso las publicaciones a una nueva variable porque será reemplazada
        $publicaciones = $basicData;

        // Si no tiene publicaciones asociadas, retorna solo con la información del usuario
        if ($basicData->isEmpty()){

            $basicData = $userExists;
            
        }

        return view('livewire.perfil-controller', [
            // 'areas' => Areas::all(),
            'userExists' => $userExists,
            'basicData' => $basicData,
            'friendsCount' => $friendsCount,
            'commentsCount' => $commentsCount,
            'postCount' => $postCount,
            'publicaciones' => $publicaciones,
            'fechaActual' => Carbon::now(),
        ]);
    }

    public function ejemplo()
    {
        dd("hola");
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


    public function notificacion(Publicaciones $publicaciones, $user, $tipo)
    {

        // $usuario = $publicaciones->users->name;
        $nombreUsuarioActual = Auth()->user()->name;

        // Verifica si el usuario que emite el like sea diferente al que le llega la notificación
        if ($publicaciones->users_id != $this->userid) {
            $notificacion = Notificaciones::create([
            'tipo_mensaje' => "$nombreUsuarioActual". " $tipo",
            'users_id' => $user,
            'status' => 1,
            'publicaciones_id' => $publicaciones->id
        ]);
        }
    }

}
