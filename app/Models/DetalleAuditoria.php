<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleAuditoria extends Model
{
    protected $table = 'detalles_auditoria';

    protected $fillable = [
        'id_aud_list',
        'id_auditoria',
        'name',
        'version',
        'ILEGAL',
        'fecha',
    ];

    // Relación con Auditoria
    public function auditoria(): BelongsTo
    {
        return $this->belongsTo(Auditoria::class, 'id_auditoria');
    }
}
