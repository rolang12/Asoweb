<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\CategoriasFactory;
use App\Models\Categorias;

class CategoriaSeeder extends Seeder
{
    
    public function run()
    {
        $Categorias = Categorias::factory()->count(10)->create();
    }
}
