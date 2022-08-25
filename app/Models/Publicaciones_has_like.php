<?php

namespace App\Models;

use App\Models\Likes;
use App\Models\Publicaciones;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publicaciones_has_like extends Model
{
    use HasFactory;

    protected $fillable = [

        'publicaciones_id',
        'likes_id',
        'cantidad_likes'

    ];

    public function publicaciones()
    {
        return $this->belongsTo(Publicaciones::class);
    }

    public function likes()
    {
        return $this->belongsTo(Likes::class);
    }

}
