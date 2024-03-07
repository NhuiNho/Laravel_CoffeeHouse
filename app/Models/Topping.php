<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    protected $table = 'toppings';
    protected $fillable = ['name', 'price'];
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_details', 'topping_id', 'product_id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
