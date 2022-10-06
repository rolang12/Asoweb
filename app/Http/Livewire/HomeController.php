<?php

namespace App\Http\Livewire;

use App\Events\ExampleEvent;
use App\Events\StatusLiked;
use App\Models\Areas;
use App\Models\Comentarios;
use App\Models\Likes;
use App\Models\Notificaciones;
use App\Models\Publicaciones;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class HomeController extends Component
{

    use WithFileUploads;

    public $status, $publicacion,$newtext, $newarea, $comentario, $text,
           $image, $area, $fecha, $notificacion, $idSeleccionado;

    
    public function mount()
    {
       
        $this->publicacion = '';
        $this->notificacion = '';
        $this->comentario = '';
        $this->text = '';
        $this->idSeleccionado = '';
        $this->newtext = '';
        $this->newarea = '';
        $this->image = '';
        $this->area = 5;
        $this->userid = Auth()->user()->id;
        $this->fechaActual = Carbon::now();

    }
    
    public function render()
    {
        return view('livewire.home-controller', [

            'areas' => Areas::all(),

            'publicaciones' =>  Publicaciones::with('likes','users','comentarios','areas')->latest('created_at')->get(),

            'fechaActual' => $this->fechaActual
        ]);
 
    }

    public function resetUI()
    {
        $this->text = '';
        $this->image = '';
        $this->area = 1;
        $this->comentario = "";
    }

    protected $rules = [
        'text' => 'required',
        'area' => 'required|between:1,10',
        'image'=> 'file:video/avi,video/webm,video/mp4,jpg,jpeg,png',
    ];

    protected $messages = [
        'area.required' => 'Debes seleccionar una categoría.',
        'text.required' => 'La publicación no puede estar vacía.',
        'image.file' => 'Archivo no soportado, los formatos admitidos son png, jpeg, jpg, mp4, webm, avi'
        
    ];
    
    public function insertar_publicacion()
    {

        if ($this->validate()) {

            $publicacion = Publicaciones::create([
                'texto' => $this->text,
                'users_id' => $this->userid,
                'cantidad_likes' => 0,
                'areas_id' => $this->area,
                'created_at' => $this->fecha,
            ]);

            
            $customFileName; 
            if ($this->image)
            {
                $customFileName = uniqid() .'_.' . $this->image->extension();
                $this->image->storeAs('public/posts', $customFileName);
                $imageTemp = $publicacion->imagen; //imagen temporal porque necesitamos borrarla del disco
                $publicacion->imagen = $customFileName;
                $publicacion->save();

                if($imageTemp != null){
                    if(file_exists('storage/posts/'. $imageTemp)){
                        unlink('storage/posts/'. $imageTemp);
                    }
                }

            }
            // Resetea los inputs
            $this->resetUI();


            $this->dispatchBrowserEvent('notification', [
                'body' => 'Tu publicación se ha realizado',
                'timeout' => 5000
            ]);

           
        }

    }

    public function editar_post(Publicaciones $publicaciones)
    {
        $this->newtext = $publicaciones->texto;
        $this->newarea = $publicaciones->area;
        $this->idSeleccionado = $publicaciones->id;
        $this->emit('show-modal');
    }
    

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        
    }

    public function actualizar_post()
    {
        $rules = ['newtext' => "required"];
        $messages = [
            'newtext.required' => 'La publicación no puede estar vacía'
        ];

        //valido la información
        $this->validate($rules, $messages);

        //encuentro el id que le envié por el wire:model y actualizo el nombre
        $publicacion = Publicaciones::find($this->idSeleccionado);
        
        $publicacion->update([
            'texto' => $this->newtext,
            'updated_at' => $this->fechaActual
        ]);

        //Reseteo los inputs
        $this->resetUI();
        $this->dispatchBrowserEvent('actualizado', [
            'body' => 'Tu publicación se ha actualizado',
            'timeout' => 5000
        ]);

        $this->emit('category-updated', 'category updated');

    }

    protected $listeners = ['deleteRow' => 'eliminar_post'];

    public function eliminar_post(Publicaciones $publicacion)
    {
        if($publicacion->imagen != null){
                if(file_exists('storage/posts/'. $publicacion->imagen )){
                    unlink('storage/posts/'. $publicacion->imagen );
                }
            }
        $publicacion->delete();

        $this->dispatchBrowserEvent('eliminacion', [
            'body' => 'Tu publicación se ha eliminado',
            'timeout' => 5000
        ]);


    }

   

    public function like(Publicaciones $publicacion)
    {
       
        event(new StatusLiked('mensaje'));
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
            return $this->notificacion($publicacion);

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

            return $this->notificacion($publicacion);

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

            return $this->notificacion($publicacion);
        }

    }

    public function notificacion(Publicaciones $publicaciones)
    {

        
        // $usuario = $publicaciones->users->name;
        $usuario2 = Auth()->user()->name;

        // if ($usuario != $usuario2) {
            $notificacion = Notificaciones::create([
            'tipo_mensaje' => "A $usuario2 le gustó tu publicación",
            // 'publicaciones_has_likes_id' => $usuario->id,
            'status' => 1
        ]);

            // StatusLiked::dispatch($username, $message);
        // }
        // event(new App\Events\StatusLiked('Someone'));
        

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
