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
        Schema::create('visitantes', function (Blueprint $table) {
            $table->id();

            $table->string("nombres",30);
            $table->string("apellidos",30);
            $table->string("tip_doc",30);
            $table->string("num_doc",20)->unique();
            $table->string("sexo",9);
            $table->string("num_tel",10)->unique();
            $table->string("correo",50)->nullable();
            $table->text("url")->unique()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitantes');
    }
};
