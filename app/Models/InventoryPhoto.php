<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryPhoto extends Model
{
    protected $fillable = [
        'inventory_id',
        'path',
        'description',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
