<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    /** @use HasFactory<\Database\Factories\InventoryFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fecha_inv',
        'user_id',
        'res_id',
        'fecha',
        'dir',
        'resguardante',
        'user',
        'is_pc',
        'gpo',
        'disp',
        'type',
        'articulo',
        'ni',
        'marca',
        'modelo',
        'ns',
        'nombres',
        'apa',
        'ama',
        'gpo_pc_user',
        'fullname',
        'software_instalado',
        'info',
        'esp',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha' => 'date',
        'is_pc' => 'boolean',
        'status' => 'boolean',
    ];

    /**
     * Get the user that owns the inventory item.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the responsible user for the inventory item.
     */
    public function responsible(): BelongsTo
    {
        return $this->belongsTo(User::class, 'res_id');
    }
}
