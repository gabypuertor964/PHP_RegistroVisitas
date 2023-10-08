<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\areas;

class areasSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        areas::create([
            'nombre'=>"administracion",
            'descripcion'=>'descripcion Administracion'
        ]);      
    }
}
