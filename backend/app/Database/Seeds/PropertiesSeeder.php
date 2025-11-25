<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PropertiesSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'host_id'          => 1, // Admin
                'title'            => 'Cozy Studio Unit in Quezon City',
                'description'      => 'Comfortable and affordable studio unit perfect for solo travelers or couples. Located in a quiet neighborhood with easy access to restaurants, shops, and public transportation. Features modern amenities and a relaxing atmosphere for your stay.',
                'property_type'    => 'Studio',
                'address'          => '123 Aurora Boulevard, Quezon City',
                'city'             => 'Quezon City',
                'price_per_night'  => 2000.00,
                'cleaning_fee'     => 300.00,
                'max_guests'       => 6,
                'amenities'        => 'WiFi, Air Conditioning, Kitchen, Hot Shower, Cable TV, Work Desk, Parking',
                'images'           => json_encode(['studio1.jpg', 'studio2.jpg', 'studio3.jpg', 'studio4.jpg']),
                'status'           => 'active',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
        ];

        $this->db->table('properties')->insertBatch($data);
    }
}
