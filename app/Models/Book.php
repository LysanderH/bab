<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $guarded = [];

    public function bac()
    {
        return $this->belongsTo(Bac::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('current_price', 'amount');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
