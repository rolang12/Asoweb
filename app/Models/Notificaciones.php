<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_mensaje',
        'publicaciones_has_likes_id',
        'status'
    ];


    public function publicaciones_has_likes()
    {
        return $this->belongsTo(Publicaciones_has_like::class);
    }

}
