<?php

namespace App\Models;

use App\Models\Publicaciones;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorias extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria' 
    ];


    public function publicaciones()
    {
        return $this->belongsTo(Publicaciones::class);
    }

}
