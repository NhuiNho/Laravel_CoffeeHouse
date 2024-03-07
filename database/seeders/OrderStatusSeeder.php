<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order_statuses = [
            ['name' => 'Đơn hàng mới nhận'],
            ['name' => 'Đơn hàng đang giao'],
            ['name' => 'Đơn hàng đã giao'],
            ['name' => 'Đơn hàng đã hủy'],
        ];

        foreach ($order_statuses as $key => $value) {
            OrderStatus::create($value);
        }
    }
}
