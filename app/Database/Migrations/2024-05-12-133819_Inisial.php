<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Inisial extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_inisial'      => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_order'       => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'area' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'inisial' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'style_size' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'qty_po' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'jarum' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id_inisial', true);
        $this->forge->addForeignKey('id_order', 'orders', 'id_order', 'CASCADE', 'CASCADE');
        $this->forge->createTable('inisials');
    }

    public function down()
    {
        $this->forge->dropTable('inisials');
    }
}
