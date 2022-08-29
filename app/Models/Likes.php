<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'users_id',
        'publicacion_id'
    ];

    public function publicaciones()
    {
        return $this->belongsTo(Publicaciones::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
