<?php

namespace App\Http\Livewire;

use App\Models\Categorias;
use App\Models\Publicaciones;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class HomeController extends Component
{

    use WithFileUploads;

    public $publicacion, $text, $image = "", $categoria, $fecha;
    public $userid; 

    public function mount()
    {
        $this->publicacion = '';
        $this->text = '';
        $this->image = '';
        $this->userid = Auth()->user()->id;
        $this->categoria = 5;
        $this->fecha = Carbon::now();
    }

    public function render()
    {
        return view('livewire.home-controller', [
            'categorias' => Categorias::all(),
            'publicaciones' => Publicaciones::with('users')->latest()->get()
        
        ]);


        //convertimos la fecha 1 a objeto Carbon
        $carbon1 = new \Carbon\Carbon("2018-01-01 00:00:00");
        //convertimos la fecha 2 a objeto Carbon
        $carbon2 = new \Carbon\Carbon("2018-02-02 00:00:00");
        //de esta manera sacamos la diferencia en minutos
        $minutesDiff=$carbon1->diffInMinutes($carbon2);

    }

    public function insertar_publicacion()
    {
        $category = Publicaciones::create([
            'texto' => $this->text,
            'users_id' => $this->userid,
            'imagen' => $this->image,
            'categorias_id' => $this->categoria,
            'created_at' => $this->fecha,
        ]);

        $this->emit('publicacion-creada', 'publicacion creada');
    }

}
