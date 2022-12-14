<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_mensaje',
        'status',
        'publicaciones_id',
        'users_id'
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
