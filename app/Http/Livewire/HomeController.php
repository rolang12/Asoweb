<?php

namespace App\Http\Livewire;

use App\Models\Categorias;
use App\Models\Publicaciones;
use App\Models\Publicaciones_has_like;
use App\Models\Usuarios_has_amigos;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class HomeController extends Component
{

    use WithFileUploads;

    public $publicacion, $text, $image = "", $categoria, $fecha;
    public $userid, $notificacion;

    public function mount()
    {
        $this->publicacion = '';
        $this->notificacion = '';
        $this->text = '';
        $this->image = '';
        $this->categoria = 5;
        $this->userid = Auth()->user()->id;
        $this->fecha = Carbon::now();
    }

    public function render()
    {
        return view('livewire.home-controller', [
            // 'likes' => Publicaciones_has_like::with('likes')->where()->get()
            'categorias' => Categorias::all(),

            'publicaciones' => Publicaciones_has_like::with('publicaciones','likes')
                ->latest()->get(),

            // 'publicaciones' => Publicaciones::with('users','publicaciones_has_likes')
            //     ->latest()->get(),

            'amigos' => Usuarios_has_amigos::with('user','amigos')
                    ->where('users_id', Auth()->user()->id)->get()
            
        ]);

        //convertimos la fecha 1 a objeto Carbon
        $carbon1 = new \Carbon\Carbon("2018-01-01 00:00:00");
        //convertimos la fecha 2 a objeto Carbon
        $carbon2 = new \Carbon\Carbon("2018-02-02 00:00:00");
        //de esta manera sacamos la diferencia en minutos
        $minutesDiff=$carbon1->diffInMinutes($carbon2);

    }

    protected $rules = [
        'text' => 'required',
        'categoria' => 'required|between:1,10',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function insertar_publicacion()
    {
        $publicacion = Publicaciones::create([
            'texto' => $this->text,
            'users_id' => $this->userid,
            'imagen' => $this->image,
            'categorias_id' => $this->categoria,
            'created_at' => $this->fecha,
        ]);

        // Resetea los inputs
        $this->resetUI();
        session()->flash('message', 'Publicado Exitosamente');

    }

    public function resetUI(){
        $this->text = '';
        $this->image = null;
        $this->categoria = 5;
    }

}
