<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterDistribusiPeminjamToUserId extends Migration
{
    public function up()
    {
        // Add user_id column
        $fields = [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true, // null for soft migration
                'after'      => 'dokumen_id'
            ],
        ];
        $this->forge->addColumn('distribusi', $fields);

        // Optionally, if we want to drop peminjam, we could, but let's keep it or drop it depending.
        // I will drop 'peminjam' because we are switching to user_id entirely.
        $this->forge->dropColumn('distribusi', 'peminjam');

        // Add foreign key constraint
        // $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE'); // Need to do it via sql or later.
    }

    public function down()
    {
        $this->forge->dropColumn('distribusi', 'user_id');
        $fields = [
            'peminjam' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'after'      => 'dokumen_id'
            ],
        ];
        $this->forge->addColumn('distribusi', $fields);
    }
}
