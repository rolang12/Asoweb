<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use App\Models\Publicaciones;
use App\Models\User;
use App\Services\UserServices as UserServices;

class PerfilController extends Controller
{

  

    public function init($userName)
    {

        // Puedo hacer aqui solo la consulta del usuario y despues añadir un componente para poner las publicaciones

        // Verificar que el usuario existe
        $userExists = User::firstWhere('name',$userName)->get('name');
        
        // Si no existe retorna al 404
        if ($userExists->isEmpty()) {
            return view('errors.404');
        }
        
        // Verificar que el usuario tenga publicaciones asociadas
        $basicData = Publicaciones::with('users','comentarios')
                    ->whereRelation('users','users.name', '=', $userName)->get();

        $friendsCount = UserServices::getFriends(Auth()->user()->id);
        $postCount = UserServices::getPostCount(Auth()->user()->id);

        $commentsCount = Comentarios::where('users_id', Auth()->user()->id)->get('id')->count();


        // Si no tiene publicaciones asociadas, retorna solo con la información del usuario
        if ($basicData->isEmpty()){
            $basicData = $userExists;
            return view('perfil.init', compact('basicData','friendsCount','commentsCount', 'postCount'));
        }

        return view('perfil.init', compact('basicData','friendsCount','commentsCount', 'postCount'));
    }
    
    public function perfiluser()
    {

        $basicData = Publicaciones::with('users','comentarios','areas','users.areas')
                    ->whereRelation('users','users.id', '=', Auth()->user()->id)->get();
        
        // Contar cuantos amigos tiene
        $friendsCount = UserServices::getFriends(Auth()->user()->id);

        $postCount = UserServices::getPostCount(Auth()->user()->id);

        $commentsCount = Comentarios::where('users_id', Auth()->user()->id)->get('id')->count();

        
        // Si no tiene publicaciones asociadas, retorna solo con la información del usuario
        if ($basicData->isEmpty()){
            return view('perfil.init', compact('basicData','friendsCount','commentsCount', 'postCount'));
        }

        return view('perfil.init', compact('basicData','friendsCount','commentsCount', 'postCount'));
    }
}
