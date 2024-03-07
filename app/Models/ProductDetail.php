<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'product_details';
    protected $fillable = ['product_id', 'size_id', 'topping_id'];
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
