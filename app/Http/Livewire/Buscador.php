<?php

namespace App\Http\Livewire;

use App\Models\Publicaciones;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class Buscador extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.navbar.buscador',  [
           
           'publicaciones' => Search::add(User::class, 'name')
            ->add(Publicaciones::class, 'texto')
            ->beginWithWildcard()
            ->search($this->search)
        ]);


    }

}
