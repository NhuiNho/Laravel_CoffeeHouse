<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'name_receiver', 'phone_receiver', 'address_receiver', 'email_receiver', 'order_status_id', 'total_price', 'payment_method_id', 'voucher_id'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
