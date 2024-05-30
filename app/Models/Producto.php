<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si no sigue la convención de nombres de Laravel
    protected $table = 'productos';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';

    // Especifica qué campos pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'cantidad',
    ];

    // Define la relación con el modelo Pedido
    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'ped_prod', 'id_producto', 'id_pedido');
    }

    // Define la relación con el modelo Materiaprima
    public function materias()
    {
        return $this->belongsToMany(Materia::class, 'pro_materia', 'id_producto', 'id_materiaprima')->withPivot('cantidad');
    }

    // Define la relación con el modelo Puntoventa
    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'pventa_prod', 'id_producto', 'id_venta');
    }

    // Aquí puedes definir relaciones, scopes, y otros comportamientos del modelo
}
