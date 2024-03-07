<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vouchers = [
            ['code' => 'GIAM5', 'discount' => 5],
            ['code' => 'GIAM10', 'discount' => 10],
        ];
        foreach ($vouchers as $key => $value) {
            Voucher::create($value);
        }
    }
}
