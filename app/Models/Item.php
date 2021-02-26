<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $casts = [
        'suffix' => 'array',
        'cost_data' => 'array',
        'material_breakouts' => 'array',
        'performer_breakouts' => 'array',
        'work_descriptions' => 'array',
    ];

}
