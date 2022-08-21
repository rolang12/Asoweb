<?php

namespace Database\Factories;

use App\Models\Likes;
use App\Models\Publicaciones;
use Illuminate\Database\Eloquent\Factories\Factory;

class Publicaciones_has_likeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'likes_id' => Likes::all(['id'])->random(),
            'publicaciones_id' => Publicaciones::all(['id'])->random(),
        ];
    }
}
