<?php

namespace App\Http\Controllers;

use App\Models\Publicaciones;
use App\Models\User;

class PerfilController extends Controller
{
    public function init($userName)
    {

        // Puedo hacer aqui solo la consulta del usuario y despues añadir un componente para poner las publicaciones

        // Verificar que el usuario existe
        $userExists = User::
        where('name',$userName)->limit(1)->get(['name','created_at','profile_photo_path','status']);

        // Si no existe retorna al 404
        if ($userExists->isEmpty()) {
            return view('errors.404');
        }
        
        // Verificar que el usuario tenga publicaciones asociadas
        $userData = Publicaciones::with('users','comentarios')
        ->whereRelation('users','users.name', '=', $userName)->get();

        // Si no tiene publicaciones asociadas, retorna solo con la información del usuario
        if ($userData->isEmpty()){
            $userData = $userExists;
            return view('perfil.init', compact('userData'));
        }

        return view('perfil.init', compact('userData'));
    }
    
     public function perfiluser()
    {
       
        // $userData = Publicaciones::with('users','comentarios')
        // ->whereRelation('users','users.id', '=', Auth()->User()->id)->get();

        // if ($userData->isEmpty()) {
        //     return view('errors.404');
        // }


        $userData = Publicaciones::with('users','comentarios')
        ->whereRelation('users','users.id', '=', Auth()->user()->id)->get();

        // Si no tiene publicaciones asociadas, retorna solo con la información del usuario
        if ($userData->isEmpty()){
            return view('perfil.init', compact('userData'));
        }

        return view('perfil.init', compact('userData'));
    }
}
