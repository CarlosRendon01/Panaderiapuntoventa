<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaprimasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiaprimas', function (Blueprint $table) {
            $table->id('id_materiaprima'); // Define el campo id_materiaprima como la clave primaria
            $table->string('nombre');
            $table->text('descripcion')->nullable(); // Corrige el nombre de 'descripción' a 'descripcion'
            $table->string('nombreproveedor');
            $table->integer('cantidad');
            $table->decimal('precio', 10, 2);
            $table->timestamps(); // Define los campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materiaprimas');
    }
}