<?php

namespace App\Models;

use App\Models\Likes;
use App\Models\Areas;
use App\Models\ChMessage;
use App\Models\Publicaciones;
use App\Models\Notificaciones;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function areas()
    {
        return $this->belongsTo(Areas::class);
    }

    public function publicaciones()
    {
        return $this->hasMany(Publicaciones::class);
    }
    
    public function publicaciones_comp()
    {
        return $this->hasMany(Publicaciones::class);
    }
    
    public function likes()
    {
        return $this->hasMany(Likes::class);
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificaciones::class);
    }

    public function session()
    {
        return $this->hasOne(Sessions::class);
    }

    public function usuarios_has_amigos()
    {
        return $this->hasMany(Usuarios_has_amigos::class);
    }

    public function amigos()
    {
        return $this->hasMany(Amigos::class);
    }

    public function mensaje()
    {
        return $this->hasMany(ChMessage::class);
    }


}
