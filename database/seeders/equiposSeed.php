<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\equipos;

class equiposSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        equipos::create([
            'serial'=>'0000000000',
            'marca'=>'Lenovo',
            'tipo'=>'Portatil'
        ]);
    }
}
