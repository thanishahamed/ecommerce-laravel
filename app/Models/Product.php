<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function orders()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'id');
    }

    public function inventory()
    {
        return $this->belongsTo(ProductInventory::class, 'id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function onCart()
    {
        return $this->hasMany(Cart::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
