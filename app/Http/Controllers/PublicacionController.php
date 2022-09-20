<?php

namespace App\Http\Controllers;

use App\Models\Publicaciones;

class PublicacionController extends Controller
{
    
    public function buscar($id)
    {
        
        $publicaciones = Publicaciones::findOrFail($id);
        
        if ($publicaciones) {
            return view('publicaciones.publicacion', compact('publicaciones'));
        }

        return view('errors.404');
        
    }

}
