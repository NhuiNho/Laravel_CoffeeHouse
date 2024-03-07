<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banners = [
            [
                'image' => 'banner1.webp',
                'description' => '',
                'status' => 1,
            ],
            [
                'image' => 'banner2.webp',
                'description' => '',
                'status' => 1,
            ], [
                'image' => 'banner3.webp',
                'description' => '',
                'status' => 1,
            ], [
                'image' => 'banner4.webp',
                'description' => '',
                'status' => 1,
            ], [
                'image' => 'banner5.webp',
                'description' => '',
                'status' => 1,
            ], [
                'image' => 'banner_2023_12.webp',
                'description' => '',
                'status' => 2,
            ], [
                'image' => 'banner_2024_01.webp',
                'description' => '',
                'status' => 2,
            ],
        ];

        foreach ($banners as $key => $value) {
            Banner::create($value);
        }
    }
}
