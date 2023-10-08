<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\role_has_areas;

class roleHasAreaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        role_has_areas::create([
            'id_rol'=>2,
            'id_area'=>1,
        ]);
    }
}
