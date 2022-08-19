<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\CategoriaFactory;
use App\Models\Categorias;

class CategoriaSeeder extends Seeder
{
    
    public function run()
    {
        $user = Categorias::factory()->create();
    }
}
