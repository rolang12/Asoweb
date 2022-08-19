<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PublicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria = \App\Models\Publicaciones::factory()
        ->count(20)
        ->create();
    }
}
