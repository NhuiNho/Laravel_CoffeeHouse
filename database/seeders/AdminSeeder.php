<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'Admin Phước',
                'email' => 'truongphuoc442001@gmail.com',
                'password' => bcrypt('123456'),
                'admin_status_id' => '1',

            ],
            [
                'name' => 'Admin Dỏm',
                'email' => 'admindom@gmail.com',
                'password' => bcrypt('123456'),
                'admin_status_id' => '3',
            ],
        ];

        foreach ($admins as $key => $value) {
            Admin::create($value);
        }
    }
}
