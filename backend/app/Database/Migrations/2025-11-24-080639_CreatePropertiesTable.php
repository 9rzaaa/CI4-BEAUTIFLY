<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePropertiesTable extends Migration
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
            'host_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'property_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'address' => [
                'type' => 'TEXT',
            ],
            'city' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'country' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'latitude' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,8',
                'null'       => true,
            ],
            'longitude' => [
                'type'       => 'DECIMAL',
                'constraint' => '11,8',
                'null'       => true,
            ],
            'price_per_night' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'cleaning_fee' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
            ],
            'max_guests' => [
                'type'       => 'INT',
                'constraint' => 3,
                'default'    => 1,
            ],
            'bedrooms' => [
                'type'       => 'INT',
                'constraint' => 3,
            ],
            'beds' => [
                'type'       => 'INT',
                'constraint' => 3,
            ],
            'bathrooms' => [
                'type'       => 'DECIMAL',
                'constraint' => '3,1',
            ],
            'amenities' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'images' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive', 'maintenance'],
                'default'    => 'active',
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('host_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('properties');
    }

    public function down()
    {
        $this->forge->dropTable('properties');
    }
}
