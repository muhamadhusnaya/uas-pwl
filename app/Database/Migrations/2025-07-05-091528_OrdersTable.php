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
            // Kolom dari sistem Anda
            'order_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'customer_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'shipping_address' => [
                'type' => 'TEXT',
            ],
            'grand_total' => [ // Total harga semua item + ongkir
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            // Kolom untuk Payment Gateway (Xendit, dll)
            'external_id' => [ // ID unik yang Anda kirim ke payment gateway
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique'     => true,
            ],
            'payment_status' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'PENDING', // Sesuaikan dengan status dari Xendit (e.g., PENDING, PAID, EXPIRED)
            ],
            'invoice_url' => [ // URL invoice dari payment gateway
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'payment_method' => [ // Misal: 'CREDIT_CARD', 'VIRTUAL_ACCOUNT'
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
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
