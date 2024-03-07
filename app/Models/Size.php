<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';
    protected $fillable = ['name', 'description_name', 'price'];
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_details', 'size_id', 'product_id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
