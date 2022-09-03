<?php

namespace App\Models;

use App\Models\User;
use App\Models\Categorias;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publicaciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'texto',
        'imagen',
        'users_id',
        'categorias_id',
        'cantidad_likes'
    ];

    public function categorias()
    {
        return $this->belongsTo(Categorias::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasOne(Likes::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentarios::class);
    }
    
}
