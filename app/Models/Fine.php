<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $fillable = [
        'id_document', 'monto', 'fecha_vencimiento', 'fecha_registro', 'razon'
    ];

    /**
     * Relación: Una multa pertenece a un documento.
     */
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class, 'id_document');
    }
}
