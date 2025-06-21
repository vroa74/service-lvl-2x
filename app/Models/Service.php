<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'id_s',
        'F_serv',
        'solicitante_id',
        'efectuo_id',
        'vobo_id',
        'obj_sol',
        'actividades',
        'mantenimiento',
        'observaciones',
        'correctivo',
        'preventivo',
        'transparencia',
        'a_tec',
        'web_ins',
        'print',
        'email',
        'tel',
        'sol_ser',
        'oficio',
        'calendario',
        'capturo',
        'status',
        'impressions',
    ];

    protected $casts = [
        'F_serv' => 'date',
        'correctivo' => 'boolean',
        'preventivo' => 'boolean',
        'transparencia' => 'boolean',
        'a_tec' => 'boolean',
        'web_ins' => 'boolean',
        'print' => 'boolean',
        'email' => 'boolean',
        'tel' => 'boolean',
        'sol_ser' => 'boolean',
        'oficio' => 'boolean',
        'calendario' => 'boolean',
        'status' => 'boolean',
        'impressions' => 'boolean',
    ];

    protected $with = ['solicitante', 'efectuo', 'vobo', 'capturo'];

    // Relaciones con usuarios

    public function solicitante()
    {
        return $this->belongsTo(User::class, 'solicitante_id');
    }

    public function efectuo()
    {
        return $this->belongsTo(User::class, 'efectuo_id');
    }

    public function vobo()
    {
        return $this->belongsTo(User::class, 'vobo_id');
    }

    public function capturo()
    {
        return $this->belongsTo(User::class, 'capturo');
    }

    public function servicesAsSolicitante()
    {
        return $this->hasMany(Service::class, 'solicitante_id');
    }

    public function servicesAsEfectuo()
    {
        return $this->hasMany(Service::class, 'efectuo_id');
    }

    public function servicesAsVobo()
    {
        return $this->hasMany(Service::class, 'vobo_id');
    }

    public function servicesAsCapturo()
    {
        return $this->hasMany(Service::class, 'capturo');
    }

    protected function actividades(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => mb_convert_encoding($value, 'UTF-8', 'auto'),
            set: fn ($value) => mb_convert_encoding($value, 'UTF-8', 'auto')
        );
    }

    protected function observaciones(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => mb_convert_encoding($value, 'UTF-8', 'auto'),
            set: fn ($value) => mb_convert_encoding($value, 'UTF-8', 'auto')
        );
    }

    protected function obj_sol(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => mb_convert_encoding($value, 'UTF-8', 'auto'),
            set: fn ($value) => mb_convert_encoding($value, 'UTF-8', 'auto')
        );
    }
}
