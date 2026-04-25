<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDistribusiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'dokumen_id'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'peminjam'        => ['type' => 'VARCHAR', 'constraint' => '150'],
            'tanggal_pinjam'  => ['type' => 'DATE'],
            'tanggal_kembali' => ['type' => 'DATE', 'null' => true],
            'status'          => ['type' => 'ENUM', 'constraint' => ['Dipinjam', 'Dikembalikan'], 'default' => 'Dipinjam'],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('dokumen_id', 'dokumen', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('distribusi');
    }

    public function down()
    {
        $this->forge->dropTable('distribusi');
    }
}
