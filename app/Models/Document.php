<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'name', 'type', 'state', 'content', 'user_id', 'reception_at', 'delivery_at', 'deadline'
    ];

    /**
     * Relación: Un documento pertenece a un usuario (responsable).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación: Un documento puede tener muchas asignaciones.
     */
    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class, 'id_document');
    }

    /**
     * Relación: Un documento puede tener muchos registros en el historial.
     */
    public function histories(): HasMany
    {
        return $this->hasMany(History::class, 'id_document');
    }

    /**
     * Relación: Un documento puede estar asociado a varias multas.
     */
    public function fines(): HasMany
    {
        return $this->hasMany(Fine::class, 'id_document');
    }
}
