<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrdersTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'order_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            // Sebaiknya ada user_id jika Anda memiliki sistem login pengguna
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true, // Izinkan null jika ada guest checkout
            ],
            'customer_name' => [ // Menyimpan nama customer saat checkout
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'shipping_address' => [
                'type' => 'TEXT',
            ],
            'total_price' => [ // Total harga semua item + ongkir
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'shipping_cost' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'paid', 'processing', 'shipped', 'completed', 'cancelled'],
                'default'    => 'pending',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        // Tambahkan foreign key ke tabel users jika ada
        // $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        //
        $this->forge->dropTable('orders');
    }
}
