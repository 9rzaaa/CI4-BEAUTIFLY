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
                'guest_id'          => 2, // Billie Eilish
                'check_in_date'     => '2025-12-15',
                'check_out_date'    => '2025-12-20',
                'number_of_guests'  => 2,
                'number_of_nights'  => 5,
                'price_per_night'   => 3500.00,
                'cleaning_fee'      => 500.00,
                'service_fee'       => 450.00,
                'total_amount'      => 18450.00,
                'status'            => 'confirmed',
                'payment_status'    => 'paid',
                'payment_method'    => 'credit_card',
                'special_requests'  => 'Early check-in if possible',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'property_id'       => 2,
                'guest_id'          => 2,
                'check_in_date'     => '2025-11-28',
                'check_out_date'    => '2025-11-30',
                'number_of_guests'  => 1,
                'number_of_nights'  => 2,
                'price_per_night'   => 2500.00,
                'cleaning_fee'      => 300.00,
                'service_fee'       => 280.00,
                'total_amount'      => 5580.00,
                'status'            => 'pending',
                'payment_status'    => 'pending',
                'payment_method'    => null,
                'special_requests'  => null,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'property_id'       => 1,
                'guest_id'          => 2,
                'check_in_date'     => '2025-11-01',
                'check_out_date'    => '2025-11-05',
                'number_of_guests'  => 3,
                'number_of_nights'  => 4,
                'price_per_night'   => 3500.00,
                'cleaning_fee'      => 500.00,
                'service_fee'       => 700.00,
                'total_amount'      => 15200.00,
                'status'            => 'completed',
                'payment_status'    => 'paid',
                'payment_method'    => 'gcash',
                'special_requests'  => 'Need extra towels',
                'created_at'        => '2025-10-25 14:30:00',
                'updated_at'        => '2025-11-05 11:00:00',
            ],
        ];

        $this->db->table('bookings')->insertBatch($data);
    }
}
