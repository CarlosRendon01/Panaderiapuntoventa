<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si no sigue la convención de nombres de Laravel
    protected $table = 'productos';

    // Activa los timestamps si tu tabla tiene las columnas created_at y updated_at
    public $timestamps = true;

    // Especifica la clave primaria si no es 'id'
    protected $primaryKey = 'id_producto';

    // Especifica qué campos pueden ser asignados masivamente
    protected $fillable = [

        'nombre',
        'descripcion',
        'precio',
        'cantidad',
        'materia_prima',
    ];

    // Define la relación con el modelo Pedido
    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'ped_prod', 'id_producto', 'id_pedido');
    }

    // Define la relación con el modelo Materiaprima
    public function materiasPrimas()
    {
        return $this->belongsToMany(Materiaprima::class, 'pro_materia', 'id_producto', 'id_materiaprima')->withPivot('cantidad');
    }

    // Define la relación con el modelo Puntoventa
    public function puntoventas()
    {
        return $this->belongsToMany(Puntoventa::class, 'pventa_prod', 'id_producto', 'id_punventa');
    }

    // Aquí puedes definir relaciones, scopes, y otros comportamientos del modelo
}
