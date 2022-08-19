<?php

namespace App\Http\Livewire;

use App\Models\Publicaciones;
use Livewire\Component;

class HomeController extends Component
{
    public $publicacion, $text, $image = "", $categoria = 1; 
    public $userid; 

    public function mount()
    {
        $this->publicacion = '';
        $this->text = '';
        $this->image = '';
        $this->userid = Auth()->user()->id;
        $this->categoria; 
    }

    public function render()
    {
        return view('livewire.home-controller', [

            'publicaciones' => Publicaciones::with('users')->latest()->get()
        
        ]);
    }

    public function insertar_publicacion()
    {
        $category = Publicaciones::create([
            'texto' => $this->text,
            'users_id' => $this->userid,
            'imagen' => $this->image,
            'categorias_id' => $this->categoria,
        ]);

        $this->emit('publicacion-creada', 'publicacion creada');
    }

}
