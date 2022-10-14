<?php

namespace Database\Seeders;

use App\Models\Notificaciones;
use Illuminate\Database\Seeder;

class NotificacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notificaciones = Notificaciones::factory()->count(20)->create();

    }
}
