<?php

namespace App\Models;

use App\Models\User;
use App\Models\Areas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publicaciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'texto',
        'imagen',
        'users_id',
        'areas_id',
        'cantidad_likes'
    ];

    public function areas()
    {
        return $this->belongsTo(Areas::class)->withDefault();
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

    public function notificaciones()
    {
        return $this->hasMany(Notificaciones::class);
    }

    // public function getImagenAttribute()
    // {
        
    //     if(file_exists('storage/posts/'. $this->image)){
    //         return $this->image;
    //     }

    // }

}
