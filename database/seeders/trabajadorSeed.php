<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\trabajadores;
use App\Models\User;

class trabajadorSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        trabajadores::create([
            "tip_doc"=>'Tarjeta de Identidad',
            "num_doc"=>'0000000000',
            'id_usuario'=>1,
            'num_tel'=>'3007410404',
            'sexo'=>"femenino",
            'fech_nac'=>'2006-02-03'
        ]);
    }
}
