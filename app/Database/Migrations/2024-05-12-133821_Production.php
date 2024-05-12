<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Production extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_production'   => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_inisial'       => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'       => true,
            ],
            'date_production' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'qty_production' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'run_mc' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'bs_mc' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned'       => true,
            ],
        ]);
        $this->forge->addKey('id_production', true);
        $this->forge->addForeignKey('id_inisial', 'inisials', 'id_inisial', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('productions');
    }

    public function down()
    {
        $this->forge->dropTable('productions');
    }
}
