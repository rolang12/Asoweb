<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Usuarios_has_amigos;
use Livewire\Component;

class AmigosView extends Component
{
    public function render()
    {
        return view('livewire.amigos-view',[


            $users = Usuarios_has_amigos::where('users_id', Auth()->user()->id)->get('friends_id'),

            'amigos' => User::with('session')->whereIn('id', $users)->get()

        ]);
    }
}
