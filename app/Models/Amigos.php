<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Amigos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_amigos',
        'status',
        'from_id',
        'to_id',
        'leido'
    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function amigos()
    {
        return $this->belongsTo(User::class,'to_id');

    }

}
