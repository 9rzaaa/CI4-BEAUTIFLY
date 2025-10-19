<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'first_name'       => 'Admin',
                'middle_name'      => 'A',
                'last_name'        => 'Ling',
                'email'            => 'admin@easyco.com',
                'password_hash'    => password_hash('EasyCo2025!', PASSWORD_DEFAULT),
                'type'             => 'admin',
                'account_status'   => 1,
                'email_activated'  => 1,
                'newsletter'       => 1,
                'gender'           => 'Male',
                'profile_image'    => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'first_name'       => 'Billie',
                'middle_name'      => null,
                'last_name'        => 'Eilish',
                'email'            => 'billieeilish@gmail..com',
                'password_hash'    => password_hash('Billie08', PASSWORD_DEFAULT),
                'type'             => 'client',
                'account_status'   => 1,
                'email_activated'  => 0,
                'newsletter'       => 1,
                'gender'           => 'Female',
                'profile_image'    => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
