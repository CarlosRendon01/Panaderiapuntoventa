<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $table = 'materias';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';

    protected $fillable = [
        'nombre',
        'descripcion',
        'proveedor',
        'cantidad',
        'precio',
    ];

    // Define la relación con el modelo Producto
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'pro_materia', 'id_materiaprima', 'id_producto')->withPivot('cantidad');
    }
}
