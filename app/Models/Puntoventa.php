<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntoventa extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si no sigue la convención de nombres de Laravel
    protected $table = 'puntoventas';

    // Desactiva los timestamps si tu tabla no tiene las columnas created_at y updated_at
    public $timestamps = true;

    // Especifica qué campos pueden ser asignados masivamente
    protected $fillable = [
        'id_punventa',
        'descripcion',
        
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'pventa_prod','id_punventa','id_producto');
    }
    public function pedidos()
    {
        return $this->belongsTo(Pedido::class, 'id_punventa');
    }

    



    // Aquí puedes definir relaciones, scopes, y otros comportamientos del modelo
}
