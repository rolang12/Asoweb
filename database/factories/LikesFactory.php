<?php

namespace Database\Factories;

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
            'cantidad' => $this->faker->numberBetween(1,10),
            'status' => $this->faker->randomElement(['0','1']),
            'users_id' => User::all(['id'])->random(),

        ];
    }
}