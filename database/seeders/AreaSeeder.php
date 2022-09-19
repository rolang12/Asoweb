<?php

namespace Database\Seeders;

use App\Models\Areas;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    
    public function run()
    {
        $Areas = Areas::factory()->count(10)->create();
    }
}
