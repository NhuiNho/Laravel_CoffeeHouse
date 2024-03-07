<?php

namespace Database\Seeders;

use App\Models\AdminStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_statuses = [
            [
                'name' => 'Admin Level 9999',
            ],
            [
                'name' => 'Admin Bị Khóa',
            ],
            [
                'name' => 'Admin Level 1',
            ],
        ];

        foreach ($admin_statuses as $key => $value) {
            AdminStatus::create($value);
        }
    }
}
