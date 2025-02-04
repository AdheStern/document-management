<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'id_document', 'id_asignacion', 'id_usuario', 'tipo_accion', 'detalle', 'archivo', 'fecha'
    ];

    /**
     * Relación: Un historial pertenece a un documento.
     */
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class, 'id_document');
    }

    /**
     * Relación: Un historial pertenece a una asignación.
     */
    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class, 'id_asignacion');
    }

    /**
     * Relación: Un historial pertenece a un usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
