<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $fillable = [
        'cantidad',
        'status',
        'users_id'
    ];

    public function publicaciones()
    {
        return $this->belongsTo(Publicaciones::class);
    }

    public function publicaciones_has_likes()
    {
        return $this->hasMany(Publicaciones_has_like::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
