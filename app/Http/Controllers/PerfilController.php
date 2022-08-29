<?php

namespace App\Http\Controllers;

use App\Models\Publicaciones_has_like;
use App\Models\User;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    // public function init($id)
    // {
    //     $user = User::find($id);

    //     $user_has_publicaciones = Publicaciones_has_like::with('publicaciones','publicaciones.users','publicaciones.comentarios')
    //     ->whereRelation('publicaciones.users','users.id', '=', $user->id)->get();

    //     return view('perfil.init', [$user_has_publicaciones]);
    // }
    
    public function init($id)
    {
       
        return view('perfil.init');
    }
}
