<?php

namespace App\Http\Livewire;

use App\Models\Publicaciones;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Buscador extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.navbar.buscador',  [
           
            // $post = DB::table('publicaciones')->select('texto','id')->where('texto','like',"%r%")->get(),
            
            // $users = DB::table('users')->select('name','id')->where('name','like',"%r%")->get(),

            // $publicaciones = $post->concat($users),

            /* De momento el buscador solo en usuario */
            'publicaciones' => User::where('name', 'like', "%{$this->search}%")->get(['name','id'])
        ]);


    }

}
