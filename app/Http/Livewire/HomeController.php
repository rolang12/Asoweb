<?php

namespace App\Http\Livewire;

use App\Models\Categorias;
use App\Models\Comentarios;
use App\Models\Likes;
use App\Models\Notificaciones;
use App\Models\Publicaciones;
use App\Models\Publicaciones_has_like;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class HomeController extends Component
{

    use WithFileUploads;

    public $status, $publicacion, $comentario, $text, $image, $categoria, $fecha, $userid, $notificacion;

    public function mount()
    {
       
        $this->publicacion = '';
        $this->notificacion = '';
        $this->comentario = '';
        $this->text = '';
        $this->image = '';
        $this->categoria = 5;
        $this->userid = Auth()->user()->id;
        $this->fecha = Carbon::now();
    }
    
    public function render()
    {
        return view('livewire.home-controller', [

            'categorias' => Categorias::all(),

            'publicaciones' =>  Publicaciones::with('likes','users','comentarios')
                ->latest('created_at')->get()
        ]);



        // 'posts' => $this->readyToLoad ? Post::all() : []

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

    protected $messages = [
        'categoria.required' => 'Debes seleccionar una categoría.',
        'text.required' => 'La publicación no puede estar vacía.',
    ];
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function insertar_publicacion()
    {

        if ($this->validate()) {

            $publicacion = Publicaciones::create([
                'texto' => $this->text,
                'users_id' => $this->userid,
                'imagen' => $this->image,
                'cantidad_likes' => 0,
                'categorias_id' => $this->categoria,
                'created_at' => $this->fecha,
            ]);

            // Resetea los inputs
            $this->resetUI();
            session()->flash('message', 'Publicado Exitosamente');
        }

     

    }

    public function editar_post(Publicaciones $publicacion)
    {
        
    }

    public function eliminar_post(Publicaciones $publicacion)
    {
        
        $publicacion->delete();
        session()->flash('message', 'Borrado Exitosamente');

    }

    public function resetUI()
    {
        $this->text = '';
        $this->image = null;
        $this->categoria = 5;
        $this->comentario = "";
    }

    public function like(Publicaciones $publicacion)
    {

        // Primero tengo que verificar que $publicacion->likes venga con datos

        if ($publicacion->likes == null) {

            $likes = Likes::create([
                'status' => 1,
                'publicaciones_id' => $publicacion->id,
                'users_id' => Auth()->user()->id
            ]);
    
            $publicacion->update([
                'cantidad_likes' => $publicacion->cantidad_likes + 1
            ]);

            // Genero la notificación
            return $this->notificacion($likes, $publicacion);

        }

        // Intancio el modelo likes para verificar si la publicacion ya tiene un like asociado
        //con el usuario autenticado.

        $like = Likes::with('publicaciones')
                    ->whereRelation('publicaciones','publicaciones.id','=', $publicacion->id)
                    ->where('users_id', $this->userid)->limit(1)->get();

        
        
        // Si retorna la consulta vacia, creo el like

        if ($like->isEmpty()) {
        
            $likes = Likes::create([
                'status' => 1,
                'publicaciones_id' => $publicacion->id,
                'users_id' => Auth()->user()->id
            ]);
            
            $publicacion->update([
                'cantidad_likes' => $publicacion->cantidad_likes + 1
            ]);

            return $this->notificacion($likes, $publicacion);

        }


        // Obtengo el estatus del like de la primera instancia
        $this->status = $like[0]->status;

        // Si ya el like tiene el status 1 lo actualizo a 0
        if ($this->status == 1) {

            $like[0]->update([
                'status' => 0,
            ]);

            if ($publicacion->cantidad_likes == 0) {

                $publicacion->update([
                    'cantidad_likes' => 0
                ]);

                return;

            }

            $publicacion->update([
                    'cantidad_likes' => $publicacion->cantidad_likes-1
            ]);
                
            return;

        } else {

            $like[0]->update([
                'status' => 1,
            ]);

            $publicacion->update([
                'cantidad_likes' => $publicacion->cantidad_likes+1
            ]);

            return;
            // $this->notificacion($like, $publicacion);
        }

        

        

    }

    public function notificacion(Likes $likes, Publicaciones $publicaciones)
    {

        
        // $usuario = $Publicaciones_has_like->publicaciones->users->name;
        // $usuario2 = Auth()->user()->name;

        // if ($usuario != $usuario2) {
        //     $notificacion = Notificaciones::create([
        //     'tipo_mensaje' => "A $usuario2 le gustó tu publicación",
        //     'publicaciones_has_likes_id' => $Publicaciones_has_like->id,
        //     'status' => 1
        // ]);
        // }

    

    }

    public function comentar(Publicaciones $publicaciones)
    {
        $comentario = Comentarios::create([
            'texto' => $this->comentario,
            'publicaciones_id' => $publicaciones->id,
            'users_id' => $this->userid
        ]);

        
        // session()->flash('message', 'Publicado Exitosamente');
        $this->resetUI();
    }

}
