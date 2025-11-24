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
                'title'            => 'Cozy Beachfront Villa',
                'description'      => 'Beautiful 3-bedroom villa with stunning ocean views. Perfect for families and groups looking for a relaxing beach vacation.',
                'property_type'    => 'Villa',
                'address'          => '123 Sunset Boulevard, Boracay',
                'city'             => 'Malay',
                'country'          => 'Philippines',
                'latitude'         => 11.9674,
                'longitude'        => 121.9248,
                'price_per_night'  => 3500.00,
                'cleaning_fee'     => 500.00,
                'max_guests'       => 6,
                'bedrooms'         => 3,
                'beds'             => 4,
                'bathrooms'        => 2.0,
                'amenities'        => 'WiFi, Air Conditioning, Kitchen, Pool, Beach Access, Parking',
                'images'           => json_encode(['villa1.jpg', 'villa2.jpg', 'villa3.jpg']),
                'status'           => 'active',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'host_id'          => 1, // Admin
                'title'            => 'Modern City Apartment',
                'description'      => 'Stylish 1-bedroom apartment in the heart of Makati. Walking distance to malls, restaurants, and business districts.',
                'property_type'    => 'Apartment',
                'address'          => '456 Ayala Avenue, Makati',
                'city'             => 'Makati',
                'country'          => 'Philippines',
                'latitude'         => 14.5547,
                'longitude'        => 121.0244,
                'price_per_night'  => 2500.00,
                'cleaning_fee'     => 300.00,
                'max_guests'       => 2,
                'bedrooms'         => 1,
                'beds'             => 1,
                'bathrooms'        => 1.0,
                'amenities'        => 'WiFi, Air Conditioning, Kitchen, Gym, Security, Parking',
                'images'           => json_encode(['apt1.jpg', 'apt2.jpg', 'apt3.jpg']),
                'status'           => 'active',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'host_id'          => 1, // Admin
                'title'            => 'Rustic Mountain Cabin',
                'description'      => 'Peaceful 2-bedroom cabin surrounded by nature. Ideal for couples and small families seeking a mountain retreat.',
                'property_type'    => 'Cabin',
                'address'          => '789 Mountain View Road, Tagaytay',
                'city'             => 'Tagaytay',
                'country'          => 'Philippines',
                'latitude'         => 14.1054,
                'longitude'        => 120.9621,
                'price_per_night'  => 2800.00,
                'cleaning_fee'     => 400.00,
                'max_guests'       => 4,
                'bedrooms'         => 2,
                'beds'             => 2,
                'bathrooms'        => 1.5,
                'amenities'        => 'WiFi, Fireplace, Kitchen, Garden, Mountain View, Parking',
                'images'           => json_encode(['cabin1.jpg', 'cabin2.jpg', 'cabin3.jpg']),
                'status'           => 'active',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
        ];

        $this->db->table('properties')->insertBatch($data);
    }
}
