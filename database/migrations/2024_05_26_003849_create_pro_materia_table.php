<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProMateriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_materia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_materiaprima');
            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_materiaprima')->references('id_materiaprima')->on('materiaprimas')->onDelete('cascade');
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
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
        Schema::dropIfExists('pro_materia');
    }
}