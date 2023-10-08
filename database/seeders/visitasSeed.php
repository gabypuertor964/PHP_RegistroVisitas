<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\visitas;

class visitasSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        visitas::create([
            'id_visit'=>1,
            'fech_ingreso'=>date("Y-m-d H:i:s"),
            'id_trabajador'=>1,
            'id_equipo'=>1,
            'motivo'=>'Visita Amistad',
            'cod_gafete'=>3,
        ]);
    }
}
