<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearDatabaseSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // Clear tables in reverse order (to respect foreign key constraints)
        $tablesInOrder = ['payments', 'bookings', 'properties', 'users'];

        // Disable foreign key checks to avoid constraint errors
        $db->disableForeignKeyChecks();

        foreach ($tablesInOrder as $table) {
            $db->table($table)->truncate();
            echo "✅ Cleared table: {$table}\n";
        }

        // Re-enable foreign key checks
        $db->enableForeignKeyChecks();
    }
}
