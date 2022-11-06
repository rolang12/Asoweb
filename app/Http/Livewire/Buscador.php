<?php

namespace App\Http\Livewire;

use App\Models\Publicaciones;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Buscador extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.buscador',  [
           
            $posts = DB::table('publicaciones')->select('texto','id')->where('texto','Like',"%{$this->search}%"),

            'publicaciones' => DB::table('users')->select('name','id')->where('name','Like',"%{$this->search}%")
            ->union($posts)->get()
        ]);

    }

}
