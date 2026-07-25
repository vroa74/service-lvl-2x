<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlackList extends Model
{
    protected $table = 'black_lists';

    protected $fillable = [
        'name',
        'tipo',
        'STATUS',
    ];

    protected $casts = [
        'STATUS' => 'integer',
    ];
}
