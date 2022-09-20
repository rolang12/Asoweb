<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Publicaciones;
use App\Models\Usuarios_has_amigos;

class UserServices extends Controller {

    public static function getFriends($id) {
      return $friendsCount = Usuarios_has_amigos::where('users_id',$id )->get('friends_id')->count();

    }
    public static function getPostCount($id) {
      return $postCount = Publicaciones::where('users_id',$id )->get('id')->count();
    }


}