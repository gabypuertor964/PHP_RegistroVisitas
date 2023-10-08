<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\visitantes;

class visitantesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        visitantes::create([
            'nombres'=>'Pepito Alejandro',
            'apellidos'=>'Perez Valencia',
            'tip_doc'=>'Tarjeta de Identidad',
            'num_doc'=>'1111111111',
            'sexo'=>'Masculino',
            'num_tel'=>'0000000000',
        ]);
    }
}
