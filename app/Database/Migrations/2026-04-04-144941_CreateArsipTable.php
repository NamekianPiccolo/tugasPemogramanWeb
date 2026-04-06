<!-- <?php

// namespace App\Database\Migrations;

// use CodeIgniter\Database\Migration;

// class CreateArsipTable extends Migration
// {
//     public function up()
//     {
//         $this->forge->addField([
//             'id' => [
//                 'type'           => 'INT',
//                 'constraint'     => 5,
//                 'unsigned'       => true,
//                 'auto_increment' => true,
//             ],
//             'nama_dokumen' => [
//                 'type'       => 'VARCHAR',
//                 'constraint' => '255',
//             ],
//             'kategori' => [
//                 'type'       => 'VARCHAR',
//                 'constraint' => '100',
//             ],
//             'file_path' => [
//                 'type'       => 'TEXT',
//                 'null'       => true,
//             ],
//             'created_at' => [
//                 'type' => 'DATETIME',
//                 'null' => true,
//             ],
//             'updated_at' => [
//                 'type' => 'DATETIME',
//                 'null' => true,
//             ],
//         ]);

//         $this->forge->addKey('id', true); // Jadikan ID sebagai Primary Key
//         $this->forge->createTable('arsip'); // Nama tabelnya: arsip
    // }

//     public function down()
//     {
//         $this->forge->dropTable('arsip');
//     }
// }
