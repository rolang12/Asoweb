<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class PerfilController extends Component
{
    public function render(User $user)
    {
        return view('livewire.perfil-controller', [

            'usuario' => $user::with('publicaciones')->get()
            
        ]);
    }

}
