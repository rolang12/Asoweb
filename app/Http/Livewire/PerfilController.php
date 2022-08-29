<?php

namespace App\Http\Livewire;

use App\Models\Publicaciones_has_like;
use App\Models\User;
use Livewire\Component;

class PerfilController extends Component
{
    public $user;
 
    // public function mount($id)
    // {
    //     $this->user = User::find($id);
    // }
    
    // public function render()
    // {
        
    //     return view('livewire.perfil-controller', [
    //         'user_has_publicaciones' => Publicaciones_has_like::with('publicaciones','publicaciones.users','publicaciones.comentarios')
    //         ->whereRelation('publicaciones.users','users.id', '=', $this->user->id)->get()
    //     ]);
    // }

}
