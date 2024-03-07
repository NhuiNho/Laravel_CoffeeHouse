<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Size;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            ['id' => 1, 'name' => 'Nhỏ', 'description_name' => 'Nhỏ 0', 'price' => 0],
            ['id' => 2, 'name' => 'Vừa', 'description_name' => 'Vừa 4000', 'price' => 4000],
            ['id' => 3, 'name' => 'Lớn', 'description_name' => 'Lớn 4000', 'price' => 4000],
            ['id' => 4, 'name' => 'Vừa', 'description_name' => 'Vừa 6000', 'price' => 6000],
            ['id' => 5, 'name' => 'Lớn', 'description_name' => 'Lớn 6000', 'price' => 6000],
            ['id' => 6, 'name' => 'Vừa', 'description_name' => 'Vừa 10000', 'price' => 10000],
            ['id' => 7, 'name' => 'Lớn', 'description_name' => 'Lớn 10000', 'price' => 10000],
            ['id' => 8, 'name' => 'Lớn', 'description_name' => 'Lớn 14000', 'price' => 14000],
            ['id' => 9, 'name' => 'Lớn', 'description_name' => 'Lớn 16000', 'price' => 16000],
            ['id' => 100, 'name' => 'Không có size', 'description_name' => 'Không có size', 'price' => 0],
        ];

        foreach ($sizes as $key => $value) {
            Size::create($value);
        }
    }
}
