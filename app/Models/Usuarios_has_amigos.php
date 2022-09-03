<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios_has_amigos extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'friends_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function amigos()
    {
        return $this->belongsTo(User::class);

    }

   

}
