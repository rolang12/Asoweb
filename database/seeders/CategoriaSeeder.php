<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\CategoriasFactory;
use App\Models\Categorias;

class CategoriaSeeder extends Seeder
{
    
    public function run()
    {
        $users = Categorias::factory()->count(3)->create();
    }
}
