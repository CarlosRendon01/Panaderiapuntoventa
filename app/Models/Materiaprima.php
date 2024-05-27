<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiaprima extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si no sigue la convención de nombres de Laravel
    protected $table = 'materiaprimas';

    // Desactiva los timestamps si tu tabla no tiene las columnas created_at y updated_at
    public $timestamps = true;

    // Especifica la clave primaria si no es 'id'
    protected $primaryKey = 'id_materiaprima';

    // Especifica qué campos pueden ser asignados masivamente
    protected $fillable = [
        'id_materiaprima',
        'nombre',
        'descripcion',
        'nombreproveedor',
        'cantidad',
        'precio'
        // Añadir este campo
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'pro_materia', 'id_materiaprima', 'id_producto');
    }
}
