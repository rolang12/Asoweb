<?php

namespace App\Http\Livewire;

use App\Models\Sessions;
use App\Models\Usuarios_has_amigos;
use Livewire\Component;

class AmigosView extends Component
{
    public function render()
    {
        return view('livewire.amigos-view',[
             'amigos' => Usuarios_has_amigos::with('user','amigos')
                    ->where('users_id', Auth()->user()->id)->get()
        ]);
    }
}
