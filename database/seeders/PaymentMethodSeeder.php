<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment_methods = [
            ['name_method' => 'Thanh toán khi nhận hàng', 'icon' => 'bx bx-money'],
        ];

        foreach ($payment_methods as $key => $value) {
            PaymentMethod::create($value);
        }
    }
}
