<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function inventory()
    {
        return $this->belongsTo(ProductInventory::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function onCart()
    {
        return $this->hasMany(Cart::class);
    }
}
