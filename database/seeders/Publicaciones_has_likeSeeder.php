<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Publicaciones_has_likeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria = \App\Models\Publicaciones_has_like::factory()
        ->count(30)
        ->create();
    }
}
