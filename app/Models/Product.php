<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'price', 'category_id', 'image', 'description', 'sale_price'];
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product_details()
    {
        return $this->hasMany(ProductDetail::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_details', 'product_id', 'size_id')->distinct();
    }

    public function toppings()
    {
        return $this->belongsToMany(Topping::class, 'product_details', 'product_id', 'topping_id')->distinct();
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
