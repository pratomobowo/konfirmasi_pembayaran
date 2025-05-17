<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Initial payment types from the hardcoded list in PaymentController
        $paymentTypes = [
            [
                'name' => 'SPP',
                'description' => 'Biaya Sumbangan Pembinaan Pendidikan',
                'is_active' => true
            ],
            [
                'name' => 'Praktikum',
                'description' => 'Biaya kegiatan praktikum',
                'is_active' => true
            ],
            [
                'name' => 'Ujian',
                'description' => 'Biaya ujian semester',
                'is_active' => true
            ],
            [
                'name' => 'Wisuda',
                'description' => 'Biaya wisuda dan kelengkapannya',
                'is_active' => true
            ],
            [
                'name' => 'Lainnya',
                'description' => 'Jenis pembayaran lainnya',
                'is_active' => true
            ]
        ];

        foreach ($paymentTypes as $type) {
            PaymentType::create($type);
        }
    }
}
