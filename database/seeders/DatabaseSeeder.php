<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Notifications\NotificationSender;

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
            AreaSeeder::class,
            UserSeeder::class,
            PublicacionSeeder::class,
            LikeSeeder::class,
            ComentariosSeeder::class,
            NotificacionesSeeder::class,
        ]);

    }
}
