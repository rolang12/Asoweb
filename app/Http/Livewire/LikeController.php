<?php

namespace App\Http\Livewire;

use App\Models\Likes;
use App\Models\Publicaciones;
use Livewire\Component;

class LikeController extends Component
{
    public $status;

    public function mount()
    {
        $this->status = Likes::where('users_id', Auth()->user()->id)->get('status');
    }

    public function render()
    {
        return view('livewire.like-controller', [
            'likes' => Likes::where('users_id', Auth()->user()->id)->get('status')
        ]);
    }

    // public function like(Publicaciones, $publicacion)
    // {
        
    // }

}
