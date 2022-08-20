<?php

namespace Database\Seeders;

use Database\Seeders\CategoriaSeeder;
use Database\Seeders\PublicacionSeeder;
use Database\Seeders\LikeSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategoriaSeeder::class,
            UserSeeder::class,
            PublicacionSeeder::class,
            LikeSeeder::class,
        ]);

    }
}
