<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_order'         => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_model'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'order_qty' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'buyer' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'order_category' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'start_mc' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'delivery' => [
                'type' => 'DATE',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_order', true);
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
