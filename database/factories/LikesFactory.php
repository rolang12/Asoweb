<?php

namespace Database\Factories;

use App\Models\Publicaciones;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->randomElement(['0','1']),
            'users_id' => User::all(['id'])->random(),
            'publicaciones_id' => Publicaciones::all(['id'])->random(),


        ];
    }
}
