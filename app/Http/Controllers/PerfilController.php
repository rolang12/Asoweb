<?php

namespace App\Http\Controllers;

use App\Models\Publicaciones;
use App\Models\Publicaciones_has_like;
use App\Models\User;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function init($id)
    {
        // $user = User::find($id);

        $userData = Publicaciones::with('users','comentarios')
        ->whereRelation('users','users.name', '=', $id)->get();

        if ($userData->isEmpty()) {
            return view('errors.404');
        }

        return view('perfil.init', compact('userData'));
    }

    public function perfiluser()
    {
        // $user = User::find($id);

        $userData = Publicaciones::with('users','comentarios')
        ->whereRelation('users','users.id', '=', Auth()->User()->id)->get();

        if ($userData->isEmpty()) {
            return view('errors.404');
        }

        return view('perfil.init', compact('userData'));
    }
    
    // public function init($id)
    // {
       
    //     return view('perfil.init');
    // }
}
