<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    use HasFactory;

    protected $fillable = [
       'texto',
       'publicaciones_id',
       'users_id' 
    ];

    public function publicaciones()
    {
        return $this->belongsTo(Publicaciones::class,'publicaciones_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    
}
