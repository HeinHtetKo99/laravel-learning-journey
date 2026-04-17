<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders_items')
                ->withPivot('quantity')
                ->withTimestamps();
    }
}
