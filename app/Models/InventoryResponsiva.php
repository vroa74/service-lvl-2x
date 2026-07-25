<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryResponsiva extends Model
{
    protected $fillable = [
        'responsiva_id',
        'inventory_id',
        'description',
    ];

    public function responsiva()
    {
        return $this->belongsTo(Responsiva::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
