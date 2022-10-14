<?php

namespace Database\Factories;

use App\Models\Publicaciones;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificacionesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tipo_mensaje' => 'A x persona le ha gustado tu post',
            'status' => $this->faker->random_int(1,3),
            'publicaciones_id' => Publicaciones::all(['id'])->random(),
        ];
    }
}
