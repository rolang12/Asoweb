<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SeccionIzquierda extends Component
{
    public function render()
    {
        return view('livewire.seccion-izquierda',[
            'users' => User::with('areas')->whereRelation('areas','id',Auth::user()->areas_id)
                            ->where('id', '<>', Auth::user()->id)->get(['id','name','profile_photo_path'])
                            ->random(1)
        ]);
    }

}
