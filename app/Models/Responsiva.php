<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsiva extends Model
{
    protected $fillable = [
        'user_id',
        'responsable_id',
        'informatica_id',
        'fecha',
        'codigo',
        'auditoria',
        'observacion',
    ];

    protected $casts = [
        'fecha' => 'date',
        'auditoria' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function informatica()
    {
        return $this->belongsTo(User::class, 'informatica_id');
    }

    public function inventoryResponsivas()
    {
        return $this->hasMany(InventoryResponsiva::class);
    }
}
