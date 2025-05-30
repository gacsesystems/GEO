<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;


trait Auditable
{
  public static function bootAuditable()
  {
    static::creating(function ($model) {
      if (Auth::check() && $model->isFillable('usuario_registro_id')) {
        $model->usuario_registro_id = Auth::id();
      }
    });

    static::updating(function ($model) {
      if (Auth::check() && $model->isFillable('usuario_modificacion_id')) {
        $model->usuario_modificacion_id = Auth::id();
      }
    });

    // Soft deletes: capturar el deleting y distinguir soft delete de force delete
    static::deleting(function ($model) {
      // Solo para soft delete, no cuando forceDeleting()
      if (
        method_exists($model, 'isForceDeleting')
        && ! $model->isForceDeleting()
        && Auth::check()
        && $model->isFillable('usuario_eliminacion_id')
      ) {
        $model->timestamps = false;                   // no tocar timestamps
        $model->usuario_eliminacion_id = Auth::id(); // asigna auditoría
        $model->saveQuietly();                        // guarda sin disparar más eventos
      }
    });
  }
}
