<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas'; // Asegura que el modelo use la tabla correcta

    protected $fillable = [
        'descripcion',  // Asegúrate de que estos campos sean asignables masivamente
        'total',
    ];

    protected $casts = [
        'total' => 'decimal:2',  // Opcional, para asegurar el formato decimal
    ];
}
