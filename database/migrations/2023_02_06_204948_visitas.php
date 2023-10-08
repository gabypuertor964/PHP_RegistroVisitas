<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("id_visit");
            $table->datetime("fech_ingreso")->unique();
            $table->dateTime("fech_salida")->unique()->nullable();
            $table->unsignedBigInteger("id_trabajador");
            $table->unsignedBigInteger("id_equipo")->nullable();
            $table->text("motivo");
            $table->text("observaciones")->nullable()->default("Ninguna");
            $table->string("cod_gafete",4);

            $table->timestamps();

            $table->foreign("id_visit")->references("id")->on("visitantes");
            $table->foreign("id_trabajador")->references("id")->on("users");
            $table->foreign("id_equipo")->references("id")->on("equipos");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitas');
    }
};
