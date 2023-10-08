<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\visitantes;
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
            areasSeed::class,
            equiposSeed::class,
            rolesPermisos::class,
            roleHasAreaSeed::class,
            userSeed::class,
            trabajadorSeed::class,
            //visitantesSeed::class,
            //visitasSeed::class,
        ]);
    }
}
