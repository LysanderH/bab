<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    public $guarded = [];

    public $casts = [
        'start' => 'date',
        'end' => 'date',
        'deadline' => 'date',
        'active' => 'boolean',
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
