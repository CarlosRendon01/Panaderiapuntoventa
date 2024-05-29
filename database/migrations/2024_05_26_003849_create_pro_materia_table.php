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
            $table->id(); // Define una clave primaria automática
            $table->foreignId('id_producto')->constrained('productos','id_producto')->onDelete('cascade'); // Clave foránea para producto
            $table->foreignId('id_materiaprima')->constrained('materiaprimas', 'id_materiaprima')->onDelete('cascade'); // Clave foránea para materia prima
            $table->integer('cantidad');
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
        Schema::dropIfExists('pro_materia');
    }
}