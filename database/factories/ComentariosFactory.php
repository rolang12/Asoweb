<?php

namespace Database\Factories;

use App\Models\Publicaciones;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComentariosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'texto' => $this->faker->realTextBetween(1,20),
            'publicaciones_id' => Publicaciones::all(['id'])->random(),
            'users_id' => User::all(['id'])->random(),

        ];
    }
}
