<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si no sigue la convención de nombres de Laravel
    protected $table = 'productos';

    // Desactiva los timestamps si tu tabla no tiene las columnas created_at y updated_at
    public $timestamps = true;

    // Especifica qué campos pueden ser asignados masivamente
    protected $fillable = [
        'id_producto',
        'nombre',
        'descripcion',
        'precio',
        'cantidad',
    ];

    protected $primaryKey = 'id_producto';
    
    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'ped_prod','id_producto','id_pedido');
    }

    public function materiaprima()
    {
        return $this->belongsToMany(Materiaprima::class, 'pro_materia','id_producto','id_materiaprima');
    }

    public function puntoventas()
    {
        return $this->belongsToMany(Puntoventa::class, 'pventa_prod','id_producto','id_punventa');
    }
    // Aquí puedes definir relaciones, scopes, y otros comportamientos del modelo
}
