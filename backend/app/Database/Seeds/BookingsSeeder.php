<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookingsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'property_id'       => 1,
                'user_id'           => 2, // Billie Eilish
                'check_in'          => '2025-12-15',
                'check_out'         => '2025-12-20',
                'adults'            => 4,
                'kids'              => 2,
                'number_of_nights'  => 5,
                'price_per_night'   => 2000.00,
                'total_price'       => 10300.00, // (5 × 2000) + 300 cleaning
                'status'            => 'confirmed',
                'payment_status'    => 'paid',
                'payment_method'    => 'credit_card',
                'transaction_id'    => 'TXN001234567890',
                'special_requests'  => 'Early check-in if possible',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'property_id'       => 1,
                'user_id'           => 2,
                'check_in'          => '2025-11-28',
                'check_out'         => '2025-11-30',
                'adults'            => 2,
                'kids'              => 0,
                'number_of_nights'  => 2,
                'price_per_night'   => 2000.00,
                'total_price'       => 4300.00, // (2 × 2000) + 300 cleaning
                'status'            => 'pending',
                'payment_status'    => 'unpaid',
                'payment_method'    => null,
                'transaction_id'    => null,
                'special_requests'  => null,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'property_id'       => 1,
                'user_id'           => 2,
                'check_in'          => '2025-11-01',
                'check_out'         => '2025-11-05',
                'adults'            => 3,
                'kids'              => 1,
                'number_of_nights'  => 4,
                'price_per_night'   => 2000.00,
                'total_price'       => 8300.00, // (4 × 2000) + 300 cleaning
                'status'            => 'completed',
                'payment_status'    => 'paid',
                'payment_method'    => 'gcash',
                'transaction_id'    => 'GCASH987654321',
                'special_requests'  => 'Need extra towels',
                'created_at'        => '2025-10-25 14:30:00',
                'updated_at'        => '2025-11-05 11:00:00',
            ],
            [
                'property_id'       => 1,
                'user_id'           => 2,
                'check_in'          => '2025-12-01',
                'check_out'         => '2025-12-03',
                'adults'            => 2,
                'kids'              => 0,
                'number_of_nights'  => 2,
                'price_per_night'   => 2000.00,
                'total_price'       => 4300.00, // (2 × 2000) + 300 cleaning
                'status'            => 'cancelled',
                'payment_status'    => 'refunded',
                'payment_method'    => 'credit_card',
                'transaction_id'    => 'TXN555666777888',
                'special_requests'  => null,
                'created_at'        => '2025-11-20 10:15:00',
                'updated_at'        => '2025-11-22 09:30:00',
            ],
            [
                'property_id'       => 1,
                'user_id'           => 2,
                'check_in'          => '2025-12-25',
                'check_out'         => '2025-12-28',
                'adults'            => 5,
                'kids'              => 1,
                'number_of_nights'  => 3,
                'price_per_night'   => 3500.00, // Peak season pricing
                'total_price'       => 10800.00, // (3 × 3500) + 300 cleaning
                'status'            => 'confirmed',
                'payment_status'    => 'paid',
                'payment_method'    => 'gcash',
                'transaction_id'    => 'GCASH123456789',
                'special_requests'  => 'Christmas decorations please',
                'created_at'        => '2025-11-15 16:45:00',
                'updated_at'        => '2025-11-15 17:00:00',
            ],
        ];

        $this->db->table('bookings')->insertBatch($data);
    }
}
