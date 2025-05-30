<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoPregunta extends Model
{
    use HasFactory;
    protected $table = 'tipos_pregunta';
    protected $primaryKey = 'id_tipo_pregunta';
    public $timestamps = false; // Catálogo fijo
    protected $fillable = [
        'nombre',
        'descripcion',
        'requiere_opciones',
        'permite_min_max_numerico',
        'permite_min_max_fecha',
        'es_seleccion_multiple'
    ];
}
