<?php

namespace App\Http\Livewire;

use App\Models\Amigos;
use App\Models\User;
use App\Models\Usuarios_has_amigos;
use Livewire\Component;

class AmigosView extends Component
{
    public function render()
    {
        return view('livewire.amigos-view',[

            // 'amigos' => Usuarios_has_amigos::select(['users.name'])
            // ->with('users')
            // ->get()

            $users = Usuarios_has_amigos::where('users_id', Auth()->user()->id)->get('friends_id'),

            'amigos' => User::with('session')->whereIn('id', $users)
            ->get()

        ]);
    }
}
