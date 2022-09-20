<?php

namespace App\Http\Livewire;

use App\Models\Publicaciones;
use Livewire\Component;

class Buscador extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.buscador',  [
            'publicaciones' => Publicaciones::with('areas','users:id,name')
            ->where('texto', 'Like', "%{$this->search}%")
            ->orwhereRelation('users','name', 'Like', "%{$this->search}%")
            ->limit(1)
            ->get()
        ]);

    }

}
