<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        if ($this->db->table('users')->countAllResults() > 0) {
            return;
        }

        $this->call('App\\Database\\Seeds\\UsersSeeder');

        $this->call('App\\Database\\Seeds\\PropertiesSeeder');

        $this->call('App\\Database\\Seeds\\BookingsSeeder');

        $this->call('App\\Database\\Seeds\\PaymentsSeeder');
    }
}
