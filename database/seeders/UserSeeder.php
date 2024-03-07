<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $users = [
        //     ['fullname' => 'Đặng Châu Trường Phước', 'phone' => '0856033726', 'address' => '100 trệt', 'password' => Hash::make('123456'), 'email' => 'truongphuoc442001@gmail.com'],
        // ];

        // foreach ($users as $key => $value) {
        //     User::create($value);
        // }
    }
}
