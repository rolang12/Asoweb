<?php

namespace Database\Factories;

use App\Models\Categorias;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicacionesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'texto'=>$this->faker->realTextBetween(50, 100),
            'users_id' => User::all(['id'])->random(),
            'cantidad_likes' => $this->faker->numberBetween(1,30),
            'categorias_id' => Categorias::all(['id'])->random(),
            'imagen' => $this->faker->imageUrl(300,300)
        ];
    }
}
