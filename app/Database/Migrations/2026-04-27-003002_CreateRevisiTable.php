<?php
 
namespace App\Database\Migrations;
 
use CodeIgniter\Database\Migration;
 
class CreateRevisiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'dokumen_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'user_id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'judul'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'deskripsi'      => ['type' => 'TEXT', 'null' => true],
            'tanggal'        => ['type' => 'DATE', 'null' => true],
            'kategori_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'unit_id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'file_dokumen'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status_revisi'  => ['type' => 'ENUM', 'constraint' => ['Pending', 'Disetujui', 'Ditolak'], 'default' => 'Pending'],
            'pesan_admin'    => ['type' => 'TEXT', 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('dokumen_id', 'dokumen', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('revisi');
    }
 
    public function down()
    {
        $this->forge->dropTable('revisi');
    }
}
