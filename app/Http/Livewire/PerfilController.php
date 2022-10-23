<?php

namespace App\Http\Livewire;

use App\Models\Comentarios;
use App\Models\Publicaciones;
use App\Models\User;
use App\Services\UserServices;
use Carbon\Carbon;
use Livewire\Component;

class PerfilController extends Component
{
    use UserServices;
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
        $basicData = Publicaciones::with('users','comentarios','comentarios.users','areas')
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

        return view('livewire.perfil.perfil-controller', [
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

   

}
