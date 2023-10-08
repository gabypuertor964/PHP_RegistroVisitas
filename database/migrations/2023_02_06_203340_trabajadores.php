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
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->id();

            $table->string("tip_doc",30);
            $table->string("num_doc",20)->unique();
            $table->unsignedBigInteger("id_usuario")->nullable();
            $table->string("num_tel",10)->unique();
            $table->string("sexo",9);
            $table->date("fech_nac");
            $table->text("url")->unique()->nullable();

            $table->timestamps();

            $table->foreign("id_usuario")->references('id')->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trabajadores');
    }
};
