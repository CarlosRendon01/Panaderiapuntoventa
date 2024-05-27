<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePventaProdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pventa_prod', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_punventa');
            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_punventa')->references('id_punventa')->on('puntoventas')->onDelete('cascade');
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
        Schema::dropIfExists('pventa_prod');
    }
}