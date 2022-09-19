<?php

namespace App\Models;

use App\Models\Publicaciones;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Areas extends Model
{
    use HasFactory;

    protected $fillable = [
        'area' 
    ];


    public function publicaciones()
    {
        return $this->belongsTo(Publicaciones::class);
    }

}
