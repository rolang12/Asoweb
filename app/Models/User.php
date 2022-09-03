<?php

namespace App\Models;

use App\Models\Likes;
use App\Models\Publicaciones;
use App\Models\Notificaciones;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    public function publicaciones()
    {
        return $this->hasMany(Publicaciones::class);
    }
    public function likes()
    {
        return $this->hasMany(Likes::class);
    }

    public function notificaciones()
    {
        return $this->belongsTo(Notificaciones::class);
    }

    public function session()
    {
        return $this->hasOne(Sessions::class);
    }


}
