<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auditoria extends Model
{
    protected $table = 'auditorias';

    protected $fillable = [
        'iduser',
        'idres',
        'idoic',
        'idinfo',
        'id_aud_list',
        'FH',
        'ni',
        'PCDetalle',
    ];

    protected $casts = [
        'FH' => 'datetime',
    ];

    // Relaciones con User
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idres');
    }

    public function oficinista(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idoic');
    }

    public function informante(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idinfo');
    }

    // Relación con Inventory
    public function inventario(): BelongsTo
    {
        return $this->belongsTo(Inventory::class, 'ni');
    }

    // Relación con DetalleAuditoria
    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleAuditoria::class, 'id_auditoria');
    }
}
