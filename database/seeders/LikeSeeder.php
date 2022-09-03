<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria = \App\Models\Likes::factory()
        ->count(30)
        ->create();
    }
}
