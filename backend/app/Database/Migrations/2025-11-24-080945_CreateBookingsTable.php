<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'property_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 1,
            ],
            'user_id' => [  
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'check_in' => [  
                'type' => 'DATE',
            ],
            'check_out' => [  
                'type' => 'DATE',
            ],
            'adults' => [
                'type'       => 'INT',
                'constraint' => 3,
                'default'    => 1,
            ],
            'kids' => [ 
                'type'       => 'INT',
                'constraint' => 3,
                'default'    => 0,
            ],
            'number_of_nights' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'price_per_night' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 100.00,
            ],
            'total_price' => [  
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'confirmed', 'cancelled', 'completed', 'rejected'],
                'default'    => 'pending',
            ],
            'payment_status' => [
                'type'       => 'ENUM',
                'constraint' => ['unpaid', 'paid', 'refunded', 'failed'],
                'default'    => 'unpaid',
            ],
            'payment_method' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'transaction_id' => [  
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'special_requests' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);    
        
        $this->forge->createTable('bookings');
    }

    public function down()
    {
        $this->forge->dropTable('bookings');
    }
}