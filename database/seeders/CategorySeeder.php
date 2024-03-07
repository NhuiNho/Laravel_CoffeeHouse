<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' =>  'Cà Phê HighLight', 'menu_id' => 1, 'image' =>  '1704187744_8084.jpg'],
            ['name' =>  'Cà Phê Việt Nam', 'menu_id' => 1, 'image' =>  'caphe_cloudfee.png'],
            ['name' =>  'Cà Phê Máy', 'menu_id' => 1, 'image' =>  'category_cf.jpg'],
            ['name' =>  'Cold Brew', 'menu_id' => 1, 'image' =>  'category_cold.jpg'],
            ['name' =>  'Trà Trái Cây', 'menu_id' => 2, 'image' =>  'tratraicay_hitea.png'],
            ['name' =>  'Trà Sữa Machiato', 'menu_id' => 2, 'image' =>  'trasua_cloudtea.png'],
            ['name' =>  'CloudTea', 'menu_id' => 3, 'image' =>  'trasua_cloudtea.png'],
            ['name' =>  'CloudFee', 'menu_id' => 3, 'image' =>  'caphe_cloudfee.png'],
            ['name' =>  'CloudTea Mochi', 'menu_id' => 3, 'image' =>  'trasua_cloudtea.png'],
            ['name' =>  'Hi-Tea Trà', 'menu_id' => 4, 'image' =>  'tratraicay_hitea.png'],
            ['name' =>  'Hi-Tea Đá Tuyết', 'menu_id' => 4, 'image' =>  'tratraicay_hitea.png'],
            ['name' =>  'Trà Xanh Tây Bắc', 'menu_id' => 5, 'image' =>  'traxanh_chocolate.png'],
            ['name' =>  'Chocolate', 'menu_id' => 5, 'image' =>  'traxanh_chocolate.png'],
            ['name' =>  'Đá Xay Frosty', 'menu_id' => 6, 'image' =>  'daxay_frosty.png'],
            ['name' =>  'Bánh Mặn', 'menu_id' => 7, 'image' =>  'banhman.png'],
            ['name' =>  'Bánh Ngọt', 'menu_id' => 7, 'image' =>  'banhngot.png'],
            ['name' =>  'Snack', 'menu_id' => 7, 'image' =>  'category_ga.jpg'],
            ['name' =>  'Bánh Pastry', 'menu_id' => 7, 'image' =>  'category_butter.jpg'],
            ['name' =>  'Cà Phê Tại Nhà', 'menu_id' => 8, 'image' =>  'caphe_tradonggoi.png'],
            ['name' =>  'Trà Tại Nhà', 'menu_id' => 8, 'image' =>  'caphe_tradonggoi.png'],
        ];

        foreach ($categories as $key => $value) {
            Category::create($value);
        }
    }
}
