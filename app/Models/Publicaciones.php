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
        'categorias_id'
    ];

    public function categorias()
    {
        return $this->hasOne(Categorias::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }




}
