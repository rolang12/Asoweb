<?php

namespace Database\Seeders;

use App\Models\Comentarios;
use Illuminate\Database\Seeder;

class ComentariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comentarios = Comentarios::factory()->count(50)->create();

    }
}
