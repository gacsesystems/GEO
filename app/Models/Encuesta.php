<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Auditable;

class Encuesta extends Model
{
    use HasFactory, SoftDeletes, Auditable;
    protected $primaryKey = 'id_encuesta';
    protected $fillable = [
        'nombre',
        'descripcion',
        'id_cliente',
        'usuario_registro_id',
        'usuario_modificacion_id',
        'usuario_eliminacion_id'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function seccionesEncuesta()
    {
        return $this->hasMany(SeccionEncuesta::class, 'id_encuesta', 'id_encuesta');
    }
    public function encuestasRespondidas()
    {
        return $this->hasMany(EncuestaRespondida::class, 'id_encuesta', 'id_encuesta');
    }

    // Relaciones para auditoría
    public function usuarioRegistro()
    {
        return $this->belongsTo(User::class, 'usuario_registro_id');
    }
    public function usuarioModificacion()
    {
        return $this->belongsTo(User::class, 'usuario_modificacion_id');
    }
    public function usuarioEliminacion()
    {
        return $this->belongsTo(User::class, 'usuario_eliminacion_id');
    }
}
