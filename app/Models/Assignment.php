<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'id_document', 'id_usuario', 'fecha_asignacion', 'fecha_vencimiento', 'instruccion', 'estado', 'fecha_devolucion'
    ];

    /**
     * Relación: Una asignación pertenece a un documento.
     */
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class, 'id_document');
    }

    /**
     * Relación: Una asignación pertenece a un usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    /**
     * Relación: Una asignación puede tener varios registros en el historial.
     */
    public function histories(): HasMany
    {
        return $this->hasMany(History::class, 'id_asignacion');
    }
}
