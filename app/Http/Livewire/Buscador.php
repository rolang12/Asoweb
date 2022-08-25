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
            'publicaciones' => Publicaciones::with('categorias')
            ->where('texto', 'Like', "%{$this->search}%")
            ->limit(5)
            ->get()]);
    }
}
