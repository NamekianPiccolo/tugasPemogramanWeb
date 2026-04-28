<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDokumenTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'judul'        => ['type' => 'VARCHAR', 'constraint' => '255'],
            'deskripsi'    => ['type' => 'TEXT', 'null' => true],
            'tanggal'      => ['type' => 'DATE'],
            'file_dokumen' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'kategori_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'unit_id'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'ukuran_file'  => ['type' => 'INT', 'null' => true],
            'ekstensi_file' => ['type' => 'VARCHAR', 'constraint' => '10', 'null' => true],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kategori_id', 'kategori', 'id', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('unit_id', 'unit', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('dokumen');
    }

    public function down()
    {
        $this->forge->dropTable('dokumen');
    }
}
