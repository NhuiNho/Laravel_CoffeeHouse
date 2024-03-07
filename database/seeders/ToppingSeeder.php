<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Topping;

class ToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $toppings = [
            ['id' => 1, 'name' => 'Shot Espresso', 'price' => 10000],
            ['id' => 2, 'name' => 'Sốt Caramel', 'price' => 10000],
            ['id' => 3, 'name' => 'Thạch Cà Phê', 'price' => 10000],
            ['id' => 4, 'name' => 'Trân Châu Trắng', 'price' => 10000],
            ['id' => 5, 'name' => 'Kem Phô Mai Macchiato', 'price' => 10000],
            ['id' => 6, 'name' => 'Bánh Flan', 'price' => 15000],
            ['id' => 7, 'name' => 'Đào Miếng', 'price' => 10000],
            ['id' => 8, 'name' => 'Thạch Oolong Nướng', 'price' => 10000],
            ['id' => 9, 'name' => 'Trái Vải', 'price' => 10000],
            ['id' => 10, 'name' => 'Hạt Sen', 'price' => 10000],
            ['id' => 11, 'name' => 'Trái Nhãn', 'price' => 10000],
            ['id' => 100, 'name' => 'Không có topping', 'price' => 0],
        ];

        foreach ($toppings as $key => $value) {
            Topping::create($value);
        }
    }
}
