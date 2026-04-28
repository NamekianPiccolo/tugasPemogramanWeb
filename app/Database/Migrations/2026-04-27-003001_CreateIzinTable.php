<?php
 
namespace App\Database\Migrations;
 
use CodeIgniter\Database\Migration;
 
class CreateIzinTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'dokumen_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'pesan'          => ['type' => 'TEXT', 'null' => true],
            'status_izin'    => ['type' => 'ENUM', 'constraint' => ['Pending', 'Disetujui', 'Ditolak'], 'default' => 'Pending'],
            'tgl_pengajuan'  => ['type' => 'DATETIME', 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('dokumen_id', 'dokumen', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('izin');
    }
 
    public function down()
    {
        $this->forge->dropTable('izin');
    }
}
