<?php

namespace App\Services;

use App\Models\Publicaciones;
use App\Models\Usuarios_has_amigos;

trait UserServices {

  public static function getFriends($id) {
    return $friendsCount = Usuarios_has_amigos::where('users_id',$id )->get('friends_id')->count();

  }
  public static function getPostCount($id) {
    return $postCount = Publicaciones::where('users_id',$id )->get('id')->count();
  }

  public function deleteFriends($id, $auth) {

    $usuarioHasAmigo = Usuarios_has_amigos::where('users_id', $auth)
    ->where('friends_id', $id);

    return $usuarioHasAmigo->delete();

  }

  public static function addFriend($from_id, $to_id)
  {
    $friendAdded = Usuarios_has_amigos::create([
      'users_id' => $from_id,
      'friends_id' => $to_id
    ]);


  }


}